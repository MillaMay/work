<?php

namespace App\Http\Controllers\Trainers;

use App\Models\MemberCourse;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Member;

use Lang;
use Document;
use Validator;

class CourseController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        Document::setBreadcrumb(Lang::get('courses.title'), route('courses.index'));//Без этого конструктора получается НЕполный путь хлебных крошек.
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vars['courses'] = Course::paginate(10); //Пагинация, а было так: Course::all();
        //['courses'] - подразумевается название таблицы, которое можно явно прописать в модели Course, но не обязательно.
        $this->template = 'trainers.courses.list';

        return $this->renderOutput()->with($vars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vars['route'] = 'courses.store';
        $vars['title_form'] = Lang::get('courses.title_add');//Название формы
        $vars['title_button'] = Lang::get('main.add');//Кнопка добавления, если форма именно добавления курса
        $vars['course'] = new Course();
        Document::setBreadcrumb(Lang::get('courses.title_add'), route('courses.create'));
        $this->template = 'trainers.courses.form';

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
            'logo' => 'required',
        ], [
            'title.required' => Lang::get('courses.message_title_field'),
            'description.required' => Lang::get('courses.message_description_field'),
            'logo.required' => Lang::get('courses.message_logo_field'),
        ]);

        if($validator->fails()) {

            return redirect()->route('courses.create')->withErrors($validator)->withInput();

        } else {
            Course::insert([
                'title' => $request->title,
                'description' => $request->description,
                'trainer_id' => $request->trainer_id,
                'logo' => $request->logo,
            ]);

            return redirect()->route('courses.index')->with('message.success', Lang::get('courses.success_add_course'));
        }
    }

//    /**
////     * Display the specified resource.
////     *
////     * @param  int  $id
////     * @return \Illuminate\Http\Response
////     */
////    public function show($id)
////    {
////        //
////    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vars['route'] = 'courses.update';
        $vars['title_form'] = Lang::get('courses.title_edit');
        $vars['title_button'] = Lang::get('main.save');
        $vars['course'] = Course::find($id);
        Document::setBreadcrumb(Lang::get('courses.title_edit'), route('courses.edit', $id));
        $this->template = 'trainers.courses.form';

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
            'logo' => 'required',
        ], [
            'title.required' => Lang::get('courses.message_title_field'),
            'description.required' => Lang::get('courses.message_description_field'),
            'logo.required' => Lang::get('courses.message_logo_field'),
        ]);

        if($validator->fails()) {

            return redirect()->route('courses.create')->withErrors($validator)->withInput();

        } else {

            Course::whereId($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'trainer_id' => $this->user->id,
                'logo' => $request->logo,
            ]);

            return redirect()->route('courses.index')->with('message.success', Lang::get('courses.success_update_course'));
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
        Course::destroy(explode(',', $id));

        return redirect()->route('courses.index')->with('message.success', Lang::get('main.success_delete'));
    }

    public function getListMembers($course_id)
    {
        $vars['route'] = 'member_courses';
        $vars['members'] = Member::all();
        $vars['member_ids'] = MemberCourse::where('course_id', $course_id)->pluck('member_id')->toArray();
        $course = Course::find(request('course_id')); //Для хлебных крошек - следующая строка
        Document::setBreadcrumb($course->title, route('courses.edit', request('course_id')));
        Document::setBreadcrumb(Lang::get('members.title'), route('member_courses', $course_id));
        $this->template = 'trainers.courses.list_members';

        return $this->renderOutput()->with($vars);
    }

    public function updateListMembers($course_id, Request $request, $string_ids)
    {
        $members = explode(',', $string_ids);
        foreach ($members as $member_id) {
            $data[] = [
                'course_id' => $course_id,
                'member_id' => $member_id,
            ];
        }
        MemberCourse::where('course_id', $course_id)->delete();
        MemberCourse::insert($data);

        return redirect()->route('member_courses', $course_id)->with('message.success', Lang::get('members.success_update_member_courses'));
    }
}
