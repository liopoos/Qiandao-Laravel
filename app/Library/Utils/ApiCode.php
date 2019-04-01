<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-04-01
 * Time: 11:52
 */

namespace App\Library\Utils;


class ApiCode
{
    const SUCCESS = 1;
    const UNKNOWN_ERROR = 99999;

    const TMP_ERROR = 10001;
    const PARAM_ERROR = 10002;
    const AUTH_ERROR = 10003;
    const REQUEST_ERROR = 10004;
    const INVALID_USER = 10005;
    const PERMISSION_ERROR = 10006;

    protected $code;

    protected $msg;

    protected static $codeMsg = [
        self::UNKNOWN_ERROR => '未知错误',
        self::TMP_ERROR => '时间戳错误',
        self::PARAM_ERROR => '参数错误',
        self::AUTH_ERROR => '认证错误',
        self::REQUEST_ERROR => '请求错误',
        self::INVALID_USER => '用户不存在',
        self::PERMISSION_ERROR => '权限错误',
    ];

    public function __construct($code, $msg = null)
    {
        $this->code = $code;
        $this->msg = $msg;
    }

    public function getCode()
    {
        return $this->code;
    }

    public static function getErrorMsg($code)
    {
        if (empty($code)) {
            return 'SUCCESS';
        }

        if (isset(self::$codeMsg[$code])) {
            return self::$codeMsg[$code];
        }

        return self::$codeMsg[self::UNKNOWN_ERROR];
    }
}