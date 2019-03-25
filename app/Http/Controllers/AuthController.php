<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-25
 * Time: 14:42
 */

namespace App\Http\Controllers;


use ViewTitle;

class AuthController extends Controller
{
    public function login()
    {
        return ViewTitle::TITLE_LOGIN;
    }
}