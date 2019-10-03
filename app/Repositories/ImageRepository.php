<?php

namespace App\Repositories;

use Approached\LaravelImageOptimizer\ImageOptimizer;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageRepository
{

    private $unique;
    private $old;
    private $original;
    private $cropped;
    private $degree;
    private $path;
    private $extension = 'jpg';

    /**
     * @param $model
     * @param $original
     * @param $cropped
     * @param $unique
     * @param string $column
     * @param int $degree
     */
    public function imageStore($model, $original, $cropped, $unique, $column = 'image', $degree = 0, $extension = 'jpg')
    {

        $this->unique = $unique;
        $this->column = $column;
        $this->old = $model->$column;
        $this->degree = $degree;
        $this->extension = $extension;


        $this->original = Image::make($original);
        $this->cropped = Image::make($cropped);


        $this->path = public_path('upload' . DIRECTORY_SEPARATOR . $model->getTable() . DIRECTORY_SEPARATOR . $model->created_at->format('Y/m/d') . DIRECTORY_SEPARATOR . $model->id . DIRECTORY_SEPARATOR . $this->column);

        if ($this->old) {
            File::delete($this->path . '/original-' . $this->old . '.' . $this->extension);
        }

        if (!File::exists($this->path)) {
            File::makeDirectory($this->path, $mode = 0777, true, true);
        }

        $this->original->encode($this->extension, 100)->rotate($this->degree)->save($this->path . '/original-' . $this->unique . '.' . $this->extension)->backup();
        $this->optimise($this->path . '/original-' . $this->unique . '.' . $this->extension);

        $this->cropped->encode($this->extension, 100)->backup();

        if (array_key_exists($column, $model->images)) {
            foreach ($model->images[$column] as $function) {
                if (method_exists($this, $function)) {
                    $this->$function();
                }
            }
        }
        if ($this->original) {
            $this->original->destroy();
        }

//        if($this->cropped) {
//            $this->cropped->destroy();
//        }

    }

    public function optimise($path)
    {
        $imageOptimizer = new ImageOptimizer();
        $imageOptimizer->optimizeImage($path);
    }

    public function imageDelete($model, $column = 'image')
    {
        $path = public_path('upload' . DIRECTORY_SEPARATOR . $model->getTable() . DIRECTORY_SEPARATOR . $model->created_at->format('Y/m/d') . DIRECTORY_SEPARATOR . $model->id . DIRECTORY_SEPARATOR . $column);
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
    }

    public static function imagesDeleteStatic($model)
    {
        if (isset($model->images)) {
            foreach (array_keys($model->images) as $column) {
                $path = public_path('upload' . DIRECTORY_SEPARATOR . $model->getTable() . DIRECTORY_SEPARATOR . $model->created_at->format('Y/m/d') . DIRECTORY_SEPARATOR . $model->id . DIRECTORY_SEPARATOR . $column);
                if (File::exists($path)) {
                    File::deleteDirectory($path);
                }
            }
        }
    }

    public static function getImageOrHolder($model, $column, $size, $holder = 'placeholder')
    {
        $file = 'upload' . '/' . $model->getTable() . '/' . $model->created_at->format('Y/m/d') . '/' . $model->id . '/' . $column . '/' . $size . '-' . $model->$column . '.jpg';
        if (File::exists(public_path($file))) {
            return asset($file);
        }

        $file = 'upload' . '/' . $model->getTable() . '/' . $model->created_at->format('Y/m/d') . '/' . $model->id . '/' . $column . '/' . $size . '-' . $model->$column . '.png';
        if (File::exists(public_path($file))) {
            return asset($file);
        }

        return asset('/frontend/img/placeholders/' . $holder . '.jpg');
    }

    public static function getImagePatch($model, $column, $size)
    {
        $file = 'upload' . '/' . $model->getTable() . '/' . $model->created_at->format('Y/m/d') . '/' . $model->id . '/' . $column . '/' . $size . '-' . $model->$column . '.jpg';
        if (File::exists(public_path($file))) {
            return public_path($file);
        }
    }

    public function thumbImage()
    {
        if ($this->old) {
            File::delete($this->path . '/thumb-' . $this->old . '.' . $this->extension);
        }

        $path = $this->path . '/thumb-' . $this->unique . '.' . $this->extension;

        $this->cropped
            ->encode($this->extension, 85)
            ->fit(500, 350)
            ->save($path)
            ->reset();

        $this->optimise($path);
    }

    public function avatarImage()
    {
        if ($this->old) {
            File::delete($this->path . '/avatar-' . $this->old . '.' . $this->extension);
        }

        $path = $this->path . '/avatar-' . $this->unique . '.' . $this->extension;

        $this->cropped
            ->encode($this->extension, 85)
            ->fit(200, 200)
            ->save($path)
            ->reset();

        $this->optimise($path);
    }

    public function attrImage()
    {
        if ($this->old) {
            File::delete($this->path . '/attr-' . $this->old . '.' . $this->extension);
        }

        $path = $this->path . '/attr-' . $this->unique . '.' . $this->extension;

        $this->cropped
            ->encode($this->extension, 70)
            ->fit(60, 60)
            ->save($path)
            ->reset();

        $this->optimise($path);
    }

    public function attr2Image()
    {
        if ($this->old) {
            File::delete($this->path . '/attr2-' . $this->old . '.' . $this->extension);
        }

        $path = $this->path . '/attr2-' . $this->unique . '.' . $this->extension;

        $this->cropped
            ->encode($this->extension, 70)
            ->fit(180, 60)
            ->save($path)
            ->reset();

        $this->optimise($path);
    }

    public function prodImage()
    {
        if ($this->old) {
            File::delete($this->path . '/prod-' . $this->old . '.' . $this->extension);
        }

        $path = $this->path . '/prod-' . $this->unique . '.' . $this->extension;

        $this->cropped
            ->encode($this->extension, 85)
            ->fit(340, 250)
            ->save($path)
            ->reset();

        $this->optimise($path);
    }

    public function productImage()
    {
        if ($this->old) {
            File::delete($this->path . '/product-' . $this->old . '.' . $this->extension);
        }

        $path = $this->path . '/product-' . $this->unique . '.' . $this->extension;

        $this->cropped
            ->encode($this->extension, 85)
            ->fit(924, 936)
            ->save($path)
            ->reset();

        $this->optimise($path);
    }
}