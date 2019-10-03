<?php

namespace App\Models;

use App\Repositories\ImageRepository;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\UserTranslation;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Translatable, SoftDeletes, Notifiable;

    protected $table = 'users';

    public $translationsTable = 'user_translations';

    protected $fillable = [
        'id', 'role_id', 'image', 'facebook', 'viber', 'twitter', 'instagram', 'google', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $images = [
        'image' => [
            'avatarImage'
        ]
    ];

    protected $appends = [
        'original_image_url',
        'avatar_image_url'
    ];

    public $translatedAttributes = ['name', 'post', 'content'];

    protected $with = ['role', 'translations'];

    protected $softDelete = true;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function translations()
    {
        return $this->hasMany(UserTranslation::class)->withTrashed();
    }

    public function isAdmin()
    {
        return $this->role_id == 1;
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
}
