<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'content', 'duration', 'price', 'seo_title', 'seo_description', 'seo_keywords'
    ];

    public function entity()
    {
        return $this->belongsTo(Course::class);
    }
}
