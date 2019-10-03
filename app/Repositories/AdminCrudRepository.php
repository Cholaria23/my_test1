<?php

namespace App\Repositories;

use App\Repositories\ImageRepository;
use App\Repositories\FileRepository;
use Carbon\Carbon;
use DB;
use App\Models\Picture;

class AdminCrudRepository
{
    protected $imageRepository;
    protected $file;

    public function __construct(ImageRepository $imageRepository, FileRepository $fileRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->file = $fileRepository;
    }

    public function index($request, $model, $whereArr = null)
    {
        $item = new $model;
        $fillable = $item->getFillable();
        $translatedAttributes = $item->translatedAttributes;
        $table = $item->getTable();
        $translationsTable = $item->translationsTable;
        $entityNameArr = array_reverse(explode('_', $translationsTable));
        unset($entityNameArr[0]);
        $entityName = implode('_', array_reverse($entityNameArr));

        $query = $item;
        if (is_array($translatedAttributes)) {
            $query = $item::join($translationsTable . ' as t', function ($join) use ($table, $entityName) {
                $join->on($table . '.id', '=', 't.' . $entityName . '_id')
                    ->where('t.locale', '=', 'ru');
            })->select($table . '.created_at');
            foreach ($fillable as $field) {
                $query->addSelect($table . '.' . $field);
            }
            foreach ($translatedAttributes as $field) {
                $query->addSelect('t.' . $field);
            }
            if ($request->has('query') && $request->get('query')) {
                $query->search($request);
            }
            $query->groupBy($table . '.id')
                ->groupBy('t.id')
                ->order($request)
                ->filter($request);
        } else {
            if ($request->has('query') && $request->get('query')) {
                $query = $query::search($request);
            } else {
                $query = $query::filter($request)->order($request);
            }
        }

        if (!is_null($whereArr) && is_array($whereArr)) {
            foreach ($whereArr as $k => $where) {
                $query = $query->where($k, $where);
            }
        }

        $items = $query->paginate(10);

        return response()->json(compact('items'));
    }

    public function store($request, $model)
    {
        $item = new $model;

        $data = [];

        foreach ($item->getFillable() as $field) {
            $dissable_array = [
                'image', 'preview_image_1', 'preview_image_2', 'file', 'path'
            ];
            if ($request->has($field) && !in_array($field, $dissable_array)) {
                if ($field == 'publish' || $field == 'authorized') {
                    $data[$field] = $request->get($field) == 'true' || $request->get($field) == 1 || $request->get($field) == '1' ? 1 : 0;
                } else if ($field == 'views') {
                    $data[$field] = $request->get($field) == 'null' ? 0 : $request->get($field);
                } else {
                    if ($request->get($field) != 'null') {
                        $data[$field] = $request->get($field);
                    }
                }
            }
        }

        if ($item->translatedAttributes) {
            foreach (\Config::get('app.locales') as $lang) {
                $attr_array = [];
                foreach ($item->translatedAttributes as $attr) {
                    if ($request->has('translations_' . $lang . '_' . $attr)) {
                        $attr_array[$attr] = $request->get('translations_' . $lang . '_' . $attr);
                    }
                }
                $data[$lang] = $attr_array;
            }
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileUrl = $this->file->uploadFile($file);
            $data['file'] = $fileUrl;
        }

        if ($request->hasFile('path')) {
            $file = $request->file('path');
            $fileUrl = $this->file->uploadFile($file);
            $data['path'] = $fileUrl;
        }

        $item = $model::create($data);

        if ($item->images) {
            foreach ($item->images as $key => $field) {
                if ($request->has($key) && $request->get($key) != 'null' &&strlen($request->get($key))) {
                    $image = json_decode(json_encode($request->get($key)), FALSE);
                    $unique = md5(Carbon::now());
                    $this->imageRepository->imageStore($item, $image, $image, $unique, $key);
                    $item->update([
                        $key => $unique,
                    ]);
                }
            }
        }

        if ($item->belongsToMany) {
            foreach ($item->belongsToMany as $field) {
                if ($request->has($field) && $request->get($field) != 'null') {
                    $to = explode('_', $field)[0];
                    call_user_func([$item, $to])->sync(explode(',', $request->get($field)));
                }
            }
        }

        if ($item->morphMany) {
            foreach ($item->morphMany as $field) {
                if ($field == 'pictures') {
                    if ($request->has('pictures_count')) {

                        $count = (int)$request->get($field . '_count');
                        $currentImages = [];

                        for ($i = 0; $i < $count; $i++) {
                            $value = $request->get($field . '_' . $i);
                            if (is_string($value) && $value != 'null') {
                                if ($value && strlen($value) > 50 && strstr($value, 'data')) {
                                    $image = json_decode(json_encode($value), FALSE);
                                    $unique = md5(Carbon::now());
                                    $currentImages[] = $unique;
                                    $pic = $item->pictures()->create([
                                        'image' => $unique,
                                    ]);
                                    $this->imageRepository->imageStore($pic, $image, $image, $unique, 'image');
                                } else if ($value && strlen($value) < 50) {
                                    $currentImages[] = $value;
                                }
                            }
                        }
                        //$item->pictures()->whereNotIn('image', $currentImages)->delete(); // TODO: delete images from folder
                    }
                }
            }
        }

        return $this->show($item->id, $model);
    }

    public function show($id, $model)
    {
        $item = $model::findOrFail($id);
        return response()->json(compact('item'));
    }

