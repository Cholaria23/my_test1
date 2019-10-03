<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\PageField;
use App\Models\PageTranslation;

class Page extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'pages';

    public $translationsTable = 'page_translations';

    protected $fillable = [
        'id',
        'slug',
        'publish'
    ];

    public $translatedAttributes = ['title', 'seo_title', 'seo_description', 'seo_keywords','seo_title_manicure','seo_description_manicure',
        'seo_title_pedicure','seo_description_pedicure','seo_title_make_up','seo_description_make_up','seo_title_cosmetology','seo_description_cosmetology'
    ];

    protected $with = ['fields', 'translations'];

    protected $softDelete = true;

    public function fields()
    {
        return $this->hasMany(PageField::class)->withTrashed();
    }

    public function translations()
    {
        return $this->hasMany(PageTranslation::class)->withTrashed();
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
