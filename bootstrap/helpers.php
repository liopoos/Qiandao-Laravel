<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-26
 * Time: 16:28
 */

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