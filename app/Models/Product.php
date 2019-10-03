<?php

namespace App\Models;

use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductAppointment;
use App\Models\ProductTranslation;
use App\Models\Article;
use App\Models\Attribute;
use App\Models\Picture;

class Product extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'products';

    public $translationsTable = 'product_translations';

    protected $fillable = [
        'id',
        'views',
        'slug',
        'model',
        'sku',
        'preview_image_1',
        'preview_image_2',
        'is_set',
        'is_new',
        'is_old',
        'buy_link_ua',
        'buy_link_ru',
        'publish',
        'product_category_id'
    ];

    public $translatedAttributes = ['title', 'short_text','short_text_html', 'video', 'seo_title', 'seo_description', 'seo_keywords'];

    public $images = [
        'preview_image_1' => [
            'prodImage',
        ],
        'preview_image_2' => [
            'prodImage',
        ]
    ];

    protected $appends = [
        'original_preview_image_1_url',
        'thumb_preview_image_1_url',
        'original_preview_image_2_url',
        'thumb_preview_image_2_url',
        'appointments_ids',
        'countries_ids',
        'articles_ids',
        'attributes_ids',
        'products_ids',
        'is_pro',
    ];

    public $belongsToMany = [
        'appointments_ids',
        'countries_ids',
        'articles_ids',
        'attributes_ids',
        'products_ids',
    ];

    public $morphMany = [
        'pictures'
    ];

    protected $with = ['translations', 'category', 'appointments', 'pictures', 'attrs', 'products'];

    protected $softDelete = true;

    public function pictures()
    {
        return $this->morphMany(Picture::class, 'entity');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function appointments()
    {
        return $this->belongsToMany(
            ProductAppointment::class,
            'appointment_to_product',
            'product_id',
            'appointment_id');
    }

    public function countries()
    {
        return $this->belongsToMany(
            Country::class,
            'country_to_product',
            'product_id',
            'country_id');
    }

    public function articles()
    {
        return $this->belongsToMany(
            Article::class,
            'article_to_product',
            'product_id',
            'article_id');
    }

    public function attrs()
    {
        return $this->belongsToMany(
            Attribute::class,
            'attribute_to_product',
            'product_id',
            'attribute_id');
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_to_product',
            'product_id',
            'child_id');
    }

    public function translations()
    {
        return $this->hasMany(ProductTranslation::class)->withTrashed();
    }

    public function scopeSearch($query, Request $request)
    {
        if ($request->has('query')) {
            $query->where('sku', 'LIKE', '%' . $request->get('query') . '%');
        }
        return $query;
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

    public function scopeNew($query)
    {
        return $query->where('is_new', true);
    }

    public function getOriginalPreviewImage1UrlAttribute()
    {
        return ImageRepository::getImageOrHolder($this, 'preview_image_1', 'original', 'article-placeholder');
    }

    public function getThumbPreviewImage1UrlAttribute()
    {
        return ImageRepository::getImageOrHolder($this, 'preview_image_1', 'prod', 'prod-placeholder');
    }

    public function getOriginalPreviewImage2UrlAttribute()
    {
        return ImageRepository::getImageOrHolder($this, 'preview_image_2', 'original', 'article-placeholder');
    }

    public function getThumbPreviewImage2UrlAttribute()
    {
        return ImageRepository::getImageOrHolder($this, 'preview_image_2', 'prod', 'prod-placeholder');
    }

    public function getUrlAttribute()
    {
        return route('product.show', $this->slug);
    }

    public function getAppointmentsIdsAttribute()
    {
        $array = [];
        foreach ($this->appointments as $appointment) {
            array_push($array, $appointment->id);
        }
        return $array;
    }

    public function getCountriesIdsAttribute()
    {
        $array = [];
        foreach ($this->countries as $country) {
            array_push($array, $country->id);
        }
        return $array;
    }

    public function getArticlesIdsAttribute()
    {
        $array = [];
        foreach ($this->articles as $article) {
            array_push($array, $article->id);
        }
        return $array;
    }

    public function getAttributesIdsAttribute()
    {
        $array = [];
        foreach ($this->attrs as $attribute) {
            array_push($array, $attribute->id);
        }
        return $array;
    }

    public function getIsProAttribute()
    {
        if ($this->category) {
            return $this->category->serial->type;
        }
        return null;
    }

    public function getProductsIdsAttribute()
    {
        $array = [];
        foreach ($this->products as $product) {
            array_push($array, $product->id);
        }
        return $array;
    }
}
