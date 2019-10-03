<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\SchoolCategoryTranslation;
use App\Repositories\ImageRepository;

class SchoolCategory extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'school_categories';

    public $translationsTable = 'school_category_translations';

    protected $fillable = [
        'id',
        'slug',
        'image_color',
    ];

    public $translatedAttributes = [
        'title',
        'seo-title-1',
        'seo-title-2',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    protected $with = ['translations'];

    protected $softDelete = true;

    public function schools()
    {
        return $this->belongsToMany(
            School::class,
            'school_to_school_category',
            'school_category_id',
            'school_id');
    }

    public function translations()
    {
        return $this->hasMany(SchoolCategoryTranslation::class)->withTrashed();
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

    public function scopeCustomOrder($query)
    {
        return $query->orderBy('order_num', 'asc');
    }
}
