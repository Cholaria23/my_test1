<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Review extends Model
{
    use SoftDeletes;

    protected $table = 'reviews';

    protected $fillable = ['id', 'name', 'phone', 'service', 'rating', 'content', 'publish', 'commentable_id', 'commentable_type'];

    protected $softDelete = true;

    public function commentable()
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
}
