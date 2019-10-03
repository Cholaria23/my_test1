<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\CourseTranslation;
use App\Models\School;

class Course extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'courses';

    public $translationsTable = 'course_translations';

    protected $fillable = [
        'id', 'slug', 'link', 'school_id', 'start_time', 'publish', 'created_at'
    ];

    public  $translatedAttributes = ['title', 'content', 'duration', 'price', 'seo_title', 'seo_description', 'seo_keywords'];

    protected $with = ['translations'];

    protected $softDelete = true;

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function translations() {
        return $this->hasMany(CourseTranslation::class)->withTrashed();
    }

    public function scopePublish($query)
    {
        return $query->where('publish', true);
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
