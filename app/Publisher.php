<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{

    protected $fillable = [
        'fullname', 'school', 'title',
        'photo'
    ];


    public function contents() {
        return $this->hasMany(Content::class);
    }
}
