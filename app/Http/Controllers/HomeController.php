<?php

namespace App\Http\Controllers;

use App\Http\Services\HomeServices;
use App\Http\Services\TemplateServices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.index');
    }

    public function list()
    {
        $list = TemplateServices::getTemplateList();

        return view('template.list', ['list' => $list]);
    }

    public function do()
    {
        $task = HomeServices::doTask();

        return $task;
    }
}
