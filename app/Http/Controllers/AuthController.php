<?php /** @noinspection ALL */

/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-25
 * Time: 14:42
 */

namespace App\Http\Controllers;


use App\Http\Services\AuthServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        if ($this->request->method() == 'POST') {
            $validator = Validator::make($this->request->all(), [
                'email' => 'bail|required|email|max:255|exists:user_list,email',
                'password' => 'required|max:64|min:8',
            ], [
                'email.required' => '电子邮箱地址是必须的',
                'email.exists' => '电子邮箱地址不存在，请先注册',
                'password.required' => '密码是必须的',
                'password.max' => '密码最长不能超过64位',
                'password.min' => '密码至少需要8位'
            ])->validate();

            $credentials = $this->request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect('homeland');
            }

            return 'fail';
        } else {
            return view('auth.login');
        }
    }

    public function register()
    {
        if ($this->request->method() == 'POST') {
            $validator = Validator::make($this->request->all(), [
                'email' => 'bail|required|email|max:255|unique:user_list',
                'password' => 'required|max:64|confirmed|min:8',
            ], [
                'email.required' => '电子邮箱地址是必须的',
                'email.unique' => '电子邮箱地址已存在',
                'password.required' => '密码是必须的',
                'password.confirmed' => '两次密码输入不匹配',
                'password.max' => '密码最长不能超过64位',
                'password.min' => '密码至少需要8位'
            ])->validate();

            $userInfo = AuthServices::register($validator);

            return redirect('homeland');;
        } else {
            return view('auth.register');
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}