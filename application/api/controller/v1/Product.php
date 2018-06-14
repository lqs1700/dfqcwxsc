<?php

namespace app\api\controller\v1;

use app\api\model\Product as ProductModel;
use app\api\validate\Count;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\PagingParameter;
use app\lib\exception\ParameterException;
use app\lib\exception\ProductException;
use app\lib\exception\ThemeException;
use think\Controller;
use think\Exception;

class Product extends Controller
{
    protected $beforeActionList = [
        'checkSuperScope' => ['only' => 'createOne,deleteOne']
    ];
    
    /**
     * 根据类目ID获取该类目下所有商品(分页）
     * @url /product?id=:category_id&page=:page&size=:page_size
     * @param int $id 商品id
     * @param int $page 分页页数（可选)
     * @param int $size 每页数目(可选)
     * @return array of Product
     * @throws ParameterException
     */
    public function getByCategory($id = -1, $page = 1, $size = 30)
    {
        (new IDMustBePositiveInt())->goCheck();
        (new PagingParameter())->goCheck();
        $pagingProducts = ProductModel::getProductsByCategoryID($id, true, $page, $size);
        if ($pagingProducts->isEmpty())
        {
            return ['current_page' => $pagingProducts->currentPage(),'data' => []];
        }
        $data = $pagingProducts->hidden(['detail_image'])->toArray();
        return [
            'current_page' => $pagingProducts->currentPage(),
            'data' => $data
        ];
    }

    public function getBySerious($id,$version_id=1){
        (new IDMustBePositiveInt())->goCheck();
        $serProduct= ProductModel::getProductBySerious($id,$version_id);
        return $serProduct;
    }

    /**
     * 获取某分类下全部商品(不分页）
     * @url /product/all?id=:category_id
     * @param int $id 分类id号
     * @return \think\Paginator
     * @throws ThemeException
     */
    public function getAllInCategory($id = -1)
    {
        (new IDMustBePositiveInt())->goCheck();
        $products = ProductModel::getProductsByCategoryID($id, false);
        if ($products->isEmpty()){
            throw new ThemeException();
        }
        $data = $products->hidden(['detail_image'])->toArray();
        return $data;
    }

    /**
     * 获取指定数量的最近商品
     * @url /product/recent?count=:count
     * @param int $count
     * @return mixed
     * @throws ParameterException
     */
    public function getRecent($count = 15)
    {
        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);
        if ($products->isEmpty())
        {

        }
        $products = $products->hidden(['detail_image'])->toArray();
        return $products;
    }

    /**
     * 获取商品详情
     * 如果商品详情信息很多，需要考虑分多个接口分布加载
     * @url /product/:id
     * @param int $id 商品id号
     * @return Product
     * @throws ProductException
     */
    public function getOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $product = ProductModel::getProductDetail($id);
        if (!$product){
            throw new ProductException();
        }
        return $product;
    }
}