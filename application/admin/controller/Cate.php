<?php
/*
 * 用户管理模块
 */

namespace app\admin\controller;
//引入控制器空间
use app\admin\model\Cate as CateModel;

//起一个别名


//继承控制器
class Cate extends BaseController
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('title','博客后台-栏目管理');
    }
    //栏目列表
    public function lst()
    {
        //1.获取数据
        $cate = CateModel::paginate(3);
        //$list = Admin::order('id desc')->limit(5)->select();
        $this->assign('list',$cate);
        return $this->fetch('');
    }
    //添加栏目
    public function add()
    {
        //如果post提交过来
        if(request()->isPost())
        {
            //dump(input('post.'));
            $data = [
                'catename'=>input('catename'),
            ];
            $validate = validate('cate');
            if(!$validate->scene('add')->check($data))
            {
                $this->error($validate->getError());
                die;
            }
            //插入的是单条数据
            $res = db('cate')->insert($data);
            if($res)
            {
                $this->success('添加成功','/cate/lst');
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
        $cates = db('cate')->find($id);
        if($id == 1)
        {
            $this->error('首页栏目不能修改');
        }
        else
        {
            if(request()->isPost())
            {
                $data = [
                    'id' =>input('id'),
                    'catename' =>input('catename'),
                ];
                $validate = validate('cate');
                if(!$validate->scene('edit')->check($data))
                {
                    $this->error($validate->getError());
                    die;
                }
                else
                {
                    if(db('cate')->update($data))
                    {
                        $this->success('修改栏目信息成功','/cate/lst');
                    }
                    else
                    {
                        $this->error('修改栏目失败');
                    }

                }
            }
        }
        $this->assign('cates',$cates);
        return $this->fetch('add');
    }
    //删除
    public function del()
    {
        $id=input("id");
        if($id!=1)
        {
            if(CateModel::destroy(input('id')))
            {
                $this->success('删除栏目成功！');
            }
            else
            {
                $this->error('删除栏目失败');
            }
        }
        else
        {
            $this->error('首页栏目不能删除');
        }
    }
}
