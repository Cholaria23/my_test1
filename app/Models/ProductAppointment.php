<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAppointmentTranslation;

class ProductAppointment extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'product_appointments';

    public $translationsTable = 'product_appointment_translations';

    protected $fillable = [
        'id',
        'icon_color'
    ];

    public $translatedAttributes = ['title'];

    protected $with = ['translations'];

    protected $softDelete = true;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function translations()
    {
        return $this->hasMany(ProductAppointmentTranslation::class)->withTrashed();
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
