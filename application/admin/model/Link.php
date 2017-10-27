<?php
namespace app\admin\model;
class Link extends BaseModel
{
    public static function add($data)
    {
        $data = [
            'url'=>$data['url'],
            'title'=>$data['title'],
            'desc'=>$data['desc']
        ];
        return Link::create($data);
    }
    public static function edit($data)
    {
        $data = [
            'url'=>$data['url'],
            'title'=>$data['title'],
            'desc'=>$data['desc'],
            'id'=>$data['id']
        ];
        return db('link')
            ->where('id',$data['id'])
            ->update($data);
    }
}