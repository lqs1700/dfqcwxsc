<?php
namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Category as CategoryModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\MissException;
use think\Controller;

class Category extends BaseController
{
    /**
     * 获取全部类目列表，但不包含类目下的商品
     * @url /category/all
     * @return array of Categories
     * @throws MissException
     */
    public function getAllCategories()
    {
        $categories = CategoryModel::all([], 'img');
        if (empty($categories)) {
            throw new MissException([
                'msg' => '还没有任何类目',
                'errorCode' => 50000
            ]);
        }
        return $categories;
    }

    /**
     * 返回分类下面的products
     * @url /category/:id
     * @return Category single
     * @throws MissException
     */
    public function getCategory($id)
    {
        $validate = new IDMustBePositiveInt();
        $validate->goCheck();
        $category = CategoryModel::getCategory($id);
        if (empty($category)) {
            throw new MissException([
                'msg' => 'category not found'
            ]);
        }
        return $category;
    }
}