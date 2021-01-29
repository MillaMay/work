<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Trainer\LessonController;

class Lesson extends Model
{
    protected $fillable = ['title', 'description', 'video', 'course_id'];
    public $timestamps = false;

    public function course()
    {
        return $this->belongsTo('App\Models\Course'); //belongsTo - это значит, что Course в Lesson, а если hasOne(), то Lesson в Course.
    }

    // И для seed тоже подходят
    public function materials()
    {
        return $this->hasMany('App\Models\Material')->with('memberMaterial');
    }

    public function tests()
    {
        return $this->hasMany('App\Models\Test');
    }
    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}
