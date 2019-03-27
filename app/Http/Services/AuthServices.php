<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-26
 * Time: 14:05
 */

namespace App\Http\Services;


use App\Http\Models\UserList;
use Illuminate\Support\Facades\Hash;

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

        return $user;
    }
}