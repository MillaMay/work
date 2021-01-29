<?php

namespace App\Http\Controllers\Members;

use App\Models\Course;
use App\Models\MemberAnswer;
use App\Models\Question;
use App\Models\Test;

class TestController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show($c_id, $t_id)
    {
        $vars = [];
        $vars['course'] = Course::with('lessons')->where('id', $c_id)->first();

        $this->template = 'members.test';
        return $this->renderOutput($vars);
    }

    public function start($c_id, $t_id)
    {
        $vars = [];
        $test_id = (int)$t_id;
        $vars['course'] = Course::with('lessons')->where('id', $c_id)->first();
        $test = Test::with('questions')->where('id', $test_id)->first();
//        $replied_questions = MemberAnswer::where('test_id', $test_id)->pluck('question_id')->all();
//        $repl_q = $test->questions->whereIn('id', $replied_questions)->all();
//        foreach ($repl_q as $q) {
//            $q->setAttribute('replied', true);
//        }

        $vars['test'] = $test;

        $questions = $test->questions->sortBy('sort');
        $vars['next_question'] = $questions[1]->id;
        $vars['question'] = $questions[0];

        $this->template = 'members.start';
        return $this->renderOutput($vars);
    }

    public function getQuestion($c_id, $t_id)
    {
        $question_id_to_display = 0;
        $current_question_id = 0;
        $test_id = (int)$t_id;
        $member = session()->get('auth')['user'];

        if (request()->next_question_id) {
            $question_id_to_display = (int)request()->next_question_id;
            $current_question_id = (int)request()->current_question_id;
        } elseif (request()->prev_question_id) {
            $question_id_to_display = (int)request()->prev_question_id;
            $current_question_id = (int)request()->prev_question_id;
        }

        if ($question_id_to_display) {
            $question = Question::with('answers')->where('id', $question_id_to_display)->first();

            $next_step = $question->sort + 1;
            $prev_step = $question->sort - 1;
            $next_question = Question::where('sort', '=' ,$next_step)->where('test_id',$t_id)->get();
            $prev_question = Question::where('sort', '=' ,$prev_step)->where('test_id',$t_id)->get();
            $vars['next_question'] = $next_question->count() ? $next_question[0]->id : null;
            $vars['prev_question'] = $prev_question->count() ? $prev_question[0]->id : null;

            $answers = MemberAnswer::where('member_id', $member->id)->where('test_id', $test_id)->where('question_id', $current_question_id)->get();
            if (!$answers->count()) {
                $member_ans = [];
                if (request()->answers) {
                    foreach (request()->answers as $a) {
                        $member_ans[] = [
                            'member_id' => $member->id,
                            'test_id' => $test_id,
                            'question_id' => $current_question_id,
                            'answer_id' => $a,
                        ];
                    }
                } elseif (request()->answer) {
                    $member_ans = [
                        'member_id' => $member->id,
                        'test_id' => $test_id,
                        'question_id' => $current_question_id,
                        'answer_id' => (int)request()->answer,
                    ];
                }
                if ($member_ans) {
                    MemberAnswer::insert($member_ans);
                }
            } else {
                $answer_ids = $answers->pluck('answer_id')->all();
                foreach ($question->answers as $a) {
                    if (in_array($a->id, $answer_ids)) {
                        $a->setAttribute('checked', true);
                    }
                }
                $question->setAttribute('replied', true);
            }
            $vars['question'] = $question;

            $test = Test::with('questions')->where('id', $test_id)->first();
            $replied_questions = MemberAnswer::where('test_id', $test_id)->pluck('question_id')->all();
            $repl_q = $test->questions->whereIn('id', $replied_questions)->all();
            foreach ($repl_q as $q) {
                $q->setAttribute('replied', true);
            }
            $vars['test'] = $test;

            return response()->view('members.components.question', $vars);
        } else {
            return response()->json(['url' => asset('course/'. $c_id .'/test/show/'. $t_id .'')]);
        }
    }
}
