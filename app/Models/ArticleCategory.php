<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategoryTranslation;

class ArticleCategory extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'article_categories';

    public $translationsTable = 'article_category_translations';

    protected $fillable = [
        'id', 'slug', 'publish'
    ];

    public $translatedAttributes = ['title', 'seo_title', 'seo_description', 'seo_keywords'];

    protected $with = ['translations'];

    protected $softDelete = true;

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function translations()
    {
        return $this->hasMany(ArticleCategoryTranslation::class)->withTrashed();
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

    public function scopePublish($query)
    {
        return $query->where('publish', true);
    }
}
