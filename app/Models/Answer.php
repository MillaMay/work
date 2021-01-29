<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['title', 'correctly', 'question_id'];
    public $timestamps = false;

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
}
//У этой модели контроллер QuestionController
