<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PageFieldTranslation;

class PageField extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'page_fields';

    public $translationsTable = 'page_field_translations';

    protected $fillable = [
        'id',
        'advanced_name',
        'advanced_type',
        'image',
        'page_id',
    ];

    public $translatedAttributes = ['string', 'text'];

    protected $with = ['translations'];

    protected $softDelete = true;

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function translations()
    {
        return $this->hasMany(PageFieldTranslation::class)->withTrashed();
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
