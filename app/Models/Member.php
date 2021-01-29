<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Trainer\MemberController;

class Member extends Model
{
    protected $fillable = ['name', 'avatar', 'email', 'phone', 'password', 'city', 'store', 'post', 'type'];
    public $timestamps = false;

    public function courses()
    {
        return $this->hasManyThrough('App\Models\Course', 'App\Models\MemberCourse', 'member_id', 'id', 'id', 'course_id')->with('lessons','trainer');
    }

    //Для seed
    public function seedCourses()
    {
        return $this->hasMany('App\Models\MemberCourse');
    }

    public function materials()
    {
        return $this->hasMany('App\Models\Material');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}
