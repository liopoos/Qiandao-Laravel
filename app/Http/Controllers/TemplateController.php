<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-27
 * Time: 10:05
 */

namespace App\Http\Controllers;


use App\Http\Services\TemplateServices;
use App\Http\Services\UserServices;
use Illuminate\Support\Facades\Validator;

class TemplateController extends Controller
{
    public function creat()
    {
        if ($this->request->method() == 'POST') {
            $validator = Validator::make($this->request->all(), [
                'template-name' => 'bail|required',
                'template-desc' => 'bail|required',
                'har-text' => 'bail|required|json',
                'header-replace' => 'json',
                'query-replace' => 'json',
                'post-replace' => 'json',
                'success-response' => 'required|json',
                'relation' => 'required',
            ], [
                'template-name.required' => '名称是必须的',
                'template-desc.required' => '描述是必须的',
                'har-text.required' => 'HAR文件是必须的',
                'har-text.json' => 'HAR文件不是有效的JSON格式',
                'header-replace.json' => '需要替换的Header字段不是有效的JSON格式',
                'query-replace.json' => '需要替换的Query字段不是有效的JSON格式',
                'post-replace.json' => '需要替换的POST字段不是有效的JSON格式',
                'success-response.json' => '成功的响应字段不是有效的JSON格式',
                'success-response.required' => '成功的响应字段是必须的',
            ])->validate();
            $templateId = TemplateServices::creatTemplate($validator);
            if ($templateId) {
                UserServices::action('创建模板');

                return redirect("/template/{$templateId}");
            }
        } else {
            return view('template.creat');
        }
    }

    public function detail($id)
    {
        $data = TemplateServices::getTemplateDetail($id);
        if (!$data) {
            return view('home.message', ['message' => '模板不存在']);
        }

        return view('template.detail', $data);
    }
}