<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\SerialTranslation;
use App\Models\ProductCategory;
use App\Models\Product;

class Serial extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'serials';

    public $translationsTable = 'serial_translations';

    protected $fillable = [
        'id', 'type', 'slug'
    ];

    public $translatedAttributes = ['title', 'content', 'seo_title', 'seo_description', 'seo_keywords'];

    protected $with = ['translations'];

    protected $softDelete = true;

    public function translations()
    {
        return $this->hasMany(SerialTranslation::class);
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function categoriesCustomOrder()
    {
        return $this->hasMany(ProductCategory::class)->customOrder();
    }

//    public function products()
//    {
//        return $this->hasManyThrough(Product::class, ProductCategory::class);
//    }

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

    public function scopePro($query)
    {
        return $query->where('type', 'pro');
    }

    public function scopeStandart($query)
    {
        return $query->where('type', 'standart');
    }
}
