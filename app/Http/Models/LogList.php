<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-29
 * Time: 15:43
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class LogList extends Model
{
    protected $table = 'log_list';

    protected $primaryKey = 'log_id';

    protected $fillable = [
        'log_id', 'uid', 'action', 'created_at'
    ];
}