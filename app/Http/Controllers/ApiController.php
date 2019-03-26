<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-25
 * Time: 14:22
 */

namespace App\Http\Controllers;


use ApiCode;

class ApiController extends Controller
{
    public function gateway($uri)
    {
        $uri = str_replace('.', '_', $uri);
        $requestUrl = config('gateway.' . $uri, '');
        $requestMethod = $this->request->method();

        if (!$requestUrl) {
            return response('404');
        }
        $configArr = explode('/', $requestUrl);
        $gatewayMethod = strtoupper($configArr[0]);

        $controllerName = 'App\\Http\\Controllers\\' . explode('@', $configArr[1])[0] . 'Controller';
        $controllerMethod = explode('@', $configArr[1])[1];

        if ($gatewayMethod != 'ANY' && $requestMethod != $gatewayMethod) {
            return response('404');
        }

        return app($controllerName)->{$controllerMethod}();
    }
}