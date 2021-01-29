<?php

namespace App\Http\Requests;

use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;
use Lang;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => function($attribute, $value, $fail) {
                if(!$this->request->has('password')){
                    $fail(Lang::get('trainers.message_password_required'));
                }
                $trainer = Trainer::where('password', md5($this->request->get('password')))->first();
                if(!$trainer) {
                    $fail(Lang::get('trainers.message_password_exists'));
                }
            },
            'new_password' => function($attribute, $value, $fail) {// Должно быть 3 параметра: в 1-попадает password (name поля), во 2-значение, в 3-сообщение
                if($value != request('new_replay_password')) {
                    $fail(Lang::get('trainers.message_passwords'));
                }
            },
        ];
    }
}
