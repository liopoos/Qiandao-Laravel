<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-26
 * Time: 15:14
 */

namespace App\Http\Controllers;


use App\Http\Models\TemplateList;
use App\Http\Services\TemplateServices;
use App\Http\Services\UserServices;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();
        $taskList = UserServices::getTaskList($userId);
        $templateList = TemplateServices::getTemplateList($userId);

        return view('user.dashboard', [
            'taskList' => $taskList,
            'templateList' => $templateList
        ]);
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
        if ($id) {
            $templateData = TemplateList::find($id);
            $title = $templateData['name'];
        } else {
            $title = '全部';
        }

        return view('user.log', ['list' => $logList, 'title' => $title]);
    }

    public function task($id)
    {
        $userId = auth()->id();
        $taskData = UserServices::getTaskDetail($userId, $id);

        return view('user.task', $taskData);
    }

}