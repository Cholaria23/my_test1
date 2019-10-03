<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Serial;

class SerialTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'content', 'seo_title', 'seo_description', 'seo_keywords'
    ];

    public function entity()
    {
        return $this->belongsTo(Serial::class);
    }
}
