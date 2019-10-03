<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Role extends Model
{

    protected $table = 'roles';

    protected $fillable = [
        'name', 'title'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
