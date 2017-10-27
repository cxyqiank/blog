<?php
namespace app\admin\validate;

use think\Validate;

class Link extends Validate
{
        protected $rule = [
        'url'  =>  'require|min:2','名称必须|名称最少25个字符',
         ];
        protected $scene = [
            //只限制了不能为空
            'link_add' => ['url'=>'require']
        ];
}