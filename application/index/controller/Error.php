<?php
/**
 * Created by PhpStorm.
 * User: qianke
 * Date: 2017/10/22 0022
 * Time: 下午 22:33
 */

namespace app\index\controller;


use think\Request;

class Error
{
    public function index(Request $request)
    {
        return '<html>111</html>';
    }
    //MISS路由
    public function MISS()
    {
        return '404';
    }
}