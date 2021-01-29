<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberCourse extends Model
{
    protected $fillable = ['member_id', 'course_id'];
    public $timestamps = false;
}
