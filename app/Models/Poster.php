<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\PosterCategory;
use App\Models\PosterTranslation;

class Poster extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'posters';

    public $translationsTable = 'poster_translations';

    protected $fillable = [
        'id', 'slug', 'poster_category_id', 'publish'
    ];

    public $translatedAttributes = ['title', 'content', 'seo_title', 'seo_description', 'seo_keywords'];

    protected $with = ['category', 'translations'];

    protected $softDelete = true;

    public function category()
    {
        return $this->belongsTo(PosterCategory::class, 'poster_category_id');
    }

    public function translations()
    {
        return $this->hasMany(PosterTranslation::class)->withTrashed();
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

    public function getUrlAttribute()
    {
        return route('article.show', $this->slug);
    }

}
