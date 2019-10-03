<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\MaintenanceCenterTranslation;
use App\Models\Review;
use App\Models\City;

class MaintenanceCenter extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'maintenance_centers';

    public $translationsTable = 'maintenance_center_translations';

    protected $fillable = [
        'id', 'publish', 'authorized', 'city_id'
    ];

    protected $appends = [
        'rating',
        'published_reviews'
    ];

    public  $translatedAttributes = ['title', 'content'];

    protected $with = ['translations', 'city'];

    protected $softDelete = true;

    public function translations() {
        return $this->hasMany(MaintenanceCenterTranslation::class)->withTrashed();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function reviews()
    {
        return $this->morphMany('App\Models\Review', 'commentable');
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

    public function scopePublish($query)
    {
        return $query->where('publish', true);
    }

    public function getRatingAttribute()
    {
        $rating = 0;
        $reviews = $this->reviews()->where('publish', true)->get();
        if ($reviews->count()) {
            foreach ($reviews as $review) {
                $rating += $review->rating;
            }
            $rating = round($rating / $reviews->count());
        }
        return $rating;
    }

    public function getPublishedReviewsAttribute()
    {
        return $this->reviews()->where('publish', true)->get();
    }
}
