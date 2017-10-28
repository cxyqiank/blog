<?php
/**
 * Created by PhpStorm.
 * User: qianke
 * Date: 2017/10/18 0018
 * Time: 下午 14:31
 */

namespace app\admin\controller;
use think\Controller;
use think\Session;

class BaseController extends Controller
{
    //初始化函数
    public function _initialize()
    {
        parent::_initialize();
        //判断用户是否登录
        if(!Session::has('admin'))
        {
            $this->redirect('/admin/login');
        }
        $admin = Session::get('admin');
        $id = \app\admin\model\Admin::where('username',$admin)
            ->field('id')
            ->select();
        $this->assign([
            'admin'=>$admin,
            'id'=>$id[0]['id'],
            ]);
    }
    public function myThumb()
    {
        $file = request()->file('pic');
        $type = substr($file->getInfo('type'),6);
        $size = $file->getSize();
        $allow = ['jpeg','jpg','png','gif'];
        //图片类型
        if(!in_array($type,$allow))
        {
            $this->error('图片类型错误');
        }
        if($size>10*1024*1024)
        {
            $this->error('图片过大');
        }
        //保存缩略图
        $image = \think\Image::open($file);
        $dir = ROOT_PATH . 'public/uploads/thumb/'.date('Y/md').'/';
        $fileName = rand(10,10000).$file->getInfo('name');
        if(!is_dir($dir))
        {
            echo $dir;
            mkdir($dir,0777,true);
        }
        $res = $image->thumb(230,200)->save($dir.$fileName);
        $data = ['fileName'=>$fileName,'status'=>$res];
        return $data;
    }
    public function MISS()
    {
        $this->error('404 找不到要访问的地址');
    }
}