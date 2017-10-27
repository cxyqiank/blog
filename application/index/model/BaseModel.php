<?php

namespace app\index\model;

use think\Model;

class BaseModel extends Model
{
    public static function common()
    {
        $data = [];
        $data['cates'] = Cate::limit(10)->select();
        $data['tags'] = Tags::limit(10)->select();
        $data['hots'] = Document::order('click desc')
            ->limit(5)
            ->select();
        $data['url'] = Link::all();
        return $data;
    }
}
