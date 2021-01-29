<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    }

    public function getLesson($c_id, $l_id)
    {
        $vars = [];
        $vars['course'] = Course::with('lessons')->where('id', $c_id)->first();
        $vars['lesson'] = $vars['course']->lessons->where('id', $l_id)->first();
        $this->template = 'members.lesson';
        return $this->renderOutput($vars);
    }
}
