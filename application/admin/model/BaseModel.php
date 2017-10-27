<?php
/**
 * Created by PhpStorm.
 * User: qianke
 * Date: 2017/10/18 0018
 * Time: 下午 18:54
 */

namespace app\admin\model;


use think\Model;
use traits\model\SoftDelete;

class BaseModel extends Model
{
    use SoftDelete;
    protected $deleteTime = 'deletetime';
}