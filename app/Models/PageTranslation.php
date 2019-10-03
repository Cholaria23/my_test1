<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Page;

class PageTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'seo_title', 'seo_description', 'seo_keywords','seo_title_manicure','seo_description_manicure',
        'seo_title_pedicure','seo_description_pedicure','seo_title_make_up','seo_description_make_up','seo_title_cosmetology','seo_description_cosmetology'
    ];

    public function entity()
    {
        return $this->belongsTo(Page::class);
    }
}
