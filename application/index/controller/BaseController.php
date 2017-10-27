<?php
/**
 * Created by PhpStorm.
 * User: qianke
 * Date: 2017/10/18 0018
 * Time: 下午 22:32
 */

namespace app\index\controller;

use app\index\model\BaseModel;
use \app\index\model\Cate;
use \app\index\model\Link;
use \app\index\model\Tags;
use \app\index\model\Document;
use think\Controller;

class BaseController extends Controller
{
    protected function index()
    {
        //公共数据
        $data = BaseModel::common();
        $this->assign([
            'cates'=>$data['cates'],
            'tags'=>$data['tags'],
            'hots'=>$data['hots'],
            'url' =>$data['url']
            ]);
    }
}