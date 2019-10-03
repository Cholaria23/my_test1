<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\CountryCategoryTranslation;

class CountryCategory extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'country_categories';

    public $translationsTable = 'country_category_translations';

    protected $fillable = ['id'];

    public $translatedAttributes = ['title'];

    protected $with = ['translations'];

    protected $softDelete = true;

    public function countries()
    {
        return $this->hasMany(Country::class);
    }

    public function translations()
    {
        return $this->hasMany(CountryCategoryTranslation::class)->withTrashed();
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
}
