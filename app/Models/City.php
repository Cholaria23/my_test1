<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\CityTranslation;
use App\Models\Country;
use App\Models\MaintenanceCenter;

class City extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'cities';

    public $translationsTable = 'city_translations';

    protected $fillable = ['id', 'slug', 'country_id'];

    public $translatedAttributes = ['title'];

    protected $with = ['translations', 'country'];

    protected $softDelete = true;

    public function translations()
    {
        return $this->hasMany(CityTranslation::class)->withTrashed();
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function maintenanceCenters()
    {
        return $this->hasMany(MaintenanceCenter::class);
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
