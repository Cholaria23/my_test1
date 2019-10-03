<?php

namespace App\Models;

use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\AttributeCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\AttributeTranslation;
use Carbon\Carbon;

class Attribute extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'attributes';

    public $translationsTable = 'attribute_translations';

    protected $fillable = [
        'id', 'image', 'attribute_category_id', 'thumb_size'
    ];

    public $translatedAttributes = ['title'];

    public $images = [
        'image' => [
            'attrImage',
            'attr2Image',
        ]
    ];

    protected $appends = [
        'original_image_url',
        'thumb_image_url',
        'thumb2_image_url',
    ];

    protected $with = ['category', 'translations'];

    protected $softDelete = true;

    public function category()
    {
        return $this->belongsTo(AttributeCategory::class, 'attribute_category_id');
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'attribute_to_product',
            'attribute_id',
            'product_id'
        );
    }

    public function translations()
    {
        return $this->hasMany(AttributeTranslation::class)->withTrashed();
    }

    public function scopeSearch($query, Request $request)
    {
        if ($request->has('query')) {
            $query->where('title', 'LIKE', '%' . $request->get('query') . '%');
        }
        return $query;
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
        return ImageRepository::getImageOrHolder($this, 'image', 'original', 'attr-placeholder');
    }

    public function getThumbImageUrlAttribute()
    {
        return ImageRepository::getImageOrHolder($this, 'image', 'attr', 'attr-placeholder');
    }

    public function getThumb2ImageUrlAttribute()
    {
        return ImageRepository::getImageOrHolder($this, 'image', 'attr2', 'attr-placeholder');
    }
}
