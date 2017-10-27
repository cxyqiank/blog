<?php
namespace app\admin\controller;

class Index extends BaseController
{
    public function index()
    {
        $this->assign('title','博客后台-首页');
        return $this->fetch("index");
    }
}
