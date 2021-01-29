<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;

use Document;
use Illuminate\Support\Facades\Session;

class BaseController extends Controller
{
    protected $template;
    protected $vars = [];

    protected function renderOutput($vars)
    {
        $this->vars['styles'] = Document::getStyles();

        return view($this->template)->with($this->vars + $vars);
    }

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->vars['user'] = Session::get('auth')['user'];
            return $next($request);
        });
    }
}
