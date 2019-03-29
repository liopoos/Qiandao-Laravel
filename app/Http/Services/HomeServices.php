<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-27
 * Time: 16:24
 */

namespace App\Http\Services;


use App\Http\Models\TaskList;
use App\Http\Models\TaskLog;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Exception;

class HomeServices
{
    public static function doTask($userId = 0, $taskId = 0)
    {
        $taskList = TaskList::query()->where('is_valid', 1)
            ->where('is_delete', 0);

        if ($taskId > 0) {
            $taskList->where('task_id', $taskId)
                ->where('uid', $userId);
        }

        $taskList = $taskList->get();

        foreach ($taskList as &$item) {
            $item['result'] = self::request($item);
        }

        return $taskList;
    }

    /**
     * 开始请求
     * @param $taskData
     * @return bool
     */
    public static function request($taskData)
    {
        $templateData = TemplateServices::getTemplateDetail($taskData['tid']);
        $taskReplaceContent = json_decode($taskData['replace_content'], 1);
        $result = false;

        $headers = self::getReplace('headers', $templateData, $taskReplaceContent['headers']);
        $query = self::getReplace('query', $templateData, $taskReplaceContent['query']);
        $post = self::getReplace('post', $templateData, $taskReplaceContent['post']);

        $client = new Client([
            'timeout' => 20,
        ]);

        $task = new TaskLog;
        $task->task_id = $taskData['task_id'];
        $task->executed_at = time();
        $requestMethod = strtoupper($templateData['requestMethod']);
        $formData = [
            'headers' => $headers,
            'query' => $query
        ];

        if ($requestMethod != 'GET') {
            if ($templateData['postType'] == 'application/x-www-form-urlencoded') {
                $formData['form_params'] = $post;
            } elseif ($templateData['postType'] == 'application/json') {
                $formData['json'] = $post;
            }
        }
        try {
            $response = $client->request($requestMethod, $templateData['requestUrl'], $formData);
            $code = $response->getStatusCode();
        } catch (GuzzleException $e) {
            $code = $e->getCode();
        }

        if ($code == 200) {
            $body = $response->getBody()->getContents();
            $task->response = $body;
            $result = self::checkResponse($templateData['successResponse'], $body, $templateData['relation']);
            if ($result) {
                $task->is_success = 1;
            } else {
                $task->is_success = 0;
            }
        } else {
            $task->response = $e->getMessage();
            $task->is_success = 0;
        }
        $task->save();

        return $result;
    }

    /**
     * 检查response是否成功
     * @param $templateResponse
     * @param $response
     * @return bool
     */
    public static function checkResponse($templateResponse, $response, $relation)
    {
        try {
            $response = json_decode($response, 1);
        } catch (Exception $e) {
            return false;
        }

        $result = ($relation == 1) ? true : false;
        foreach ($templateResponse as $item) {
            //根据响应关系判断
            if ($relation == 1) {
                $result &= (($response[$item['name']] == $item['value']) ? true : false);
            } elseif ($relation == 2) {
                $result |= (($response[$item['name']] == $item['value']) ? true : false);
            }
        }

        return $result;
    }

    /**
     * 替换请求的数据
     * @param $type
     * @param $templateData
     * @param $taskData
     * @return array
     */
    public static function getReplace($type, $templateData, $taskData)
    {
        $replace = [];
        foreach ($templateData[$type] as $item) {
            if ($item['is_replace']) {
                $replace[$item['name']] = $taskData[$item['name']];
            } else {
                $replace[$item['name']] = $item['value'];
            }
        }

        return $replace;
    }
}