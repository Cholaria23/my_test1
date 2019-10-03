<?php

namespace App\Models;

use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\FileCategory;
use App\Models\FileTranslation;
use Carbon\Carbon;

class File extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'files';

    public $translationsTable = 'file_translations';

    protected $fillable = [
        'id', 'icon', 'path', 'url', 'image', 'file_category_id', 'publish'
    ];

    public $translatedAttributes = ['title'];

    public $images = [
        'image' => [
            'thumbImage'
        ]
    ];

    protected $appends = [
        'original_image_url',
        'thumb_image_url'
    ];

    protected $with = ['category', 'translations'];

    protected $softDelete = true;

    public function category()
    {
        return $this->belongsTo(FileCategory::class, 'file_category_id');
    }

    public function translations()
    {
        return $this->hasMany(FileTranslation::class)->withTrashed();
    }

    public function scopeFilter($query, Request $request)
    {
        return $query;
    }

    public function scopeOrder($query, Request $request)
    {
        if ($request->has('orders') && is_array($request->get('orders'))) {
            foreach ($request->get('orders') as $order) {
                $query->orderBy($order['field'], $order['order']);
            }
        }
        return $query;
    }

    public function getOriginalImageUrlAttribute()
    {
        return ImageRepository::getImageOrHolder($this, 'image', 'original', 'article-placeholder');
    }

    public function getThumbImageUrlAttribute()
    {
        return ImageRepository::getImageOrHolder($this, 'image', 'thumb', 'article-placeholder');
    }
}
