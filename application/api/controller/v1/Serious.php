<?php
/**
 * Created by PhpStorm.
 * User: wx
 * Date: 2018/6/14
 * Time: 10:50
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Serious as SeriousModel;
use app\lib\exception\MissException;
use think\Controller;

class Serious extends BaseController
{
    public function getAllSerious()
    {
        $serious = SeriousModel::all();
        if (empty($serious)) {
            throw new MissException([
                'msg' => '还没有任何内容',
                'errorCode' => 50000
            ]);
        }
        return $serious;
    }
}