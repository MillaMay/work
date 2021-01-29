<?php

namespace App\Http\Controllers\Trainers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Test;

use Lang;
use Document;
use Validator;

class QuestionController extends BaseController
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
        if (request('test_id')) {
            $test = Test::find(request('test_id'));
            Document::setBreadcrumb(Lang::get('tests.title'), route('tests.index'));
            Document::setBreadcrumb($test->title, route('tests.edit', request('test_id')));
            Document::setBreadcrumb(Lang::get('questions.title'), route('questions.index'));
            $vars['questions'] = Question::with('test')->where('test_id', request('test_id'))->paginate(10);
            $vars['test_id'] = $test->id;
        } else {
            Document::setBreadcrumb(Lang::get('questions.title'), route('questions.index'));
            $vars['questions'] = Question::with('test')->paginate(10);
        }
        $this->template = 'trainers.questions.list';

        return $this->renderOutput()->with($vars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vars['route'] = 'questions.store';
        $vars['title_form'] = Lang::get('questions.title_add');
        $vars['title_button'] = Lang::get('main.add');
        $vars['question'] = new Question();
        $vars['tests'] = Test::all();
        $vars['types'] = [Lang::get('questions.type_checkbox'), Lang::get('questions.type_radio')];
        $vars['point_accruals'] = [Lang::get('questions.point_false'), Lang::get('questions.point_true')];
        if (request('test_id')) {
            $test = Test::find(request('test_id'));
            Document::setBreadcrumb(Lang::get('tests.title'), route('tests.index'));
            Document::setBreadcrumb($test->title, route('tests.edit', request('test_id')));
            Document::setBreadcrumb(Lang::get('questions.title'), route('questions.index', ['test_id' => $test->id]));
        }
        Document::setBreadcrumb(Lang::get('questions.title_add'), route('questions.create'));
        $this->template = 'trainers.questions.form';

        return $this->renderOutput()->with($vars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        if(!$request->validated()) {

            return redirect()->route('questions.create')->withErrors($request)->withInput();

        } else {
            $question = Question::insertGetId([
                'title' => $request->title,
                'type' => $request->type,
                'test_id' => $request->test_id,
                'point' => $request->point,
                'point_accrual' => $request->point_accrual,
                ]);

            foreach ($request->answers as $answer){
                Answer::insert([
                    'title' => $answer['title'],
                    'correctly' => $answer['correctly'],
                    'point' => $answer['point'],
                    'question_id' => $question,
                ]);
            }

            return redirect()->route('questions.index', ['test_id' => $request->test_id])->with('message.success', Lang::get('questions.success_add_question'));
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
        $vars['route'] = 'questions.update';
        $vars['title_form'] = Lang::get('questions.title_edit');
        $vars['title_button'] = Lang::get('main.save');
        $question = Question::find($id);
        $vars['answers'] = Answer::where('question_id', $id)->get();
        $vars['question'] = $question;
        $vars['tests'] = Test::all();
        $vars['types'] = [Lang::get('questions.type_checkbox'), Lang::get('questions.type_radio')];
        $vars['point_accruals'] = [Lang::get('questions.point_false'), Lang::get('questions.point_true')];
        Document::setBreadcrumb(Lang::get('tests.title'), route('tests.index'));
        Document::setBreadcrumb($question->test->title, route('tests.edit', $question->test->id));
        Document::setBreadcrumb(Lang::get('questions.title'), route('questions.index', ['test_id' => $question->test->id]));
        Document::setBreadcrumb(Lang::get('questions.title_edit'), route('questions.edit', $id));
        $this->template = 'trainers.questions.form';

        return $this->renderOutput()->with($vars);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $id)
    {
        if(!$request->validated()) {

            return redirect()->route('questions.create')->withErrors($request)->withInput();

        } else {
            Question::whereId($id)->update([
                'title' => $request->title,
                'type' => $request->type,
                'test_id' => $request->test_id,
                'point' => $request->point,
                'point_accrual' => $request->point_accrual,
            ]);

            Answer::where('question_id', $id)->delete();

            if (isset($request->answers)) { //Эта проверка нужна, если не добавляется ни 1 ответа, чтобы не выдавало ошибку!
                foreach ($request->answers as $answer) {
                    Answer::insert([
                        'title' => $answer['title'],
                        'correctly' => $answer['correctly'],
                        'point' => $answer['point'],
                        'question_id' => $id,
                    ]);
                }
            }

            return redirect()->route('questions.index', ['test_id' => $request->test_id])->with('message.success', Lang::get('questions.success_update_question'));
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
        if (request('test_id')) {
            $vars['test_id'] = request('test_id');
            $test = Test::find(request('test_id'));
            Question::destroy(explode(',', $id));
            return redirect()->route('questions.index', ['test_id' => $test->id])->with('message.success', Lang::get('main.success_delete'));
        } else {
            Question::destroy(explode(',', $id));
            return redirect()->route('questions.index')->with('message.success', Lang::get('main.success_delete'));
        }
    }
}
