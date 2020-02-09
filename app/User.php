<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password',
        'user_type' , 'photo' , 'birthday',
        'is_completed'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $attributes = [
        'is_completed' => 0
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function competitions() {
        return $this->hasMany(Competition::class);
    }
}
