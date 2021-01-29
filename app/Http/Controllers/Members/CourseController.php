<?php

namespace App\Http\Controllers\Members;

use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getList()
    {
        $this->template = 'members.course.list';

        $vars['courses'] = $this->vars['user']->courses()->get();
        foreach ($vars['courses'] as $course) {
            $vars['tasks_count'][$course->id] = DB::table('courses')
                        ->leftJoin('lessons', 'lessons.course_id', '=', 'courses.id')
                        ->rightJoin('tasks', 'tasks.lesson_id', '=', 'lessons.id')
                        ->where('courses.id', '=', $course->id)
                        ->count('tasks.id');
            $vars['tests_count'][$course->id] = DB::table('courses')
                        ->leftJoin('lessons', 'lessons.course_id', '=', 'courses.id')
                        ->rightJoin('tests', 'tests.lesson_id', '=', 'lessons.id')
                        ->where('courses.id', '=', $course->id)
                        ->count('tests.id');
        }

        return $this->renderOutput($vars);
    }

    public function getForm($id)
    {
        $this->template = 'members.course';

        $vars['course'] = Course::with('lessons', 'trainer')->where('id', $id)->first();
        return $this->renderOutput($vars);
    }

    public function getRatingCourse($id)
    {
        $vars = [];
        $this->template = 'members.rating';

        $vars['course'] = Course::with('lessons', 'trainer','members')->where('id', $id)->first();
        $vars['user_id'] = session()->get('auth')['user']->id;
        return $this->renderOutput($vars);
    }

}
