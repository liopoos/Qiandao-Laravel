<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-27
 * Time: 10:05
 */

namespace App\Http\Services;


use App\Http\Models\TemplateList;

class TemplateServices
{
    public static function creatTemplate($validator)
    {
        $harContent = json_decode($validator['har-text'], 1);
        $headerReplaceContent = $validator['header-replace'] ?? [];
        $queryReplaceContent = $validator['query-replace'] ?? [];
        $postReplaceContent = $validator['post-replace'] ?? [];
        $successResponseContent = $validator['success-response'];

        $requestMethod = $harContent['log']['entries'][0]['request']['method'];
        $requestUrl = $harContent['log']['entries'][0]['request']['url'];

        $templateId = TemplateList::insertGetId([
            'name' => $validator['template-name'],
            'description' => $validator['template-desc'],
            'har_content' => json_encode($harContent),
            'header_replace' => $headerReplaceContent,
            'query_replace' => $queryReplaceContent,
            'post_replace' => $postReplaceContent,
            'request_method' => $requestMethod,
            'request_url' => $requestUrl,
            'success_response' => $successResponseContent,
            'created_at' => time()
        ]);

        return $templateId;
    }

    public static function getTemplateList($userId = 0)
    {
        $list = TemplateList::query()->where('is_valid', 1);

        if ($userId) {
            $list->where('uid', $userId);
        } else {
            $list->where('is_publish', 1);
        }

        $list = $list->get(['tid', 'name', 'description', 'created_at', 'used_number']);

        return $list;
    }

    public static function getTemplateDetail($id)
    {
        $tempLate = [];
        $data = TemplateList::find($id);

        if (!$data) {
            return [];
        }
        $harContent = json_decode($data['har_content'], 1);
        $headerReplaceContent = json_decode($data['header_replace'], 1);
        $queryReplaceContent = json_decode($data['query_replace'], 1);
        $postReplaceContent = json_decode($data['post_replace'], 1);
        $tempLate['tid'] = $data['tid'];
        $tempLate['name'] = $data['name'];
        $tempLate['desc'] = $data['description'];
        $tempLate['requestUrl'] = $data['request_url'];
        $tempLate['requestMethod'] = $data['request_method'];

        foreach ($harContent['log']['entries'][0]['request']['headers'] as $item) {
            $tempLate['headers'][] = [
                'name' => $item['name'],
                'value' => in_array($item['name'], $headerReplaceContent) ? '' : $item['value'],
                'is_replace' => in_array($item['name'], $headerReplaceContent) ? true : false
            ];
        }

        if (isset($harContent['log']['entries'][0]['request']['queryString'])) {
            foreach ($harContent['log']['entries'][0]['request']['queryString'] as $item) {
                $tempLate['query'][] = [
                    'name' => $item['name'],
                    'value' => in_array($item['name'], $queryReplaceContent) ? '' : $item['value'],
                    'is_replace' => in_array($item['name'], $queryReplaceContent) ? true : false
                ];
            }
        } else {
            $tempLate['query'] = [];
        }

        if (isset($harContent['log']['entries'][0]['request']['postData']['params'])) {
            foreach ($harContent['log']['entries'][0]['request']['postData']['params'] as $item) {
                $tempLate['post'][] = [
                    'name' => $item['name'],
                    'value' => in_array($item['name'], $postReplaceContent) ? '' : $item['value'],
                    'is_replace' => in_array($item['name'], $postReplaceContent) ? true : false
                ];
            }
        } else {
            $tempLate['post'] = [];
        }

        foreach (json_decode($data['success_response'], 1) as $key => $item) {
            $tempLate['successResponse'][] = [
                'name' => $key,
                'value' => $item
            ];

        }

        return $tempLate;
    }
}