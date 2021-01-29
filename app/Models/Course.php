<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Trainer\CourseController;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'trainer_id', 'logo'];
    public $timestamps = false;

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson')->with('materials','tests','tasks');
    }
    public function trainer()
    {
        return $this->hasOne('App\Models\Trainer','id','trainer_id');
    }

    public function members()
    {
        return $this->hasManyThrough('App\Models\Member', 'App\Models\MemberCourse', 'course_id', 'id', 'id', 'member_id');
    }
}
