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
                UserServices::action("添加任务，ID为{$taskId}");

                return redirect("/task/{$taskId}");
            }
        } else {
            $data = TemplateServices::getTemplateDetail($id);
            if (!$data) {
                return view('home.message', ['message' => '模板不存在']);
            }

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

        if (count($taskData) == 0) {
            return view('home.message', ['message' => '任务不存在']);
        }

        return view('user.task', $taskData);
    }

    public function delete($type, $id)
    {
        $userId = auth()->id();
        if ($type != 'task' && $type != 'template') {
            $result = false;
        } else {
            $result = UserServices::delete($userId, $type, $id);
        }
        UserServices::action('删除' . (($type == 'task' ? '任务' : '模板')) . '并且' . (($result ? '成功' : '失败')));

        return view('home.message', ['message' => $result ? '删除成功' : '删除失败']);
    }

    public function message()
    {
        $userId = auth()->id();
        $list = UserServices::getAction($userId);

        return view('home.message', ['list' => $list]);
    }

    public function test($id)
    {
        $userId = auth()->id();
        $result = array_first(UserServices::testTask($userId, $id));
        UserServices::action("测试任务，ID为{$id}并且" . ($result['result'] ? '成功' : '失败'));

        return view('home.message', ['message' => $result['result'] ? '任务执行成功' : '任务执行失败']);
    }

}