<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\File;

class FileTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title'
    ];

    public function entity()
    {
        return $this->belongsTo(File::class);
    }
}
