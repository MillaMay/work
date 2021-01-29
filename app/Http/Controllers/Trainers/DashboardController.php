<?php

namespace App\Http\Controllers\Trainers;

class DashboardController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->template = 'trainers.dashboard';
    }

    public function index()
    {
        return $this->renderOutput();
    }
}
