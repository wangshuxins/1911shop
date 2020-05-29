<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::any('add','HelloController@test');
//Route::match(['get','post'],'add','HelloController@test');
//Route::get('add',function(){

//return view('add');

//});
//Route::view('add','add');
Route::post('doadd','HelloController@doadd');
//Route::get('show/{id}/{name}',function($id,$name){

//echo "doadd".'-'.$id.'-'.$name;

//})->where(['id'=>'\d','name'=>'\d']);

Route::get('show/{id}/{name}','HelloController@show');

Route::get('list','Student@list');
Route::get('create','Student@create');
Route::post('store','Student@store');
//后台
//商品品牌模块
Route::domain('admin.com')->group(function(){
Route::get('/','Admin\admin@index')->middleware('login');
Route::prefix('brand')->middleware('login')->group(function(){
Route::get('/','Admin\BrandController@index');
Route::get('create','Admin\BrandController@create');
Route::post('store','Admin\BrandController@store');
Route::get('edit/{id}','Admin\BrandController@edit');
Route::post('update/{id}','Admin\BrandController@update');
Route::get('destroy/{id}','Admin\BrandController@destroy');
Route::post('checknamea','Admin\BrandController@checkNamea');
Route::post('updateNamea','Admin\BrandController@updateNamea');
});
//商品分类模块
Route::prefix('category')->middleware('login')->group(function(){
Route::get('/','Admin\CategoryController@index');
Route::get('create','Admin\CategoryController@create');
Route::post('store','Admin\CategoryController@store');
Route::get('edit/{id}','Admin\CategoryController@edit');
Route::post('update/{id}','Admin\CategoryController@update');
Route::get('destroy/{id}','Admin\CategoryController@destroy');
Route::post('checknameb','Admin\CategoryController@checkNameb');
Route::post('updateNameb','Admin\CategoryController@updateNameb');
});
//商品模块
Route::prefix('goods')->middleware('login')->group(function(){
Route::get('/','Admin\Shop_goods@index');
Route::get('create','Admin\Shop_goods@create');
Route::post('store','Admin\Shop_goods@store');
Route::get('edit/{id}','Admin\Shop_goods@edit');
Route::post('update/{id}','Admin\Shop_goods@update');
Route::get('destroy/{id}','Admin\Shop_goods@destroy');
Route::post('checknamec','Admin\Shop_goods@checkNamec');
Route::post('updateNamec','Admin\Shop_goods@updateNamec');
});
//管理员模块
Route::prefix('admin')->middleware('login')->group(function(){
Route::get('/','Admin\admin@index');
Route::get('create','Admin\admin@create');
Route::post('store','Admin\admin@store');
Route::get('edit/{id}','Admin\admin@edit');
Route::post('update/{id}','Admin\admin@update');
Route::get('destroy/{id}','Admin\admin@destroy');
Route::post('checknamed','Admin\admin@checkNamed');
Route::post('updateNamed','Admin\admin@updateNamed');
});
//登陆模块
Route::prefix('login')->group(function(){
Route::get('/','Admin\login@index');
Route::post('dologin','Admin\login@logindo');
Route::get('logout','Admin\login@logout');
});
//练习cookie
Route::get('/setcookie','Admin\login@setcookie');
Route::get('/getcookie','Admin\login@getcookie');
//文章模块
Route::prefix('article')->middleware('login')->group(function(){
Route::get('/','Admin\article@index');
Route::get('create','Admin\article@create');
Route::post('store','Admin\article@store');
Route::get('edit/{id}','Admin\article@edit');
Route::post('update/{id}','Admin\article@update');
Route::get('destroy/{id}','Admin\article@destroy');
Route::post('checkName','Admin\article@checkName');
Route::post('updateName','Admin\article@updateName');
});
});
//前台
Route::domain('blog.com')->group(function(){
//注册
Route::get('/','Index\IndexController@index')->name('shop.index');
Route::get('/register','Index\LoginController@register');
Route::get('/sendSms','Index\LoginController@sendSms');
Route::get('/sendEmail','Index\LoginController@sendEmail');
Route::post('/doregister','Index\LoginController@doregister');
Route::post('/checkName','Index\LoginController@checkName');
//登陆
Route::get('/login','Index\LoginController@login');
Route::post('/dologin','Index\LoginController@dologin');
Route::get('logout','Index\LoginController@logout');
//详情
Route::get('/proinfo/{id}','Index\ProinfoController@proinfo')->name('shop.goods');
Route::get('/buycar','Index\ProinfoController@buycar');
Route::get('/car','Index\ProinfoController@car')->middleware('checkmember')->name('shop.car');
Route::get('/changeNumber','Index\ProinfoController@changeNumber');
Route::get('/getTotal','Index\ProinfoController@getTotal');
Route::get('/getMoney','Index\ProinfoController@getMoney');
Route::get('/carDel','Index\ProinfoController@carDel');
Route::get('/Sum','Index\ProinfoController@Sum');

});
//新闻
Route::get('/news','NewsController@index');


