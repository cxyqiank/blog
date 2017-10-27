<?php
namespace app\index\controller;
use app\index\model\Document;

class Search extends BaseController
{
    public function index()
    {
        parent::index();
        //根据关键字查询
        $list = Document::where('title','like','%'.input('get.key').'%')->paginate(5);
        $page = $list->render();
        $this->assign([
                'list'=>$list,
                'page'=>$page,
                'title'=>'博客-搜索结果',
                ]);
        return $this->fetch('search');
    }
    public function tips()
    {
        $data = Document::Search(input('get.key'));
        return json($data);
    }
}