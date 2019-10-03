<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategoryTranslation;
use App\Models\Serial;
use App\Models\AttributeCategory;

class ProductCategory extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'product_categories';

    public $translationsTable = 'product_category_translations';

    protected $fillable = [
        'id',
        'slug',
        'serial_id',
        'order_num'
    ];

    public $translatedAttributes = ['title', 'description', 'seo_title', 'seo_description', 'seo_keywords'];

    protected $with = ['translations', 'serial', 'attributeCategories'];

    protected $appends = [
        'attributecategories_ids',
    ];

    public $belongsToMany = [
        'attributecategories_ids',
    ];

    protected $softDelete = true;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function serial()
    {
        return $this->belongsTo(Serial::class, 'serial_id');
    }

    public function attributecategories()
    {
        return $this->belongsToMany(
            AttributeCategory::class,
            'article_to_product',
            'product_id',
            'article_id');
    }

    public function translations()
    {
        return $this->hasMany(ProductCategoryTranslation::class)->withTrashed();
    }

    public function scopeFilter($query, Request $request)
    {
        return $query;
    }

    public function scopeOrder($query, Request $request)
    {
        if ($request->has('orders') && is_array($request->get('orders')) && strstr($request->get('image'), 'data')) {
            foreach ($request->get('orders') as $order) {
                $query->orderBy($order['field'], $order['order']);
            }
        }
        return $query;
    }

    public function getAttributecategoriesIdsAttribute()
    {
        $array = [];
        foreach ($this->attributeCategories as $attributeCategory) {
            array_push($array, $attributeCategory->id);
        }
        return $array;
    }

    public function scopeCustomOrder($query)
    {
        return $query->orderBy('order_num', 'asc');
    }
}
