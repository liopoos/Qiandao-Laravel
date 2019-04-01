<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-26
 * Time: 14:14
 */

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserList extends Authenticatable
{
    use Notifiable;
    protected $table = 'user_list';

    protected $fillable = [
        'username', 'email', 'password', 'created_at', 'expired_at', 'token',
    ];

    protected $hidden = [
        'password',
    ];

    public function getExpiredAtAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
}