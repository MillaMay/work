<?php

namespace App\Http\Controllers\Trainers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Lesson;

use Lang;
use Document;
use Validator;

class MaterialController extends BaseController
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
            Document::setBreadcrumb(Lang::get('materials.title'), route('materials.index'));
            $vars['materials'] = Material::with('lesson')->where('lesson_id', request('lesson_id'))->paginate(10);
            $vars['lesson_id'] = request('lesson_id');
        } else {
            Document::setBreadcrumb(Lang::get('materials.title'), route('materials.index'));
            $vars['route_create'] = route('materials.create');
            $vars['materials'] = Material::with('lesson')->paginate(10);
        }
        $this->template = 'trainers.materials.list';

        return $this->renderOutput()->with($vars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vars['route'] = 'materials.store';
        $vars['title_form'] = Lang::get('materials.title_add');
        $vars['title_button'] = Lang::get('main.add');
        $vars['material'] = new Material();
//        $vars['lessons'] = Lesson::all();
        if (request('lesson_id')) {
            $vars['lesson_id'] = request('lesson_id');
            $lesson = Lesson::with('course')->find(request('lesson_id'));
            Document::setBreadcrumb(Lang::get('courses.title'), route('courses.index'));
            Document::setBreadcrumb($lesson->course->title, route('courses.edit', $lesson->course->id));
            Document::setBreadcrumb(Lang::get('lessons.title'), route('lessons.index'));
            Document::setBreadcrumb($lesson->title, route('lessons.edit', $lesson->id));
        }

        $lessons = Lesson::with('course')->get(); //Тут связаны 3 таблицы
        foreach ($lessons as $lesson) {
            $vars['lessons'][$lesson->id] = $lesson->course->title . ' -> ' . $lesson->title;
        }

        Document::setBreadcrumb(Lang::get('materials.title_add'), route('materials.create'));
        $this->template = 'trainers.materials.form';

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
            'URL' => 'required',
            'lesson_id' => 'required',
            'image' => 'required',
        ], [
            'title.required' => Lang::get('materials.message_title_field'),
            'description.required' => Lang::get('materials.message_description_field'),
            'URL.required' => Lang::get('materials.message_url_field'),
            'lesson_id.required' => Lang::get('materials.message_lesson_id_field'),
            'image.required' => Lang::get('materials.message_image_field'),
        ]);

        if($validator->fails()) {

            return redirect()->route('materials.create')->withErrors($validator)->withInput();

        } else {
            Material::insert([
                'title' => $request->title,
                'description' => $request->description,
                'URL' => $request->URL,
                'lesson_id' => $request->lesson_id,
                'image' => $request->image,
            ]);

            return redirect()->route('materials.index', ['lesson_id' => $request->lesson_id])->with('message.success', Lang::get('materials.success_add_material'));
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
        $vars['route'] = 'materials.update';
        $vars['title_form'] = Lang::get('materials.title_edit');
        $vars['title_button'] = Lang::get('main.save');
        $vars['material'] = Material::find($id);
        $lesson = Lesson::with('course')->where('id', $vars['material']->lesson_id)->first();
        Document::setBreadcrumb(Lang::get('courses.title'), route('courses.index'));
        Document::setBreadcrumb($lesson->course->title, route('courses.edit', $lesson->course->id));
        Document::setBreadcrumb(Lang::get('lessons.title'), route('lessons.index', ['course_id' => $lesson->course->id]));
        Document::setBreadcrumb($lesson->title, route('lessons.edit', $lesson->id));
        Document::setBreadcrumb(Lang::get('materials.title_edit'), route('materials.edit', $id));

        $lessons = Lesson::with('course')->get();
        foreach ($lessons as $lesson){
            $vars['lessons'][$lesson->id] = $lesson->course->title . ' -> ' . $lesson->title;
        }

        $this->template = 'trainers.materials.form';

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
            'URL' => 'required',
            'lesson_id' => 'required',
            'image' => 'required',
        ], [
            'title.required' => Lang::get('materials.message_title_field'),
            'description.required' => Lang::get('materials.message_description_field'),
            'URL.required' => Lang::get('materials.message_url_field'),
            'lesson_id.required' => Lang::get('materials.message_lesson_id_field'),
            'image.required' => Lang::get('materials.message_image_field'),
        ]);

        if($validator->fails()) {

            return redirect()->route('materials.create')->withErrors($validator)->withInput();

        } else {
            Material::whereId($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'URL' => $request->URL,
                'lesson_id' => $request->lesson_id,
                'image' => $request->image,
            ]);

            return redirect()->route('materials.index', ['lesson_id' => $request->lesson_id])->with('message.success', Lang::get('materials.success_update_material'));
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
            Material::destroy(explode(',', $id));
            return redirect()->route('materials.index', ['lesson_id' => $lesson->id])->with('message.success', Lang::get('main.success_delete'));
        } else {
            Material::destroy(explode(',', $id));
            return redirect()->route('materials.index')->with('message.success', Lang::get('main.success_delete'));
        }
    }
}
