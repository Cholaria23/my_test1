<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\File;

class FaqTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'question', 'answer'
    ];

    public function entity()
    {
        return $this->belongsTo(File::class);
    }
}
