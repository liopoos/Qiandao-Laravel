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
            return response()->json(api_error(ApiCode::REQUEST_ERROR));
        }
        $configArr = explode('/', $requestUrl);
        $gatewayMethod = strtoupper($configArr[0]);

        $controllerName = 'App\\Http\\Controllers\\' . explode('@', $configArr[1])[0] . 'Controller';
        $controllerMethod = explode('@', $configArr[1])[1];

        if ($requestMethod != $gatewayMethod) {
            return response()->json(api_error(ApiCode::REQUEST_ERROR));
        }

        return app($controllerName)->{$controllerMethod}();
    }
}