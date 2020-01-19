<?php

namespace App;

use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Analytics\Analytics;

class Competition extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $fillable = [
        'user_id', 'organizer', 'title',
        'image', 'description', 'deadline',
        'detail', 'reward', 'fbappid', 'counter'
    ];

    public function deleteImage() {
        Storage::delete($this->image);
    }

    public function user() {
        return $this->belongsTo(User::class);
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
