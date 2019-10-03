<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\ServiceCenterTranslation;

class ServiceCenter extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'service_centers';

    public $translationsTable = 'service_center_translations';

    protected $fillable = [
        'id', 'publish'
    ];

    public  $translatedAttributes = ['title', 'address', 'schedule', 'phones'];

    protected $with = ['translations'];

    protected $softDelete = true;

    public function translations() {
        return $this->hasMany(ServiceCenterTranslation::class)->withTrashed();
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
}
