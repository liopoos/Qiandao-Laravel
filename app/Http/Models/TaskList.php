<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-27
 * Time: 13:48
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    public $timestamps = false;

    protected $table = 'task_list';

    protected $primaryKey = 'task_id';

    protected $fillable = [
        'tid', 'uid', 'header_replace', 'replace_content', 'is_valid', 'is_delete'
    ];

    protected $hidden = ['is_valid', 'is_delete'];
}