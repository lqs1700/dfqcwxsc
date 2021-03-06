<?php

namespace app\api\model;

use think\Model;

class Product extends BaseModel
{
    protected $autoWriteTimestamp = 'datetime';
    protected $hidden = [
        'delete_time', 'main_img_id','category_id',
        'create_time', 'update_time'];

    /**
     * 图片属性
     */

    public function getMainImageUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public function getDetailImageAttr($value, $data)
    {
        $status = [1=>'index@category4.png',2=>'index@category5.png'];
        $value =$status[$value];
        return $this->prefixImgUrl($value, $data);
    }

    public function properties()
    {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    public function serious(){
        return $this->belongsTo('Serious','serious_id','id');
    }

    public function version(){
        return $this->belongsTo('version','version_id','id');
    }

    /**
     * 获取某分类下商品
     * @param $categoryID
     * @param int $page
     * @param int $size
     * @param bool $paginate
     * @return \think\Paginator
     */
    public static function getProductsByCategoryID($categoryID, $paginate = true, $page = 1, $size = 30)
    {
        $query = self::where('category_id', '=', $categoryID);
        if (!$paginate){
            return $query->select();
        }else{
            // paginate 第二参数true表示采用简洁模式，简洁模式不需要查询记录总数
            return $query->paginate($size, true, ['page' => $page]);
        }
    }

    /**
     * 获取商品详情
     * @param $id
     * @return null | Product
     */
    public static function getProductDetail($id)
    {
        $product = self::with('properties')->find($id);
        return $product;
    }

    public static function getMostRecent($count)
    {
        $products = self::limit($count)
            ->order('create_time desc')
            ->select();
        return $products;
    }
    public static function getProductBySerious($id,$version_id){
        $seriousProduct = self::with(['serious'])
            ->with(['version'])
            ->where('serious_id',$id)
            ->where('version_id',$version_id)
            ->select();
        return $seriousProduct;
    }
}
