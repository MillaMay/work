<?php

namespace App\Http\Controllers\Trainers;

use Illuminate\Http\Request;
use App\Models\Member;

use Lang;
use Document;
use Validator;
use Mail;

class MemberController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        Document::setBreadcrumb(Lang::get('members.title'), route('members.index'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vars['members'] = Member::paginate(10);
        $this->template = 'trainers.members.list';
        return $this->renderOutput()->with($vars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vars['route'] = 'members.store';
        $vars['title_form'] = Lang::get('members.title_add');
        $vars['title_button'] = Lang::get('main.add');
        $vars['member'] = new Member();
        $vars['types'] = [Lang::get('members.type_intern'), Lang::get('members.type_consultant')];
        Document::setBreadcrumb(Lang::get('members.title_add'), route('members.create'));
        $this->template = 'trainers.members.form';

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
            'name' => 'required',
            'avatar' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'store' => 'required',
            'post' => 'required',
            'type' => 'required',
        ], [
            'name.required' => Lang::get('members.message_name_field'),
            'avatar.required' => Lang::get('members.message_avatar_field'),
            'email.required' => Lang::get('members.message_email_field'),
            'phone.required' => Lang::get('members.message_phone_field'),
            'city.required' => Lang::get('members.message_city_field'),
            'store.required' => Lang::get('members.message_store_field'),
            'post.required' => Lang::get('members.message_post_field'),
            'type.required' => Lang::get('members.message_type_field'),
        ]);

        if($validator->fails()) {

            return redirect()->route('members.create')->withErrors($validator)->withInput();

        } else {
            //Генерация пароля, чтобы поле 'password' заполнялось
            $password = str_random(7); //Нужны символы: буквы и цифры !!! А значит и в валидации надо прописать требование

            Member::insert([
                'name' => $request->name,
                'avatar' => $request->avatar,
                'email' => $request->email,
                'phone' => preg_replace('/[^0-9]/', '', $request->phone),
                'city' => $request->city,
                'store' => $request->store,
                'post' => $request->post,
                'type' => $request->type,
                'password' => md5($password),
            ]);

            return redirect()->route('members.index')->with('message.success', Lang::get('members.success_add_member'));
        }
    }

    public function sendPassword()
    {
        //Для отправки пароля на почту участнику
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vars['route'] = 'members.update';
        $vars['title_form'] = Lang::get('members.title_edit');
        $vars['title_button'] = Lang::get('main.save');
        $vars['member'] = Member::find($id);
        $vars['types'] = [Lang::get('members.type_intern'), Lang::get('members.type_consultant')];
        Document::setBreadcrumb(Lang::get('members.title_edit'), route('members.edit', $id));
        $this->template = 'trainers.members.form';

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
            'avatar' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'store' => 'required',
            'post' => 'required',
            'type' => 'required',
        ], [
            'name.required' => Lang::get('members.message_name_field'),
            'avatar.required' => Lang::get('members.message_avatar_field'),
            'email.required' => Lang::get('members.message_email_field'),
            'phone.required' => Lang::get('members.message_phone_field'),
            'city.required' => Lang::get('members.message_city_field'),
            'store.required' => Lang::get('members.message_store_field'),
            'post.required' => Lang::get('members.message_post_field'),
            'type.required' => Lang::get('members.message_type_field'),
        ]);

        if($validator->fails()) {

            return redirect()->route('members.create')->withErrors($validator)->withInput();

        } else {
            Member::whereId($id)->update([
                'name' => $request->name,
                'avatar' => $request->avatar,
                'email' => $request->email,
                'phone' => preg_replace('/[^0-9]/', '', $request->phone),
                'city' => $request->city,
                'store' => $request->store,
                'post' => $request->post,
                'type' => $request->type,
                'password' => $request->password,
            ]);

            return redirect()->route('members.index')->with('message.success', Lang::get('members.success_update_member'));
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
        Member::destroy(explode(',', $id));

        return redirect()->route('members.index')->with('message.success', Lang::get('main.success_delete'));
    }
}
