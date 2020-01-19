<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Announcement extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $fillable = [
        'user_id', 'organizer', 'title',
        'image', 'category_slug', 'description', 'deadline',
        'detail', 'reward', 'fbappid', 'counter'
    ];

    public function deleteImage() {
        Storage::delete($this->image);
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
