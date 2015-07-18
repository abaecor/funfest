<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses'=>'HomeController@getIndex'));
Route::controller('home', 'HomeController');

Route::controller('users','UsersController');
Route::controller('admin/users','UsersController');

Route::controller('orders','OrdersController');
Route::controller('admin/orders','OrdersController');

Route::controller('products','ProductsController');
Route::controller('admin/products','ProductsController');

Route::controller('admin/coupons','CouponsController');
Route::controller('coupons','CouponsController');

Route::controller('admin/outlets','OutletsController');

Route::controller('admin/addons','AddonsController');
Route::controller('addons','AddonsController');

Route::controller('admin/categories','CategoriesController');
Route::controller('categories','CategoriesController');

Route::controller('admin/cake','CakeController');
Route::controller('cake','CakeController');
/*
// Home Controller
Route::get('/home/index' , 'HomeController@getIndex');
Route::get('/home/view/{id}' , 'HomeController@getView');
Route::get('/home/category/{id}' , 'HomeController@getCategory');
Route::get('/home/search' , 'HomeController@getSearch');
Route::post('/home/addtocart' , 'HomeController@postAddtocart');
Route::get('/home/cart' , 'HomeController@getCart');
Route::get('/home/removeitem/{id}' , 'HomeController@getRemoveitem');
Route::post('/home/saveorder' , 'HomeController@postSaveorder');
Route::post('/home/sendtocity' , 'HomeController@postSendtocity');
Route::post('/home/filter_price' , 'HomeController@postFilterPrice');


// // Users Controller
Route::get('/users/signin' , 'UsersController@getSignin');
Route::post('/users/signin' , 'UsersController@postSignin');
Route::get('/users/signout' , 'UsersController@getSignout');
Route::get('/users/myaccount' , 'UsersController@getMyaccount');
Route::post('/users/update' , 'UsersController@postUpdate');
Route::post('/users/create' , 'UsersController@postCreate');
Route::get('/users/newaccount' , 'UsersController@getNewaccount');

// Products Controller
Route::get('admin/products/index' , 'ProductsController@getIndex');
Route::post('admin/products/create' , 'ProductsController@postCreate');
Route::post('admin/products/batchup' , 'ProductsController@postBatchup');
Route::post('admin/products/imagebatchup' , 'ProductsController@postImagebatchup');
Route::post('admin/products/destroy' , 'ProductsController@postDestroy');
Route::post('admin/products/fetchtitle' , 'ProductsController@postFetchtitle');
Route::post('admin/products/toggleavailability' , 'ProductsController@postToggleAvailability');
Route::post('admin/products/fetchotherven' , 'ProductsController@postFetchotherven');

// Outlets Controller
Route::get('admin/outlets/index' , 'OutletsController@getIndex');
Route::post('admin/outlets/addoutlets' , 'OutletsController@postAddoutlets');

// Orders Controller
// Route::get('admin/orders/index' , 'OrdersController@getIndex');
// Route::post('/orders/saveorder' , 'OrdersController@postSaveorder');
// Route::post('admin/orders/ratings' , 'OrdersController@postRatings');

// Addons Controller
Route::get('admin/addons/index' , 'AddonsController@getIndex');
Route::post('admin/addons/create' , 'AddonsController@postCreate');

// Categories Controller
Route::get('admin/categories/index' , 'CategoriesController@getIndex');
Route::post('admin/categories/create' , 'CategoriesController@postCreate');
Route::post('admin/categories/destroy' , 'CategoriesController@postDestroy');
*/
