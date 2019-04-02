<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-27
 * Time: 10:05
 */

namespace App\Http\Services;


use App\Http\Models\TemplateList;
use Illuminate\Contracts\Support\Arrayable;

class TemplateServices
{
    /**
     * 创建模板
     * @param $validator
     * @return mixed
     */
    public static function creatTemplate($validator)
    {
        $harContent = json_decode($validator['har-text'], 1);
        $headerReplaceContent = $validator['header-replace'] ?? [];
        $queryReplaceContent = $validator['query-replace'] ?? [];
        $postReplaceContent = $validator['post-replace'] ?? [];
        $successResponseContent = $validator['success-response'];

        $requestMethod = $harContent['log']['entries'][0]['request']['method'];
        $requestUrl = $harContent['log']['entries'][0]['request']['url'];
        $postType = '';
        if (!empty($harContent['log']['entries'][0]['request']['postData'])) {
            $postType = $harContent['log']['entries'][0]['request']['postData']['mimeType'];
        }
        $templateId = TemplateList::insertGetId([
            'name' => $validator['template-name'],
            'description' => $validator['template-desc'],
            'har_content' => json_encode($harContent),
            'header_replace' => $headerReplaceContent,
            'query_replace' => $queryReplaceContent,
            'post_replace' => $postReplaceContent,
            'request_method' => $requestMethod,
            'request_url' => $requestUrl,
            'post_type' => $postType,
            'response_type' => $validator['response-type'],
            'success_response' => $successResponseContent,
            'created_at' => time(),
            'uid' => auth()->id(),
            'relation' => $validator['relation']
        ]);

        return $templateId;
    }

    /**
     * 获取模板列表
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getTemplateList($userId = 0)
    {
        $list = TemplateList::query()->where('is_valid', 1)->where('is_delete', 0);

        if ($userId) {
            $list->where('uid', $userId);
        } else {
            $list->where('is_publish', 1);
        }

        $list = $list->get(['tid', 'name', 'description', 'created_at', 'used_number', 'is_publish']);

        return $list;
    }

    /**
     * 获取模板的详细信息
     * @param $id
     * @return array
     */
    public static function getTemplateDetail($id)
    {
        $tempLate = [];
        $data = TemplateList::query()->where('tid', $id)
            ->where('is_valid', 1)
            ->where('is_delete', 0)
            ->first();

        if (!$data) {
            return [];
        }
        $harContent = json_decode($data['har_content'], 1);
        $headerReplaceContent = json_decode($data['header_replace'], 1);
        $queryReplaceContent = json_decode($data['query_replace'], 1);
        $postReplaceContent = json_decode($data['post_replace'], 1);
        $tempLate['tid'] = $data['tid'];
        $tempLate['uid'] = $data['uid'];
        $tempLate['name'] = $data['name'];
        $tempLate['desc'] = $data['description'];
        $tempLate['requestUrl'] = $data['request_url'];
        $tempLate['requestMethod'] = $data['request_method'];
        $tempLate['postType'] = $data['post_type'];
        foreach ($harContent['log']['entries'][0]['request']['headers'] as $item) {
            $tempLate['headers'][] = [
                'name' => $item['name'],
                'value' => in_array($item['name'], $headerReplaceContent) ? '' : $item['value'],
                'is_replace' => in_array($item['name'], $headerReplaceContent) ? true : false
            ];
        }

        if (isset($harContent['log']['entries'][0]['request']['queryString']) && count($harContent['log']['entries'][0]['request']['queryString']) > 0) {
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

        if (isset($harContent['log']['entries'][0]['request']['postData']['params'])  && count($harContent['log']['entries'][0]['request']['postData']['params']) > 0) {
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

        $successResponse = json_decode($data['success_response'], 1);
        if (count($successResponse) == count($successResponse, 1)) {
            $successResponse = [$successResponse];
        }

        foreach ($successResponse as $items) {
            foreach ($items as $key => $item) {
                $tempLate['successResponse'][] = [
                    'name' => $key,
                    'value' => $item
                ];
            }
        }

        $tempLate['relation'] = $data['relation'];
        $tempLate['response_type'] = $data['response_type'];

        return $tempLate;
    }
}