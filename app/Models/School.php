<?php

namespace App\Models;

use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\SchoolTranslation;
use App\Models\Course;
use Carbon\Carbon;

class School extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'schools';

    public $translationsTable = 'school_translations';

    protected $fillable = [
        'id',
        'slug',
        'image',
        'facebook',
        'viber',
        'twitter',
        'instagram',
        'google',
        'youtube',
        'vk',
        'website',
        'publish'
    ];

    public $images = [
        'image' => [
            'avatarImage'
        ]
    ];

    protected $appends = [
        'original_image_url',
        'avatar_image_url',
        'schoolcategories_ids'
    ];

    public $translatedAttributes = [
        'title',
        'country',
        'city',
        'description',
        'content',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    protected $with = ['translations', 'schoolCategories', 'courses'];

    protected $softDelete = true;

    public $belongsToMany = [
        'schoolcategories_ids',
    ];

    public function schoolCategories()
    {
        return $this->belongsToMany(
            SchoolCategory::class,
            'school_to_school_category',
            'school_id',
            'school_category_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class)->publish();
    }

    public function translations()
    {
        return $this->hasMany(SchoolTranslation::class)->withTrashed();
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

    public function getOriginalImageUrlAttribute()
    {
        return ImageRepository::getImageOrHolder($this, 'image', 'original', 'user-placeholder');
    }

    public function getAvatarImageUrlAttribute()
    {
        return ImageRepository::getImageOrHolder($this, 'image', 'avatar', 'user-placeholder');
    }

    public function getSchoolcategoriesIdsAttribute()
    {
        $array = [];
        foreach ($this->schoolCategories as $schoolCategory) {
            $array[] = $schoolCategory->id;
        }
        return $array;
    }
}
