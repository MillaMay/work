<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = ['name', 'avatar', 'email', 'phone', 'password', 'department'];
    public $timestamps = false;

    public function courses()
    {
        return $this->hasMany('App\Models\Course');
    }
}
