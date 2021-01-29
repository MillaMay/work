<?php

namespace App\Http\Controllers\Trainers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Lesson;

use Lang;
use Document;
use Validator;

class TaskController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('lesson_id')) {
            $lesson = Lesson::with('course')->find(request('lesson_id'));
            Document::setBreadcrumb(Lang::get('courses.title'), route('courses.index'));
            Document::setBreadcrumb($lesson->course->title, route('courses.edit', $lesson->course->id));
            Document::setBreadcrumb(Lang::get('lessons.title'), route('lessons.index', ['course_id' => $lesson->course->id]));
            Document::setBreadcrumb($lesson->title, route('lessons.edit', request('lesson_id')));
            Document::setBreadcrumb(Lang::get('tasks.title'), route('tasks.index'));
            $vars['tasks'] = Task::with('lesson')->where('lesson_id', request('lesson_id'))->paginate(10);
            $vars['lesson_id'] = request('lesson_id');
        } else {
            Document::setBreadcrumb(Lang::get('tasks.title'), route('tasks.index'));
            $vars['route_create'] = route('tasks.create');
            $vars['tasks'] = Task::with('lesson')->paginate(10);
        }
        $this->template = 'trainers.tasks.list';

        return $this->renderOutput()->with($vars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vars['route'] = 'tasks.store';
        $vars['title_form'] = Lang::get('tasks.title_add');
        $vars['title_button'] = Lang::get('main.add');
        $vars['task'] = new Task();
//        $vars['lessons'] = Lesson::all();
        if (request('lesson_id')) {
            $vars['lesson_id'] = request('lesson_id');
            $lesson = Lesson::with('course')->find(request('lesson_id'));
            Document::setBreadcrumb(Lang::get('courses.title'), route('courses.index'));
            Document::setBreadcrumb($lesson->course->title, route('courses.edit', $lesson->course->id));
            Document::setBreadcrumb(Lang::get('lessons.title'), route('lessons.index'));
            Document::setBreadcrumb($lesson->title, route('lessons.edit', $lesson->id));
        }

        $lessons = Lesson::with('course')->get();
        foreach ($lessons as $lesson){
            $vars['lessons'][$lesson->id] = $lesson->course->title . ' -> ' . $lesson->title;
        }

        Document::setBreadcrumb(Lang::get('tasks.title_add'), route('tasks.create'));
        $this->template = 'trainers.tasks.form';

        return $this->renderOutput()->with($vars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'lesson_id' => 'required',
            'max_point' => 'required',
        ], [
            'description.required' => Lang::get('tasks.message_description_field'),
            'lesson_id.required' => Lang::get('tasks.message_lesson_id_field'),
            'max_point.required' => Lang::get('tasks.message_max_point_field'),
        ]);

        if($validator->fails()) {

            return redirect()->route('tasks.create')->withErrors($validator)->withInput();

        } else {
            Task::insert([
                'description' => $request->description,
                'lesson_id' => $request->lesson_id,
                'max_point' => $request->max_point,
            ]);

            return redirect()->route('tasks.index', ['lesson_id' => $request->lesson_id])->with('message.success', Lang::get('tasks.success_add_task'));
        }
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vars['route'] = 'tasks.update';
        $vars['title_form'] = Lang::get('tasks.title_edit');
        $vars['title_button'] = Lang::get('main.save');
        $vars['task'] = Material::find($id);
        $lesson = Lesson::with('course')->where('id', $vars['task']->lesson_id)->first();
//        $vars['lessons'] = Lesson::all();
        Document::setBreadcrumb(Lang::get('courses.title'), route('courses.index'));
        Document::setBreadcrumb($lesson->course->title, route('courses.edit', $lesson->course->id));
        Document::setBreadcrumb(Lang::get('lessons.title'), route('lessons.index', ['course_id' => $lesson->course->id]));
        Document::setBreadcrumb($lesson->title, route('lessons.edit', $lesson->id));
        Document::setBreadcrumb(Lang::get('tasks.title_edit'), route('tasks.edit', $id));

        $lessons = Lesson::with('course')->get();
        foreach ($lessons as $lesson){
            $vars['lessons'][$lesson->id] = $lesson->course->title . ' -> ' . $lesson->title;
        }

        $this->template = 'trainers.tasks.form';

        return $this->renderOutput()->with($vars);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'lesson_id' => 'required',
            'max_point' => 'required',
        ], [
            'description.required' => Lang::get('tasks.message_description_field'),
            'lesson_id.required' => Lang::get('tasks.message_lesson_id_field'),
            'max_point.required' => Lang::get('tasks.message_max_point_field'),
        ]);

        if($validator->fails()) {

            return redirect()->route('tasks.create')->withErrors($validator)->withInput();

        } else {
            Task::whereId($id)->update([
                'description' => $request->description,
                'lesson_id' => $request->lesson_id,
                'max_point' => $request->max_point,
            ]);

            return redirect()->route('tasks.index', ['lesson_id' => $request->lesson_id])->with('message.success', Lang::get('tasks.success_update_task'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request('lesson_id')) {
            $vars['course_id'] = request('lesson_id');
            $lesson = Lesson::find(request('lesson_id'));
            Task::destroy(explode(',', $id));
            return redirect()->route('tasks.index', ['lesson_id' => $lesson->id])->with('message.success', Lang::get('main.success_delete'));
        } else {
            Task::destroy(explode(',', $id));
            return redirect()->route('tasks.index')->with('message.success', Lang::get('main.success_delete'));
        }
    }
}
