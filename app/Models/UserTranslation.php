<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'post', 'content'
    ];

    public function entity()
    {
        return $this->belongsTo(User::class);
    }
}
