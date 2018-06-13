<?php

namespace app\api\model;

use think\Model;

class Category extends BaseModel
{
    public function products()
    {
        return $this->hasMany('Product', 'category_id', 'id');
    }

    public function img()
    {
        return $this->belongsTo('Image', 'top_image_id', 'id');
    }

    public static function getCategory($id)
    {
        $category = self::with('products')
            ->find($id);
        return $category;
    }
}