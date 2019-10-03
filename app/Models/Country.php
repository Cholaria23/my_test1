<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\CountryCategory;
use App\Models\CountryTranslation;
use App\Models\Product;

class Country extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'countries';

    public $translationsTable = 'country_translations';

    protected $fillable = ['id', 'country_category_id', 'latitude', 'longitude'];

    public $translatedAttributes = ['title'];

    protected $with = ['translations'];

    protected $softDelete = true;

    public function category()
    {
        return $this->hasOne(CountryCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function translations()
    {
        return $this->hasMany(CountryTranslation::class)->withTrashed();
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

    public function scopePublish($query)
    {
        return $query->where('publish', true);
    }
}
