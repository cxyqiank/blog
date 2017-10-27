<?php
namespace app\index\model;
use think\Model;

class Document extends Model
{
    public static function index($id)
    {
        $res['data']= $data = Document::find($id);
        Document::where('id',$id)->setInc('click');
        //相关阅读
        $res['relations']= $relations = Document::where('cateid',$data['cateid'])
            ->limit(5)
            ->select();
        return $res;
    }
    public static function Search($key)
    {
        $data = Document::where('title','like','%'.$key.'%')
            ->order('id desc')
            ->limit(5)
            ->field('title')
            ->select();
        return $data;
    }
};
