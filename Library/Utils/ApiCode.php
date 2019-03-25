<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-25
 * Time: 14:24
 */

class ApiCode
{
    const SUCCESS = 1;
    const UNKNOWN_ERROR = 99999;

    //详细分类错误
    const TMP_ERROR = 10001;
    const PARAM_ERROR = 10002;
    const AUTH_ERROR = 10003;
    const REQUEST_ERROR = 10004;
    const INVALID_USER = 10005;
    const PERMISSION_ERROR = 10006;

    const MOMENT_NO_EXIST = 20001;

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
        self::MOMENT_NO_EXIST => '时刻不存在',
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