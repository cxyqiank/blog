<?php
/*
 * 用户管理模块
 */

namespace app\admin\controller;
//引入控制器空间
use app\admin\model\Admin as AdminModel;

//起一个别名

//继承控制器
class Admin extends BaseController
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('title','博客后台-用户管理');
    }

    //用户列表
    public function lst()
    {
        //1.获取数据
        $list = AdminModel::paginate(3);
        //$list = Admin::order('id desc')->limit(5)->select();
        $this->assign('list',$list);
        return $this->fetch('');
    }
    //添加用户
    public function add()
    {
        //如果post提交过来
        if(request()->isPost())
        {
            $validate = validate('admin');
            if(!$validate->scene('add')->check(input('post.')))
            {
                $this->error($validate->getError());
                die;
            }
            $res = AdminModel::add(input('post.'));
            if($res)
            {
                $this->success('添加成功','/admin/lst');
            }
            else
            {
                $this->error('添加失败');
            }
        }
        return $this->fetch('');
    }
    //修改页面
    public function edit()
    {
        $id = input('id');
        $admins = db('admin')->find($id);
        if(request()->isPost())
        {
            $validate = validate('admin');
            if(!$validate->scene('edit')->check(input('post.')))
            {
                $this->error($validate->getError());
                die;
            }
            $res = AdminModel::edit(input('post.'),$admins);
            if($res)
            {
                $this->success('修改管理员信息成功','/admin/lst');
            }
            else
            {
                $this->error('修改管理员失败');
            }
        }
        $this->assign('admins',$admins);
        return $this->fetch('');
    }
    //删除
    public function del()
    {
        $id=input("id");
        if($id!=1)
        {
            if(AdminModel::destroy(input('id')))
            {
                $this->success('删除管理员成功！','/admin/lst');
            }
            else
            {
                $this->error('删除管理员失败');
            }
        }
        else
        {
            $this->error('初始化管理员不能删除！');
        }
    }
}
