<?php
/**
 *项目页
 */

namespace app\index\controller;
//引入控制器空间


//继承控制器
use app\index\model\Document;

class Cate extends BaseController
{
    public function index()
    {
        parent::index();
        $list = Document::where('cateid',input('id'))->paginate(5);
        $page = $list->render();
        $this->assign([
            'list'=>$list,
            'page'=>$page,
            'title'=>'博客-栏目',
                ]);
        return $this->fetch('cate');
    }
}
