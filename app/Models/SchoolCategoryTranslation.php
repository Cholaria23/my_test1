<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SchoolCategory;

class SchoolCategoryTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'seo-title-1',
        'seo-title-2',
        'description',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    public function entity()
    {
        return $this->belongsTo(SchoolCategory::class);
    }
}
