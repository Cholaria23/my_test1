<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Poster;
use App\Models\PosterCategoryTranslation;

class PosterCategory extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'poster_categories';

    public $translationsTable = 'poster_category_translations';

    protected $fillable = [
        'id',
        'slug',
        'publish'
    ];

    public $translatedAttributes = ['title', 'seo_title', 'seo_description', 'seo_keywords'];

    protected $with = ['translations'];

    protected $softDelete = true;

    public function posters()
    {
        return $this->hasMany(Poster::class);
    }

    public function translations()
    {
        return $this->hasMany(PosterCategoryTranslation::class)->withTrashed();
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
