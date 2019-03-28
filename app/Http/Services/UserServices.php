<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-26
 * Time: 17:52
 */

namespace App\Http\Services;


use App\Http\Models\TaskList;
use App\Http\Models\TaskLog;
use App\Http\Models\TemplateList;
use Carbon\Carbon;

class UserServices
{
    public static function addTask($id, $data)
    {
        $userId = auth()->id();
        $replaceContent = [];
        foreach ($data as $key => $item) {
            if (strpos($key, '-')) {
                $prefix = explode('-', $key);
                $replaceContent[$prefix[0]][$prefix[1]] = $item;
            }
        }

        $taskId = TaskList::insertGetId([
            'tid' => $id,
            'uid' => $userId,
            'replace_content' => json_encode($replaceContent),
            'created_at' => time()
        ]);

        return $taskId;
    }

    /**
     * 获取任务日志
     * @param $tid
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getTaskLog($taskId)
    {
        $userId = auth()->id();
        $logList = TaskList::query()
            ->where('task_list.uid', $userId)
            ->join('task_log', 'task_list.task_id', '=', 'task_log.task_id')
            ->join('template_list', 'task_list.tid', '=', 'template_list.tid');
        if ($taskId) {
            $logList->where('task_list.task_id', $taskId);
        }
        $logList->orderBy('task_log.executed_at', 'DESC');
        $logList = $logList->get();

        return $logList;
    }

    /**
     * 获取任务列表
     * @param $userId
     * @return array
     */
    public static function getTaskList($userId)
    {
        $list = TaskList::query()->where('task_list.uid', $userId)
            ->join('template_list', 'template_list.tid', '=', 'task_list.tid')
            ->where('task_list.is_delete', 0)
            ->get()->toArray();
        foreach ($list as &$item) {
            $item['taskLog'] = TaskLog::query()->where('task_id', $item['task_id'])
                ->where('is_success', 1)
                ->orderBy('executed_at', 'DESC')
                ->first();
            $item['successCount'] = TaskLog::query()->where('is_success', 1)->where('task_id', $item['task_id'])->count();
            $item['failCount'] = TaskLog::query()->where('is_success', 0)->where('task_id', $item['task_id'])->count();
        }

        return $list;
    }

    public static function getTaskDetail($userId, $taskId)
    {
        $data = TaskList::find($taskId);

        $taskData = [];
        $taskData['creatTime'] = date('Y-m-d H:i:s', $data['created_at']);
        $taskData['taskId'] = $data['task_id'];

        $templateData = TemplateServices::getTemplateDetail($data['tid']);

        foreach (json_decode($data['replace_content'], 1) as $keys => $items) {
            foreach ($items as $key => $item) {
                $taskData['replaceContent'][$keys][$key] = $item;
            }
        }
        $templateData['task'] = $taskData;

        return $templateData;
    }

}