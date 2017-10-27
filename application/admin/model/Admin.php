<?php
namespace app\admin\model;


class Admin extends BaseModel
{
    public static function editPwd($pwd1,$pwd2)
    {
        if($pwd1&&$pwd2)
        {
            $data=md5($pwd1);
        }
        else
        {
            $data=$pwd2;
        }
        return $data;
    }
    public static function add($data)
    {
        $datas = [
            'username'=>$data['username'],
            'password'=>md5($data['password'])
        ];

        //插入的是单条数据
        $res = Admin::create($datas);
        return $res;
    }
    public static function edit($data,$admins)
    {
        $datas = [
            'id' =>$data['id'],
            'username' =>$data['username'],
        ];
        $datas['password'] = AdminModel::editPwd($data['password'],$admins['password']);
        $res = db('admin')->update($datas);
    }
}
