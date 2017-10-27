<?php
//声明本文件的命名空间
namespace app\index\controller;
//访问控制器所在的命名空间
use app\index\model\Document;
//继承控制器类
class Index extends BaseController
{
    //定义模板方法
    public function index()
    {
        parent::index();
        //调用模板，fetch()中不填值为调用此方法名的模板
        //分页
        $list = Document::where('state',1)->paginate(5);
        $page = $list->render();
        $this->assign([
            'list'=>$list,
            'page'=>$page,
            'title'=>'博客-首页',
                ]);
        return $this->fetch();
    }

}
