<?php
/**
 * Created by PhpStorm.
 * User: qianke
 * Date: 2017/10/28 0028
 * Time: 上午 9:23
 */

namespace app\admin\validate;


use think\Validate;

class Login extends Validate
{
    protected $rule = [
        'captcha'  =>  'require|captcha','验证码必须|验证码错误',
        'username'  =>  'require','用户名必填',
        'password'  =>  'require','密码必填',
    ];
}