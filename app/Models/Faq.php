<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\FaqTranslation;

class Faq extends Model
{
    use Translatable, SoftDeletes;

    protected $table = 'faq';

    public $translationsTable = 'faq_translations';

    protected $fillable = [
        'id', 'publish'
    ];

    public  $translatedAttributes = ['question', 'answer'];

    protected $with = ['translations'];

    protected $softDelete = true;

    public function translations() {
        return $this->hasMany(FaqTranslation::class)->withTrashed();
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

    public function getUrlAttribute()
    {
        return route('workplace.show', $this->slug);
    }
}
