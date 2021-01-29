<?php

namespace App\Http\Controllers\Trainers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

use Document;

class BaseController extends Controller
{
    protected $template;
    protected $vars = [];
    protected $user;

    protected function renderOutput()
    {
        $user = Session::get('auth'); //Для получения тренера, под которым залогинились

        if($user['type'] == 'trainer') {
            $this->vars['trainer'] = $user['user'];
        }

//        $children['header'] = view('trainers.layouts.header');
//        $children['left_sidebar'] = view('trainers.layouts.left_sidebar');
//        $children['breadcrumbs'] = view('trainers.components.breadcrumbs');
//        $this->vars = array_merge($this->vars, $children); //Эти $children нужны, если бы в base.blade.php выводили бы страницы переменными, а не include подключали
        $this->vars['breadcrumbs'] = Document::getBreadcrumbs();
        $this->vars['styles'] = Document::getStyles();

        return view($this->template)->with($this->vars);
    }

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Session::get('auth')['user'];
            return $next($request);
        });
        Document::setBreadcrumb(Lang::get('main.home'), route('home'));

    }
}
