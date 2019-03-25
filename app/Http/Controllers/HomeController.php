<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-25
 * Time: 14:26
 */

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}