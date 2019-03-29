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
    public $timestamps = false;

    protected $table = 'template_list';

    protected $primaryKey = 'tid';

    protected $fillable = [
        'name', 'description', 'har_content', 'request_url', 'request_method', 'header_replace', 'query_replace', 'post_replace', 'success_response', 'created_at', 'post_type', 'relation'
    ];

    protected $hidden = ['is_valid'];

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
}