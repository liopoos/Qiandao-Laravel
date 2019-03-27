<?php
/**
 * Created by PhpStorm.
 * User: shaoshuai
 * Date: 2019-03-26
 * Time: 18:01
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class TemplateList extends Model
{
    protected $table = 'template_list';

    protected $primaryKey = 'tid';

    protected $fillable = [
        'name', 'description', 'har_content', 'request_url', 'request_method', 'header_replace', 'query_replace', 'post_replace', 'success_response', 'created_at'
    ];

    protected $hidden = ['is_valid'];
}