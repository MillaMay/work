<?php

namespace App\Http\Controllers\Trainers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;

//use App\Models\Test; //Свой метод

use Lang;
use Document;
use Validator;

class LessonController extends BaseController
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
        if (request('course_id')) {
            $course = Course::find(request('course_id'));
            Document::setBreadcrumb(Lang::get('courses.title'), route('courses.index'));
            Document::setBreadcrumb($course->title, route('courses.edit', request('course_id')));
            Document::setBreadcrumb(Lang::get('lessons.title'), route('lessons.index'));
            $vars['lessons'] = Lesson::with('course')->where('course_id', request('course_id'))->paginate(10);
            $vars['course_id'] = $course->id;
        } else {
            Document::setBreadcrumb(Lang::get('lessons.title'), route('lessons.index'));
            $vars['lessons'] = Lesson::with('course')->paginate(10);  //Lesson тянет таблицу Course
        }
        $this->template = 'trainers.lessons.list';

        return $this->renderOutput()->with($vars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vars['route'] = 'lessons.store';
        $vars['title_form'] = Lang::get('lessons.title_add');
        $vars['title_button'] = Lang::get('main.add');
        $vars['lesson'] = new Lesson();
        $vars['courses'] = Course::all();//------------------------------------>Для отображения таблицы из модели Course
        if (request('course_id')){
            $vars['course_id'] = request('course_id');
            $course = Course::find(request('course_id'));
            Document::setBreadcrumb(Lang::get('courses.title'), route('courses.index'));
            Document::setBreadcrumb($course->title, route('courses.edit', request('course_id')));
            Document::setBreadcrumb(Lang::get('lessons.title'), route('lessons.index', ['course_id' => $course->id]));
        }
        Document::setBreadcrumb(Lang::get('lessons.title_add'), route('lessons.create'));
        $this->template = 'trainers.lessons.form';

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
            'description' => 'required',
            'course_id' => 'required',
            'video' => 'required',
        ], [
            'title.required' => Lang::get('lessons.message_title_field'),
            'description.required' => Lang::get('lessons.message_description_field'),
            'course_id.required' => Lang::get('lessons.message_course_id_field'),
            'video.required' => Lang::get('lessons.message_video_field'),
        ]);

        if($validator->fails()) {

            return redirect()->route('lessons.create')->withErrors($validator)->withInput();

        } else {
            Lesson::insert([
                'title' => $request->title,
                'description' => $request->description,
                'course_id' => $request->course_id,
                'video' => $request->video,
            ]);

            return redirect()->route('lessons.index', ['course_id' => $request->course_id])->with('message.success', Lang::get('lessons.success_add_lesson'));
        }
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
////    public function show($id)
////    {
//        //
////    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vars['route'] = 'lessons.update';
        $vars['title_form'] = Lang::get('lessons.title_edit');
        $vars['title_button'] = Lang::get('main.save');
        $lesson = Lesson::find($id);
        $vars['lesson'] = $lesson;
        $vars['courses'] = Course::all();
        Document::setBreadcrumb(Lang::get('courses.title'), route('courses.index'));
        Document::setBreadcrumb($lesson->course->title, route('courses.edit', $lesson->course->id));
        Document::setBreadcrumb(Lang::get('lessons.title'), route('lessons.index', ['course_id' => $lesson->course->id]));
        Document::setBreadcrumb(Lang::get('lessons.title_edit'), route('lessons.edit', $id));
        $this->template = 'trainers.lessons.form';

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
            'description' => 'required',
            'course_id' => 'required',
            'video' => 'required',
        ], [
            'title.required' => Lang::get('lessons.message_title_field'),
            'description.required' => Lang::get('lessons.message_description_field'),
            'course_id.required' => Lang::get('lessons.message_course_id_field'),
            'video.required' => Lang::get('lessons.message_video_field'),
        ]);

        if($validator->fails()) {

            return redirect()->route('lessons.create')->withErrors($validator)->withInput();

        } else {
            Lesson::whereId($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'course_id' => $request->course_id,
                'video' => $request->video,
            ]);

            return redirect()->route('lessons.index')->with('message.success', Lang::get('lessons.success_update_lesson'));
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
        if (request('course_id')) {
            $vars['course_id'] = request('course_id');
            $course = Course::find(request('course_id'));
            Lesson::destroy(explode(',', $id));
            return redirect()->route('lessons.index', ['course_id' => $course->id])->with('message.success', Lang::get('main.success_delete'));
        } else {
            Lesson::destroy(explode(',', $id));
            return redirect()->route('lessons.index')->with('message.success', Lang::get('main.success_delete'));
        }
    }

//    public function getTests($lesson_id) //Свой метод
//    {
//        $vars['route_create'] = 'tests/create';
//        $vars['tests'] = Test::where('lesson_id', $lesson_id)->paginate(5);
//        Document::setBreadcrumb(Lang::get('lessons.lesson') . $lesson_id, route('lessons.edit', $lesson_id));
//        Document::setBreadcrumb(Lang::get('lessons.tests'), route('tests', $lesson_id));
//        $this->template = 'trainers.tests.list';
//
//        return $this->renderOutput()->with($vars);
//    }
}
