<?php
/**
 * Created by PhpStorm.
 * User: wx
 * Date: 2018/6/14
 * Time: 10:49
 */

namespace app\api\model;

use think\Model;

class Version extends BaseModel
{
    public function products()
    {
        return $this->hasMany('Product', 'version_id', 'id');
    }
}