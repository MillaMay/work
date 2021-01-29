<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

use Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function userAuthorize(Request $request)
    {
        $user = Trainer::where('email', $request->email)->where('password', md5($request->password))->first();

        if ($user) {
           session(['auth' => [
               'type' => 'trainer',
               'user' => $user,
               ]
           ]);
           return redirect('dashboard');
        } else {
            $user = Member::where('email', $request->email)->where('password', md5($request->password))->first();
            if ($user) {
                session(['auth' => [
                    'type' => 'member',
                    'user' => $user,
                    ]
                ]);
                return redirect('/');
            } else {
                return redirect('login')->withErrors(Lang::get('login.message'));
            }
        }
    }

    public function logout()
    {
        session()->forget('auth');
        session()->save();

        return redirect('login');
    }
}
