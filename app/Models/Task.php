<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Trainer\TaskController;

class Task extends Model
{
    protected $fillable = ['description', 'lesson_id', 'max_point'];
    public $timestamps = false;

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }
}
