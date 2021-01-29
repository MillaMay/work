<?php

namespace App\Http\Controllers\Members;

class ProfileController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->template = 'members.profile';
    }

    public function index()
    {
        return $this->renderOutput($this->vars);
    }
}
