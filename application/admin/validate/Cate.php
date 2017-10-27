<?php
namespace app\admin\validate;

use think\Validate;

class Cate extends Validate
{
        protected $rule = [
        'catename'  =>  'require',
         ];
        protected $scene = [
            //只限制了不能为空
            'add' => ['catename'=>'require'],
            'edit' => ['catename'=>'require'],
        ];
}