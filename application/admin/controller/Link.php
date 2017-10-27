<?php
/*
 * 用户管理模块
 */

namespace app\admin\controller;
//引入控制器空间
use app\admin\model\Link as LinkModel;

//继承控制器
class Link extends BaseController
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('title','博客后台-友情链接管理');
    }
    //友情链接列表
    public function link_lst()
    {
        //1.获取数据
        $link = LinkModel::paginate(3);
        $this->assign('list',$link);
        return $this->fetch('');
    }
    //友情链接添加
    public function link_add()
    {
        //如果post提交过来
        if(request()->isPost())
        {
            $validate = validate('link');
            if(!$validate->scene('add')->check(input('post.')))
            {
                $this->error($validate->getError());
                die;
            }
            //插入的是单条数据
            $res = LinkModel::add(input('post.'));
            if($res)
            {
                $this->success('添加成功','/link/lst');
            }
            else
            {
                $this->error('添加失败');
            }
        }
        return $this->fetch('');
    }
    //修改页面
    public function link_edit()
    {
        $id = input('id');
        $links = db('link')->find($id);
        if(request()->isPost())
        {
            $validate = validate('link');
            if(!$validate->scene('link_edit')->check(input('post.')))
            {
                $this->error($validate->getError());
                die;
            }
            $res = LinkModel::edit(input('post.'));
            if($res)
            {
                $this->success('修改友情链接成功','/link/lst');
            }
            else
            {
                $this->error('修改友情链接失败');
            }
        }

        $this->assign('links',$links);
        return $this->fetch('');
    }
    //删除
    public function del()
    {

        if(\app\admin\model\Link::destroy(input('id')))
        {
           $this->success('删除友情链接成功！','/link/lst');
        }
        else
        {
            $this->error('删除友情链接失败');
        }
    }
}
