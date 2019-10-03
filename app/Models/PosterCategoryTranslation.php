<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PosterCategory;

class PosterCategoryTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'seo_title', 'seo_description', 'seo_keywords'
    ];

    public function entity()
    {
        return $this->belongsTo(PosterCategory::class);
    }
}
