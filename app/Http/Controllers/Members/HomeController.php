<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Members\BaseController;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->template = 'members.home';
    }

    public function index()
    {
        return $this->renderOutput();
    }
}
