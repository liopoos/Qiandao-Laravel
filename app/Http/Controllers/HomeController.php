<?php

namespace App\Http\Controllers;

use App\Http\Services\HomeServices;
use App\Http\Services\TemplateServices;
use App\Library\Utils\ApiCode;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->check()){
            return (new UserController)->dashboard();
        }

        return view('home.index');
    }

    public function list()
    {
        $list = TemplateServices::getTemplateList();

        return view('template.list', ['list' => $list]);
    }

    public function do($id = 0)
    {
        $authId = auth()->id();
        if ($id > 0 && $authId == $id) {
            $task = HomeServices::doTask($id);

            return $task;
        }

        return api_error(ApiCode::AUTH_ERROR);
    }

    public function api()
    {
        return view('home.api');
    }
}
