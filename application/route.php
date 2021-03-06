<?php

use think\Route;

//Banner
Route::get('api/:version/banner/:id', 'api/:version.Banner/getBanner');                     //己完成  d.cn/api/v1/banner/1

//Category
Route::get('api/:version/category/all', 'api/:version.Category/getAllCategories');          //己完成  d.cn/api/v1/category/all
Route::get('api/:version/category', 'api/:version.Category/getCategory');                   //己完成  d.cn/api/v1/category?id=23

//theme
Route::group('api/:version/theme',function(){
    Route::get('', 'api/:version.Theme/getSimpleList');                                     //己完成  d.cn/api/v1/theme?ids=1,2,3
    Route::get('/:id', 'api/:version.Theme/getComplexOne');                                 //己完成  d.cn/api/v1/theme/2
});

//Product
Route::group('api/:version/product',function(){
    Route::get('/by_category/paginate','api/:version.Product/getByCategory');
    Route::get('/by_serious','api/:version.Product/getBySerious');                          //己完成   d.cn/api/v1/product/by_serious?id=2&&version_id=1
    Route::get('/by_category','api/:version.Product/getAllInCategory');
    Route::get('/recent','api/:version.Product/getRecent');
    Route::get('/:id','api/:version.Product/getOne');
});

//Route::get('api/:version/product/by_category/paginate', 'api/:version.Product/getByCategory');    // 己完成 d.cn/api/v1/product/by_category/paginate?id=23
//Route::get('api/:version/product/by_category', 'api/:version.Product/getAllInCategory');          // 己完成 d.cn/api/v1/product/by_category?id=23
//Route::get('api/:version/product/:id', 'api/:version.Product/getOne',[],['id'=>'\d+']);           // 己完成 d.cn/api/v1/product/15
//Route::get('api/:version/product/recent', 'api/:version.Product/getRecent');                      // 己完成 d.cn/api/v1/product/recent

//version
Route::get('api/:version/version','api/:version.Version/getAllVersion');                            //己完成 d.cn/api/v1/version
//serious
Route::get('api/:version/serious','api/:version.Serious/getAllSerious');                            //己完成 d.cn/api/v1/serious












//Token
Route::post('api/:version/token/user', 'api/:version.Token/getToken');
Route::post('api/:version/token/app', 'api/:version.Token/getAppToken');
Route::post('api/:version/token/verify', 'api/:version.Token/verifyToken');

//Address
Route::post('api/:version/address', 'api/:version.Address/createOrUpdateAddress');
Route::get('api/:version/address', 'api/:version.Address/getUserAddress');

//Order
Route::post('api/:version/order', 'api/:version.Order/placeOrder');
Route::get('api/:version/order/:id', 'api/:version.Order/getDetail',[], ['id'=>'\d+']);
Route::put('api/:version/order/delivery', 'api/:version.Order/delivery');

//不想把所有查询都写在一起，所以增加by_user，很好的REST与RESTFul的区别
Route::get('api/:version/order/by_user', 'api/:version.Order/getSummaryByUser');
Route::get('api/:version/order/paginate', 'api/:version.Order/getSummary');

//Pay
Route::post('api/:version/pay/pre_order', 'api/:version.Pay/getPreOrder');
Route::post('api/:version/pay/notify', 'api/:version.Pay/receiveNotify');
Route::post('api/:version/pay/re_notify', 'api/:version.Pay/redirectNotify');
Route::post('api/:version/pay/concurrency', 'api/:version.Pay/notifyConcurrency');

//Message
Route::post('api/:version/message/delivery', 'api/:version.Message/sendDeliveryMsg');