<?php

namespace App\Models;

use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Models\ArticleTranslation;
use Carbon\Carbon;

class Article extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'articles';

    public $translationsTable = 'article_translations';

    protected $fillable = [
        'id', 'slug', 'image', 'views', 'article_category_id', 'publish', 'created_at'
    ];

    public $translatedAttributes = ['title', 'content', 'short_text', 'seo_title', 'seo_description', 'seo_keywords'];

    public $images = [
        'image' => [
            'thumbImage'
        ]
    ];

    protected $appends = [
        'original_image_url',
        'thumb_image_url'
    ];

    protected $with = ['category', 'translations'];

    protected $softDelete = true;

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function translations()
    {
        return $this->hasMany(ArticleTranslation::class)->withTrashed();
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

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePublish($query)
    {
        return $query->where('publish', true);
    }

    public function scopeFilterByCategory($query, $id)
    {
        return $query->where('article_category_id', $id);
    }

    public function getOriginalImageUrlAttribute()
    {
        return ImageRepository::getImageOrHolder($this, 'image', 'original', 'article-placeholder');
    }

    public function getThumbImageUrlAttribute()
    {
        return ImageRepository::getImageOrHolder($this, 'image', 'thumb', 'article-placeholder');
    }

    public function getUrlAttribute()
    {
        return route('article', ['slug' => $this->slug]);
    }
}
