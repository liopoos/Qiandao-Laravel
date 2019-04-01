<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-25
 * Time: 14:22
 */

namespace App\Http\Controllers;

use App\Http\Models\TaskList;
use App\Http\Models\TemplateList;
use App\Http\Services\UserServices;

class ApiController extends Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = app('request');
    }

    public function user()
    {
        $userInfo = UserServices::getUserInfo(user_id());

        return api_success($userInfo);
    }

    public function taskList()
    {
        $page = $this->request->get('page', 1);
        $limit = $this->request->get('limit', 10);
        $list = TaskList::query()->where('uid', user_id())
            ->where('is_delete', 0)
            ->where('is_valid', 1)
            ->forPage($page, $limit)
            ->get();

        foreach ($list as &$item) {
            $item['replace_content'] = json_decode($item['replace_content'], 1);
        }

        return api_success($list);
    }

    public function templateList()
    {
        $page = $this->request->get('page', 1);
        $limit = $this->request->get('limit', 10);
        $list = TemplateList::query()->where('uid', user_id())
            ->where('is_delete', 0)
            ->where('is_valid', 1)
            ->forPage($page, $limit)
            ->get();

        foreach ($list as &$item) {
            $item['har_content'] = json_decode($item['har_content'], 1);
            $item['success_response'] = json_decode($item['success_response'], 1);
            $item['header_replace'] = json_decode($item['header_replace'], 1);
            $item['query_content'] = json_decode($item['query_content'], 1);
            $item['post_content'] = json_decode($item['post_content'], 1);
        }

        return api_success($list);
    }
}