<?php

namespace App\Http\Controllers\Trainers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Lesson;

use Lang;
use Document;
use Validator;

class TestController extends BaseController
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
        if (request('lesson_id')) { // ? Это нужно, если нет "своего" метода
            $lesson = Lesson::with('course')->find(request('lesson_id'));
            Document::setBreadcrumb(Lang::get('courses.title'), route('courses.index'));
            Document::setBreadcrumb($lesson->course->title, route('courses.edit', $lesson->course->id));
            Document::setBreadcrumb(Lang::get('lessons.title'), route('lessons.index',['course_id' => $lesson->course->id]));
            Document::setBreadcrumb($lesson->title, route('lessons.edit', request('lesson_id')));
            Document::setBreadcrumb(Lang::get('tests.title'), route('tests.index'));
            $vars['tests'] = Test::with('lesson')->where('lesson_id', request('lesson_id'))->paginate(10);
            $vars['lesson_id'] = request('lesson_id');
        }else {
            Document::setBreadcrumb(Lang::get('tests.title'), route('tests.index'));
            $vars['route_create'] = route('tests.create');
            $vars['tests'] = Test::with('lesson')->paginate(10);
        }

        $this->template = 'trainers.tests.list';

        return $this->renderOutput()->with($vars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vars['route'] = 'tests.store';
        $vars['title_form'] = Lang::get('tests.title_add');
        $vars['title_button'] = Lang::get('main.add');
        $vars['test'] = new Test();
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
        } //['lessons'] -> массив, в который вкладывается массив -> [$lesson->id]

        Document::setBreadcrumb(Lang::get('tests.title_add'), route('tests.create'));
        $this->template = 'trainers.tests.form';

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
            'title' => 'required',
            'time' => 'required',
            'count_samples' => 'required',
            'checkpoint' => 'required',
            'max_point' => 'required',
            'lesson_id' => 'required',
        ], [
            'title.required' => Lang::get('tests.message_title_field'),
            'time.required' => Lang::get('tests.message_time_field'),
            'count_samples.required' => Lang::get('tests.message_count_samples_field'),
            'checkpoint.required' => Lang::get('tests.message_checkpoint_field'),
            'max_point.required' => Lang::get('tests.message_max_point_field'),
            'lesson_id.required' => Lang::get('tests.message_lesson_id_field'),
        ]);

        if($validator->fails()) {

            return redirect()->route('tests.create')->withErrors($validator)->withInput();

        } else {
            Test::insert([
                'title' => $request->title,
                'time' => $request->time,
                'count_samples' => $request->count_samples,
                'checkpoint' => $request->checkpoint,
                'max_point' => $request->max_point,
                'lesson_id' => $request->lesson_id,
            ]);

//            if (strpos(URL::previous(), 'lessons')) { //Это нужно для своего метода
//                return redirect()->route('tests', $request->lesson_id)->with('message.success', Lang::get('tests.success_add_test'));
//            } //Чтобы был редирект на материалы урока, чей lesson_id

            return redirect()->route('tests.index', ['lesson_id' => $request->lesson_id])->with('message.success', Lang::get('tests.success_add_test'));
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
        $vars['route'] = 'tests.update';
        $vars['title_form'] = Lang::get('tests.title_edit');
        $vars['title_button'] = Lang::get('main.save');
        $vars['test'] = Test::find($id);
        $lesson = Lesson::with('course')->where('id', $vars['test']->lesson_id)->first();
//        $vars['lessons'] = Lesson::all();
        Document::setBreadcrumb(Lang::get('courses.title'), route('courses.index'));
        Document::setBreadcrumb($lesson->course->title, route('courses.edit', $lesson->course->id));
        Document::setBreadcrumb(Lang::get('lessons.title'), route('lessons.index', ['course_id' => $lesson->course->id]));
        Document::setBreadcrumb($lesson->title, route('lessons.edit', $lesson->id));
        Document::setBreadcrumb(Lang::get('tests.title_edit'), route('tests.edit', $id));

        $lessons = Lesson::with('course')->get();
        foreach ($lessons as $lesson){
            $vars['lessons'][$lesson->id] = $lesson->course->title . ' -> ' . $lesson->title;
        }

        $this->template = 'trainers.tests.form';

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
            'title' => 'required',
            'time' => 'required',
            'count_samples' => 'required',
            'checkpoint' => 'required',
            'max_point' => 'required',
            'lesson_id' => 'required',
        ], [
            'title.required' => Lang::get('tests.message_title_field'),
            'time.required' => Lang::get('tests.message_time_field'),
            'count_samples.required' => Lang::get('tests.message_count_samples_field'),
            'checkpoint.required' => Lang::get('tests.message_checkpoint_field'),
            'max_point.required' => Lang::get('tests.message_max_point_field'),
            'lesson_id.required' => Lang::get('tests.message_lesson_id_field'),
        ]);

        if($validator->fails()) {

            return redirect()->route('tests.create')->withErrors($validator)->withInput();

        } else {
            Test::whereId($id)->update([
                'title' => $request->title,
                'time' => $request->time,
                'count_samples' => $request->count_samples,
                'checkpoint' => $request->checkpoint,
                'max_point' => $request->max_point,
                'lesson_id' => $request->lesson_id,
            ]);

            return redirect()->route('tests.index', ['lesson_id' => $request->lesson_id])->with('message.success', Lang::get('tests.success_update_test'));
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
            Test::destroy(explode(',', $id));
            return redirect()->route('tests.index', ['lesson_id' => $lesson->id])->with('message.success', Lang::get('main.success_delete'));
        } else {
            Test::destroy(explode(',', $id));
            return redirect()->route('tests.index')->with('message.success', Lang::get('main.success_delete'));
        }
    }
}
