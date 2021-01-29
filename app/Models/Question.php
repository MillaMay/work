<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Trainer\QuestionController;

class Question extends Model
{
    protected $fillable = ['title', 'type', 'test_id'];
    public $timestamps = false;

    public function test()
    {
        return $this->belongsTo('App\Models\Test');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }
}
