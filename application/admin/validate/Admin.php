<?php
namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
        protected $rule = [
        'username'  =>  'require|min:25','名称必须|名称最少25个字符',
         ];
        protected $scene = [
            //只限制了不能为空
            'add' => ['username'=>'require','password'],
            'edit' => ['username'=>'require'],
        ];
}