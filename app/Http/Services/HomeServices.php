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
use App\Http\Models\TemplateList;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Exception;
use PHPUnit\Framework\Constraint\ExceptionCode;

class HomeServices
{
    public static function doTask()
    {
        $taskList = TaskList::query()->where('is_valid', 1)
            ->where('is_delete', 0)
            ->get();

        foreach ($taskList as &$item) {
            $item['result'] = self::request($item);
        }

        return $taskList;
    }

    public static function request($taskData)
    {
        $templateData = TemplateServices::getTemplateDetail($taskData['tid']);
        $taskReplaceContent = json_decode($taskData['replace_content'], 1);
        $result = false;

        $headers = self::getReplace('headers', $templateData, $taskReplaceContent['headers']);
        $query = self::getReplace('query', $templateData, $taskReplaceContent['query']);
        $post = self::getReplace('post', $templateData, $taskReplaceContent['post']);
        $client = new Client();
        $task = new TaskLog;
        $task->task_id = $taskData['task_id'];
        $task->executed_at = time();
        try {
            $response = $client->request(
                strtoupper($templateData['requestMethod']),
                $templateData['requestUrl'], [
                'headers' => $headers,
//                'query' => $query,
//                'form_params' => $post
            ]);
            $code = $response->getStatusCode();
        } catch (GuzzleException $e) {
            $code = 0;
        }

        return $code;

        if ($code == 200) {
            $body = $response->getBody()->getContents();
            $task->response = 0;
            $result = self::checkResponse($templateData['successResponse'], $body);
            if ($result) {
                $task->is_success = 1;
            } else {
                $task->is_success = 0;
            }

        } else {
            $task->is_success = 0;
        }
        $task->save();

        return $result;
    }

    public static function checkResponse($templateResponse, $response)
    {
        try {
            $response = json_decode($response, 1);
        } catch (Exception $e) {
            return false;
        }

        $result = true;
        foreach ($templateResponse as $item) {
            $result &= ($response[$item['name']] == $item['value']) ? true : false;
        }

        return $result;
    }

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