<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/




Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => 'admin'], function()
{
    Route::get('/', 'AdminController@mainIndex');

    //category
    Route::get('/category', 'CategoryController@index')->name('admin.category');
    Route::get('/category/add/{parent_id?}', 'CategoryController@addCategory')->name('admin.addCategory');
    Route::post('/category/create', 'CategoryController@store');
    Route::get('/category/del/{id}', 'CategoryController@destroy')->name('admin.delCategory');
    Route::get('/category/{category}/edit', 'CategoryController@edit')->name('admin.editCategory');
    Route::patch('/category/{category}', 'CategoryController@update');

    Route::post('/category/storeMedia/{item}/{type?}', 'CategoryController@storeMedia');

    //article
    Route::get('/article', 'ArticleController@index')->name('admin.article');
    Route::get('/article/{article}/edit', 'ArticleController@edit')->name('admin.editArticle');
    Route::patch('/article/{article}', 'ArticleController@update');
    Route::get('/article/create', 'ArticleController@create')->name('admin.createArticle');
    Route::post('/article/create', 'ArticleController@store');
    Route::get('/article/{article}/copy', 'ArticleController@copy')->name('admin.copyArticle');
    Route::post('/article/recalculatePrices', 'ArticleController@recalculatePrices');
    Route::delete('/article/{article}', 'ArticleController@destroy');

    Route::post('/item/storeMedia/{item}/{type?}', 'ArticleController@storeMedia');

    //vendor
    Route::get('/vendor', 'VendorController@index')->name('admin.vendor');
    Route::post('/vendor/create', 'VendorController@store');
    Route::get('/vendor/{vendor}/edit', 'VendorController@edit')->name('admin.editVendor');
    Route::delete('/vendor/{vendor}', 'VendorController@destroy');
    Route::patch('/vendor/{category}', 'VendorController@update');

    Route::post('/vendor/storeMedia/{item}/{type?}', 'VendorController@storeMedia');

    //parameters category
    Route::get('/parameter-category', 'ParameterCategoryController@index')->name('admin.parameter-category');
    Route::post('/parameter-category/create', 'ParameterCategoryController@store');
    Route::get('/parameter-category/{parameter_category}/edit', 'ParameterCategoryController@edit')->name('admin.editParameter-category');
    Route::delete('/parameter-category/{parameter_category}', 'ParameterCategoryController@destroy');
    Route::patch('/parameter-category/{parameter_category}', 'ParameterCategoryController@update');

    //parameter
    Route::get('/parameter/group/{group}', 'ParameterController@index')->name('admin.parameter');
    Route::post('/parameter/create', 'ParameterController@store');
    Route::get('/parameter/{parameter}/edit', 'ParameterController@edit')->name('admin.editParameter');
    Route::delete('/parameter/{parameter}', 'ParameterController@destroy');
    Route::patch('/parameter/{parameter}', 'ParameterController@update');

    //order
    Route::get('/order', 'OrderController@index')->name('admin.order');
    Route::get('/order/{order}/edit', 'OrderController@edit')->name('admin.editOrder');
    Route::patch('/order/{order}/update', 'OrderController@update');
});

Route::get('/', 'HomePageController@index');

Auth::routes();

//Route::get('/home', 'HomeController@index');

Route::get('/артикул/{article}', 'ArticleController@show')->name('showArticle');
Route::get('/артикул/{article}/в-корзину', 'ArticleController@addArticleToCart')->name('addArticleToCart');
Route::post('/артикул/{article}/в-корзину', 'ArticleController@addArticleToCart')->name('addArticleToCart');

Route::get('/setArticleCount', 'ArticleController@SetArticleCountToCart');

Route::get('/категория/{category}', 'CategoryController@show')->name('showCategory');

Route::get('/категория/order/{order?}', 'CategoryController@setArticlesOrder')->name('setArticlesOrder');
Route::post('/категория/setParameters', 'CategoryController@setParameters');


Route::get('/показать-заказ/', 'OrderController@show')->name('showOrder');
Route::post('/показать-заказ/create', 'OrderController@store');
Route::get('/успешный-заказ/{id}', 'OrderController@showSuccess')->name('showSuccessOrder');
