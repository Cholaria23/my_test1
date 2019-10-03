<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PageField;

class PageFieldTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'string',
        'text',
    ];

    public function entity()
    {
        return $this->belongsTo(PageField::class);
    }
}
