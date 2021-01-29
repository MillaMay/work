<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeworkController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    }

    public function getHomeWork($c_id, $h_id)
    {
        $vars = [];
        $vars['course'] = Course::with('lessons')->where('id', $c_id)->first();
        $this->template = 'members.homework';
        return $this->renderOutput($vars);
    }
}
