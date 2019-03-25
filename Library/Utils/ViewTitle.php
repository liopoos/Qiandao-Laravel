<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-25
 * Time: 14:46
 */

class ViewTitle
{
    const TITLE_LOGIN = '登录';

    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
    }
}