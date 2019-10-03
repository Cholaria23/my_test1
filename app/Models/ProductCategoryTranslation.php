<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductCategory;

class ProductCategoryTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'seo_title', 'seo_description', 'seo_keywords'
    ];

    public function entity()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
