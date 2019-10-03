<?php

namespace App\Models;

use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Picture extends Model
{

    protected $table = 'pictures';

    protected $fillable = [
        'id', 'image', 'entity_type', 'entity_id'
    ];

    public $images = [
        'image' => [
            'productImage'
        ]
    ];

    protected $appends = [
        'original_image_url',
        'thumb_image_url',
    ];

    public function entity()
    {
        return $this->morphTo();
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
        return ImageRepository::getImageOrHolder($this, 'image', 'original', 'product-placeholder');
    }

    public function getThumbImageUrlAttribute()
    {
        return ImageRepository::getImageOrHolder($this, 'image', 'product', 'product-placeholder');
    }
}
