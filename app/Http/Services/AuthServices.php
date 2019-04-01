<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-26
 * Time: 14:05
 */

namespace App\Http\Services;


use App\Http\Models\UserList;
use App\Mail\SendMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthServices
{
    public static function register($validator)
    {
        $emailExists = UserList::query()->where('email', $validator['email'])->count();
        if ($emailExists) {
            return 0;
        }
        $user = UserList::insertGetId([
            'username' => '',
            'email' => $validator['email'],
            'password' => Hash::make($validator['password']),
            'created_at' => time()
        ]);

        Mail::to($validator['email'])->send(new SendMail());

        return $user;
    }

    public static function creatToken($email)
    {
        $token = md5($email . Hash::make(rand(0, 1000)) . time());
        $expireTime = Carbon::now()->addHour(72)->timestamp;

        $user = UserList::query()->where('email', $email)
            ->update([
                'token' => $token,
                'expired_at' => $expireTime
            ]);
    }
}