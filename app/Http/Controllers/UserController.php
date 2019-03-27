<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-26
 * Time: 15:14
 */

namespace App\Http\Controllers;


use App\Http\Services\TemplateServices;
use App\Http\Services\UserServices;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function dashboard()
    {

        return view('user.dashboard');
    }

    public function add($id)
    {
        if ($this->request->method() == 'POST') {
            $data = $this->request->all();
            $taskId = UserServices::addTask($id, $data);
            if ($taskId) {

            }
        } else {
            $data = TemplateServices::getTemplateDetail($id);

            return view('user.add', $data);
        }
    }

    public function log($id = 0)
    {
        $logList = UserServices::getTaskLog($id);

        return $logList;
    }

}