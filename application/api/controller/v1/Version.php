<?php
/**
 * Created by PhpStorm.
 * User: wx
 * Date: 2018/6/14
 * Time: 10:50
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\Version as VersionModel;
use app\lib\exception\MissException;

class Version extends BaseController
{
    public function getAllVersion()
{
    $versions = VersionModel::all();
    if (empty($versions)) {
        throw new MissException([
            'msg' => '还没有任何内容',
            'errorCode' => 50000
        ]);
    }
    return $versions;
}
}