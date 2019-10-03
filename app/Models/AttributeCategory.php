<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeCategoryTranslation;

class AttributeCategory extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'attribute_categories';

    public $translationsTable = 'attribute_category_translations';

    protected $fillable = [
        'id', 'type', 'label', 'is_linked'
    ];

    public $translatedAttributes = ['title'];

    protected $with = ['translations'];

    protected $softDelete = true;

    public function attrs()
    {
        return $this->hasMany(Attribute::class);
    }

    public function translations()
    {
        return $this->hasMany(AttributeCategoryTranslation::class)->withTrashed();
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
