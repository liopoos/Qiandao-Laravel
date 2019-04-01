<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-26
 * Time: 16:28
 */

use App\Http\Models\UserList;
use App\Library\Utils\ApiResponse;
use Illuminate\Support\Facades\Request;

if (!function_exists('getSidebarActiveIndex')) {
    function getSidebarActiveIndex($text)
    {
        $index = explode('/', \Illuminate\Support\Facades\Request::path())[0];
        if ($index === $text) {
            return true;
        }

        return false;
    }
}

if (!function_exists('api_success')) {
    function api_success($data = null)
    {
        $apiSuccess = new ApiResponse();

        return $apiSuccess->success($data);
    }
}

if (!function_exists('api_error')) {
    function api_error($code = 99999, $data = null)
    {
        $apiError = new ApiResponse();

        return $apiError->error($code, $data);
    }
}

if (!function_exists('user_id')) {
    function user_id()
    {
        $token = Request::get('access_token', rand(0, 1000));
        $user = UserList::query()->where('token', $token)->first();

        if (empty($user)) {
            return 0;
        }

        return $user->id;
    }
}