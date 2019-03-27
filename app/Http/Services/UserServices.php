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

    public static function getTaskLog($tid)
    {
        $userId = auth()->id();
        $logList = TaskList::query()
            ->where('task_list.uid', $userId)
            ->join('task_log', 'task_list.task_id', '=', 'task_log.task_id');
        if ($tid) {
            $logList->where('task_list.tid', $tid);
        }
        $logList->orderBy('task_log.executed_at', 'DESC');
        $logList = $logList->get();

        return $logList;
    }
}