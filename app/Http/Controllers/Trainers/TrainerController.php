<?php

namespace App\Http\Controllers\Trainers;

use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use App\Models\Trainer;

use Lang;
use Document;
use Validator;

class TrainerController extends BaseController
{
//    public function __construct()
//    {
//        parent::__construct();
//        $this->template = 'trainers.form';
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vars['route'] = 'profile.update';
        $vars['title_form'] = Lang::get('trainers.title_edit');
        $vars['title_button'] = Lang::get('main.save');
        $vars['trainer'] = Trainer::find($id);
        Document::setBreadcrumb(Lang::get('trainers.title_edit'), route('profile.edit', $id));
        $this->template = 'trainers.form';

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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'department' => 'required',
            'avatar' => 'required',
        ], [
            'name.required' => Lang::get('trainers.message_name_field'),
            'email.required' => Lang::get('trainers.message_email_field'),
            'phone.required' => Lang::get('trainers.message_phone_field'),
            'department.required' => Lang::get('trainers.message_department_field'),
            'avatar.required' => Lang::get('trainers.message_avatar_field'),
        ]);

        if($validator->fails()) {

            return redirect()->route('profile.edit' , $id)->withErrors($validator)->withInput();

        } else {
            Trainer::whereId($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => preg_replace('/[^0-9]/', '', $request->phone),
                'department' => $request->department,
                'avatar' => $request->avatar,
            ]);

            return redirect()->route('profile.edit' , $id)->with('message.success', Lang::get('trainers.success_update_trainer'));
        }
    }

    public function formPassword($id)
    {
        $vars['route'] = 'password'; // password -> как name в роуте для данного метода
        Document::setBreadcrumb(Lang::get('trainers.title_edit'), route('profile.edit', $id));
        Document::setBreadcrumb(Lang::get('trainers.title_form'), route('profile.edit', $id));
        $this->template = 'trainers.form_password';

        return $this->renderOutput()->with($vars);
    }

    public function changePassword($id, PasswordRequest $request)
    {
        if(!$request->validated()) {
            return redirect()->route('password', $id)->withErrors($request)->withInput();
        } else {
            Trainer::whereId($id)->update([
                'password' => md5($request->new_password),
            ]);
        }
        return redirect()->route('profile.edit', $id)->with('message.success', Lang::get('trainers.success_update_password'));
    }
}
