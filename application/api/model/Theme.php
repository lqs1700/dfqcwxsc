<?php

namespace app\api\model;

use app\lib\exception\ProductException;
use app\lib\exception\ThemeException;
use think\Model;

class Theme extends BaseModel
{
    protected $hidden = ['delete_time', 'topic_img_id'];
    /**
     * 关联Image
     * 要注意belongsTo和hasOne的区别
     * 带外键的表一般定义belongsTo，另外一方定义hasOne
     */
    public function topicImg()
    {
        return $this->belongsTo('Image', 'topic_image_id', 'id');
    }

    /**
     * 关联product，多对多关系
     */
    public function products()
    {
        return $this->belongsToMany(
            'Product', 'theme_product', 'product_id', 'theme_id');
    }

    public function getThemes()
    {

    }
    
    public static function getThemeWithProducts($id)
    {
        $themes = self::with('products,topicImg')
            ->find($id);
        return $themes;
    }

    /**
     * 获取主题列表
     * @param $ids array
     * @return array
     */
    public static function getThemeList($ids)
    {
        if (empty($ids)){
            return [];
        }
        $themes = self::with('products,img')->select($ids);
        return $themes;
    }

    public static function addThemeProduct($themeID, $productID)
    {
        $models = self::checkRelationExist($themeID, $productID);
        $models['theme']->products()
            ->attach($productID);
        return true;
    }

    public static function deleteThemeProduct($themeID, $productID)
    {
        $models = self::checkRelationExist($themeID, $productID);
        $models['theme']->products()
            ->detach($productID);
        return true;
    }

    private static function checkRelationExist($themeID, $productID)
    {
        $theme = self::get($themeID);
        if (!$theme)
        {
          throw new ThemeException(); 
        }
        $product = Product::get($productID);
        if (!$product)
        {
            throw new ProductException(); 
        }
        return [
            'theme' => $theme,
            'product' => $product
        ];
    }
}