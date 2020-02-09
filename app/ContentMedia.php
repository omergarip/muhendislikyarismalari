<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentMedia extends Model
{
    protected $fillable = [
        'image', 'content_id'
    ];
}
