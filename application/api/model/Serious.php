<?php
/**
 * Created by PhpStorm.
 * User: wx
 * Date: 2018/6/14
 * Time: 10:48
 */

namespace app\api\model;

use think\Model;

class Serious extends BaseModel
{
    public function products()
    {
        return $this->hasMany('Product', 'serious_id', 'id');
    }
}