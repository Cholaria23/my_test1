<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Workplace;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkplaceTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'content', 'seo_title', 'seo_description', 'seo_keywords'
    ];

    public function entity()
    {
        return $this->belongsTo(Workplace::class);
    }
}
