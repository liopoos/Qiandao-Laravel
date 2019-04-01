<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-04-01
 * Time: 11:53
 */

namespace App\Library\Utils;


use Illuminate\Contracts\Support\Arrayable;

class ApiResponse implements Arrayable
{
    /**
     * Success response.
     */
    const RESPONSE_OK = 200;

    /**
     * Error response.
     */
    const RESPONSE_ERROR = 400;

    /**
     * Response status, success is default.
     *
     * @var int
     */
    protected $status = self::RESPONSE_OK;

    /**
     * Response message, ok is default.
     *
     * @var string
     */
    protected $msg = '';

    /**
     * Response body, empty array is default.
     *
     * @var array
     */
    protected $data = null;

    /**
     * Response code, just for the developer.
     *
     * @var integer
     */
    protected $code = 0;

    /**
     * Return the failed response.
     *
     * @param mixed $code error code
     * @param array $data
     * @return ApiResponse
     */
    public function error($code, $data = null)
    {
        if ($code instanceof ApiCode) {
            $this->code = intval($code->getCode());
        } else {
            $this->code = $code;
        }

        $this->data = $data;
        $this->status = self::RESPONSE_ERROR;

        return $this;
    }

    /**
     * Return the success response.
     *
     * @param array $data response body
     * @param int $status response status
     * @return ApiResponse
     */
    public function success($data = null)
    {
        $this->data = $data;
        $this->status = self::RESPONSE_OK;

        return $this;
    }

    /**
     * 指定返回消息内容
     * @param $message
     * @return $this
     */
    public function message($message)
    {
        $this->msg = $message;

        return $this;
    }

    /**
     * 指定返回状态码
     * @param $status
     * @return $this
     */
    public function status($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * 指定返回data
     * @param $data
     * @return $this
     */
    public function data($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $result = [
            'code' => $this->code,
            'status' => $this->status,
        ];
        if (!empty($this->msg)) {
            $result['msg'] = $this->msg;
        } else {
            $result['msg'] = ApiCode::getErrorMsg($this->code) ?: 'SUCCESS';
        }
        if (!is_null($this->data)) {
            $result['data'] = $this->data;
        }
        return $result;
    }

    /**
     * Convert the collection to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->toArray());
    }
}