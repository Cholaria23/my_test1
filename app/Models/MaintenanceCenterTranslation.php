<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MaintenanceCenter;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceCenterTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'content'
    ];

    public function entity()
    {
        return $this->belongsTo(MaintenanceCenter::class);
    }
}
