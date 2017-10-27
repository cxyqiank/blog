<?php
namespace app\admin\validate;

use think\Validate;

class Document extends Validate
{
        protected $rule = [
        'title'  =>  'require','名称必须|名称最少25个字符',
        'content'  =>  'require','名称必须|名称最少25个字符',
         ];
        protected $scene = [
            //只限制了不能为空
            'add' => ['title'=>'require','content'=>'require'],
            'edit' => ['title'=>'require','content'=>'require'],
        ];
}