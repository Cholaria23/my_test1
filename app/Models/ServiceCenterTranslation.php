<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceCenter;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCenterTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'address', 'schedule', 'phones'
    ];

    public function entity()
    {
        return $this->belongsTo(ServiceCenter::class);
    }
}
