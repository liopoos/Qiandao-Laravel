<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-25
 * Time: 14:22
 */

namespace App\Http\Controllers;

use App\Http\Services\HomeServices;
use App\Http\Services\TemplateServices;
use App\Http\Services\UserServices;

class ApiController extends Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = app('request');
    }

    /**
     * 用户信息
     * @return \App\Library\Utils\ApiResponse
     */
    public function user()
    {
        $userInfo = UserServices::getUserInfo(user_id());

        return api_success($userInfo);
    }

    /**
     * 任务列表
     * @return \App\Library\Utils\ApiResponse
     */
    public function taskList()
    {
        $list = UserServices::getTaskList(user_id());

        return api_success($list);
    }

    /**
     * 模板列表
     * @return \App\Library\Utils\ApiResponse
     */
    public function templateList()
    {
        $list = TemplateServices::getTemplateList(user_id());

        return api_success($list);
    }

    /**
     * 日志
     * @param int $id
     * @return \App\Library\Utils\ApiResponse
     */
    public function log($id = 0)
    {
        $list = UserServices::getTaskLog(user_id(), $id);

        return api_success($list);
    }

    /**
     * 执行任务
     * @param $id
     * @return \App\Library\Utils\ApiResponse
     */
    public function do($id)
    {
        $result = HomeServices::doTask(user_id(), $id);

        return api_success($result);
    }
}