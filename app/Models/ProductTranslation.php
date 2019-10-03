<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class ProductTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'short_text','short_text_html' ,'video', 'seo_title', 'seo_description', 'seo_keywords'
    ];

    public function entity()
    {
        return $this->belongsTo(Product::class);
    }
}
