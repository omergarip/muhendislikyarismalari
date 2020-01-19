<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{

    protected $fillable = [
        'fullname', 'school', 'title'
    ];


    public function contents() {
        return $this->hasMany(Content::class);
    }
}
