<?php
/*
 * 用户管理模块
 */

namespace app\admin\controller;

//起一个别名
use app\admin\model\Cate as CateModel;
use app\admin\model\Document as DocModel;

//继承控制器
class Document extends BaseController
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('title','博客后台-文章管理');
    }
    //文章列表
    public function lst()
    {
        //1.获取数据
        $list = DocModel::paginate(3);

        //$list = Admin::order('id desc')->limit(5)->select();
        $this->assign('list',$list);
        return $this->fetch('');
    }
    //添加文章
    public function add()
    {
        //如果post提交过来
        if(request()->isPost())
        {
            //dump(input('post.'));
            $validate = validate('document');
            //压缩图像
            $res = $this->myThumb();
            $input = input('post.');
            $input['time'] = time();
            $input['click'] = 0;
            $input['pic'] = './uploads/thumb/'.date('Y/md').'/'.$res['fileName'];
            $input['state'] = 1;
            if(!$validate->scene('add')->check($input))
            {
                $this->error($validate->getError());
                die;
            }
            //插入的是单条数据
            $res2 = db('document')->insert($input);
            if($res2&&$res['status'])
            {
                $this->success('添加成功','/document/lst');
            }
            else
            {
                $this->error('添加失败');
            }
        }
        $list =  db('cate')->select();
        //$list = Admin::order('id desc')->limit(5)->select();
        $this->assign('cate',$list);
        return $this->fetch('');
    }
    //修改页面
    public function edit()
    {
        if(request()->post())
        {
            $input = input('post.');
            if(request()->file('pic'))
            {
                $id = input("id");
                $pic = DocModel::field('pic')->find($id);
                $res1 = unlink($pic['pic']);
                if(!$res1)
                {
                    $this->error('删除原图失败');
                }
                $res = $this->myThumb();
                $input['pic'] = './uploads/thumb/'.date('Y/md').'/'.$res['fileName'];
                if(!$res)
                {
                    $this->error('图像压缩失败');
                }
            }
            $input['time'] = time();
            $input['click'] = 0;
            $input['state'] = 1;
            $res = DocModel::update($input,['id'=>$input['id']]);
            if($res)
            {
                $this->success('修改成功','/document/lst');
            }
            else
            {
                $this->error('修改失败，请稍后重试');
            }
        }
        $id = input('id');
        $document = DocModel::where('id',$id)->select();
        $cate = CateModel::limit(10)->select();
        $this->assign('cate',$cate);
        $this->assign('document',$document);
        return $this->fetch('');
    }
    //删除
    public function del()
    {
        $id = input("id");
        $pic = DocModel::field('pic')->find($id);
            //删除图片
        $res = unlink($pic['pic']);
        if($res)
        {
            if(DocModel::destroy(input('id')))
            {
                $this->success('删除文章成功！','/document/lst');
            }
            else
            {
                $this->error('删除文章失败');
            }
        }
        else
        {
            $this->error('删除图片失败');
        }

    }
}
