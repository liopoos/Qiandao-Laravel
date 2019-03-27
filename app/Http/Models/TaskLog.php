<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-27
 * Time: 13:50
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    public $timestamps = false;

    protected $table = 'task_log';

    protected $primaryKey = 'log_id';

    protected $fillable = [
        'task_id', 'executed_at', 'is_success', 'response'
    ];
}