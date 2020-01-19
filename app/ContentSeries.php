<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ContentSeries extends Model
{
    protected $fillable = [
        'series_name', 'link', 'cover'
    ];

    public function deleteImage() {
        Storage::delete($this->image);
    }

    public function content() {
        return $this->belongsTo(Content::class);
    }

}
