<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-26
 * Time: 14:14
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    protected $table = 'user_list';

    protected $fillable = [
        'username', 'email', 'password', 'created_at',
    ];

    protected $hidden = [
        'password', 'token',
    ];
}