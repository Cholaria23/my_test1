<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\School;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'country',
        'city',
        'description',
        'content',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    public function entity()
    {
        return $this->belongsTo(School::class);
    }
}
