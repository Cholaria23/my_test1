<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class FormRequest extends Model
{
    use SoftDeletes;

    protected $table = 'form_requests';

    protected $fillable = [
        'id',
        'subject',
        'email',
        'name',
        'surname',
        'phone',
        'message',
        'file',
        'user_info',
        'country',
        'post',
        'city',
        'company_name',
        'business',
        'web',
        'agree'
    ];

    protected $softDelete = true;

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
