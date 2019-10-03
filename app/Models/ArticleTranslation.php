<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Article;

class ArticleTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'content', 'short_text', 'seo_title', 'seo_description', 'seo_keywords'
    ];

    public function entity()
    {
        return $this->belongsTo(Article::class);
    }
}
