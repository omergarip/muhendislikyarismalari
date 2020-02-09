<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use Sluggable;
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'cover', 'series_link',
        'text', 'status', 'fbappid',
        'title', 'page_title', 'publisher_id',
        'description'
    ];

    public function series() {
        return $this->hasMany(ContentSeries::class);
    }

    public function publisher() {
        return $this->belongsTo(Publisher::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
