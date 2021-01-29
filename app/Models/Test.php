<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Trainer\TestController;

class Test extends Model
{
    protected $fillable = ['title', 'time', 'lesson_id'];
    public $timestamps = false;

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson'); //belongsTo - это значит, что Course в Lesson, а если hasOne(), то Lesson в Course.
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question')->with('answers');
    }
}
