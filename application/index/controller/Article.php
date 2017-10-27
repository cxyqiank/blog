<?php
/*
 * 文章模块
 */

namespace app\index\controller;
//引入控制器空间

//继承控制器
use app\index\model\Document;

class Article extends BaseController
{
    //默认访问与方法同名入口文件
    public function index()
    {   parent::index();
        //根据id查文章
        $res = Document::index(input('id'));
        $this->assign([
            'data'=>$res['data'],
            'relations'=>$res['relations'],
            'title'=>'博客-文章详情',
        ]);
        return $this->fetch('article');
    }
}
