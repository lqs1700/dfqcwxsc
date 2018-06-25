<?php
/**
 * Created by PhpStorm.
 * User: wx
 * Date: 2018/6/22
 * Time: 14:29
 */

namespace app\lib\exception;


class CateProException extends BaseException
{
    public $code = 404;
    public $msg = '该类目下无产品';
    public $errorCode = 20000;
}