    public function update($request, $model, $fieldModel = null)
    {
        $item = $model::findOrFail($request->get('id'));

        $data = [];

        $fillable = $item->getFillable();
        foreach ($fillable as $field) {
            if ($request->has($field) && !isset($item->images[$field]) && $field != 'file' && $field != 'path') {
                if ($field == 'publish' || $field == 'is_set' || $field == 'is_new' || $field == 'is_old' || $field == 'authorized' || $field == 'is_linked') {
                    $data[$field] = $request->get($field) == 'true' || $request->get($field) == 1 || $request->get($field) == '1' ? 1 : 0;
                } else if ($field == 'views') {
                    $data[$field] = $request->get($field) == 'null' ? 0 : $request->get($field);
                } else {
                    if ($request->get($field) != 'null') {
                        $data[$field] = $request->get($field);
                    }
                }
            }
        }

        if ($item->translatedAttributes) {
            foreach (\Config::get('app.locales') as $lang) {
                $attr_array = [];
                foreach ($item->translatedAttributes as $attr) {
                    if ($request->has('translations_' . $lang . '_' . $attr) && $request->get('translations_' . $lang . '_' . $attr) !== 'null') {
                            $attr_array[$attr] = $request->get('translations_' . $lang . '_' . $attr);
                    }
                }
                $data[$lang] = $attr_array;
            }
        }

        if ($item->belongsToMany) {
            foreach ($item->belongsToMany as $field) {
                if ($request->has($field) && $request->get($field) !== "") {
                    $to = explode('_', $field)[0];
                    if ($to === 'attributes') {
                        $to = 'attrs'; // TODO: problem with reserved name 'attributes'
                    }
                    $ids = $request->get($field);
                    $ids_array =  (null !== $ids) ? explode(',', $ids) : [];
                    call_user_func([$item, $to])->sync($ids_array);
                }
            }
        }

        if ($item->morphMany) {
            foreach ($item->morphMany as $field) {
                if ($field === 'pictures') {
                    if ($request->has('pictures_count')) {

                        $count = (int)$request->get($field . '_count');
                        $currentImages = [];

                        for ($i = 0; $i < $count; $i++) {
                            $value = $request->get($field . '_' . $i);
                            if (is_string($value) && $value != 'null') {
                                if ($value && strlen($value) > 50 && strstr($value, 'data')) {
                                    $image = json_decode(json_encode($value), FALSE);
                                    $unique = md5(Carbon::now());
                                    $currentImages[] = $unique;
                                    $pic = $item->pictures()->create([
                                        'image' => $unique,
                                    ]);
                                    $this->imageRepository->imageStore($pic, $image, $image, $unique, 'image');
                                } else if ($value && strlen($value) < 50) {
                                    $currentImages[] = $value;
                                }
                            }
                        }
                        $item->pictures()->whereNotIn('image', $currentImages)->delete(); // TODO: delete images from folder
                    } else {
                        $item->pictures()->delete();
                    }
                }
            }
        }

        if ($item->images) {
            foreach ($item->images as $key => $field) {
                if ($request->has($key) && strlen($request->get($key)) > 50 && strstr($request->get($key), 'data')) {
                    $image = json_decode(json_encode($request->get($key)), FALSE);
                    $unique = md5(Carbon::now());
                    $this->imageRepository->imageStore($item, $image, $image, $unique, $key);
                    $data[$key] = $unique;
                } else if ($request->has($key) && (is_null($request->get($key)) || $request->get($key) == 'null')) {
                    $this->imageRepository->imageDelete($item, $key);
                    $data[$key] = null;
                }
            }
        }

        if ($request->hasFile('file')) {
            \File::delete($item->file);
            $file = $request->file('file');
            $fileUrl = $this->file->uploadFile($file);
            $data['file'] = $fileUrl;
        }

        if ($request->hasFile('path')) {
            \File::delete($item->path);
            $file = $request->file('path');
            $fileUrl = $this->file->uploadFile($file);
            $data['path'] = $fileUrl;
        }

        if ($fieldModel !== null && $request->get('fields')) {
            $fields = json_decode( $request->get('fields'), true);
            foreach ($fields as $index => $fieldItem) {
                $this->updateFields($fieldItem, $fieldModel);
            }
        }

        $item->update($data);

        if ($fieldModel !== null && $fields = $request->get('fields')) {
            $item = $model::findOrFail($request->get('id')); // TODO: To find a way to avoid the extra request
        }

        return $this->show($item->id, $model);
    }

    public function updateFields($fieldData, $model)
    {
        $item = $model::findOrFail($fieldData['id']);

        $data = [];

        $fillable = $item->getFillable();
        foreach ($fillable as $field) {
            if ($field != 'image') {
                $data[$field] = $fieldData[$field];
            }
        }

        if ($item->translatedAttributes) {
            foreach ($fieldData['translations'] as $key => $translation) {
                $array = [];
                foreach ($item->translatedAttributes as $attr) {
                    $array[$attr] = $translation[$attr];
                }
                $data[$key] = $array;
            }
        }

        if ($fieldData['image'] && strlen($fieldData['image']) > 50 && strstr($fieldData['image'], 'data')) {
            $image = json_decode(json_encode($fieldData['image']), FALSE);
            $unique = md5(Carbon::now());

            $this->imageRepository->imageStore($item, $image, $image, $unique, 'image');

            $data['image'] = $unique;
        }

        $item->update($data);
    }

    public function destroy($id, $model)
    {
        $item = $model::findOrFail($id);
        if ($item->translatedAttributes) {
            $item->deleteTranslations();
        }
        $item->delete();
        return response()->json(compact('item'));
    }

    public function destroyList($request, $model)
    {
        $ids = explode(',', $request->get('ids'));
        $items = [];
        for ($i = 0; $i < count($ids); $i++) {
            $item = $model::findOrFail($ids[$i]);
            if ($item->translatedAttributes) {
                $item->deleteTranslations();
            }
            $item->delete();
            $items[] = $item;
        }
        return response()->json(compact('items'));
    }
}