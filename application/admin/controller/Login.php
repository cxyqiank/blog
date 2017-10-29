<?php
//登录
namespace app\Admin\controller;
use think\Controller;
use think\Request;
use think\Session;

class Login extends Controller
{
    //默认访问与方法同名入口文件
    public function index(Request $request)
    {
        //如果post提交
        if(request()->isPost())
        {
            //查询数据
            $input = input('post.');
            //先验证验证码
            $validate = validate('login');
            if(!$validate->batch()->check(input('post.')))
            {
                $error = $validate->getError();
                foreach($error as $k=>$v)
                {
                    echo $v.'<br>';
                }
                die;
            }

            $res = \app\admin\model\Admin::where('username','eq',$input['username'])
                ->field('password')
                ->find()
                ->toArray();
            if(md5($input['password'])==$res['password'])
            {
                //将用户名存入session
                Session::set('admin',$input['username']);
                $this->redirect('/admin');
            }
        }
        else
        {
            return $this->fetch('admin/login');
        }
    }
    public function logout()
    {
        $res = Session::pull('admin');
        if($res)
        {
            $this->success('登出成功','/admin/login');
        }else{
            $this->error('登出失败');
        }
    }
}