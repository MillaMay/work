<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

use Lang;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //Это авторизация QuestionRequest
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required', //Question
            'type' => 'required', //Question
            'test_id' => 'required', //Question
            'point' => 'required', //Question
            'point_accrual' => 'required', //Question

            'answers' => function($attribute, $answers, $fail) { //Своя - пользовательская функция проверки
                $correctly = 0;
                foreach ($answers as $answer) {

                    if($answer['title'] == null or $answer['point'] == null) {
                        $fail(Lang::get('questions.add_answer'));
                    }

                    if ($answer['correctly'] == true) {
                        $correctly++;
                    }
                }
                if(request('type') == 1 && $correctly > 1) {
                    $fail(Lang::get('questions.answer_one'));
                }
                if(request('type') == 0 && $correctly < 2) {
                    $fail(Lang::get('questions.answer_many'));
                }

                if($correctly < 1) {
                    $fail(Lang::get('questions.correctly_answer'));
                }
            },
        ];
    }

    public function messages()
    {
        return [
            'title.required' => Lang::get('questions.message_title_field'),
            'type.required' => Lang::get('questions.message_type_field'),
            'test_id.required' => Lang::get('questions.message_test_id_field'),
            'point.required' => Lang::get('questions.message_point_field'),
            'point_accrual.required' => Lang::get('questions.message_point_accrual_field'),

//            'answers.title.required' => 'Поле "Ответ" не может быть пустым', //Это если названия полей у таблиц одинаковые
//            'answers.point.required' => 'Введите баллы за ответ',
        ];
            //parent::messages();
    }
}
