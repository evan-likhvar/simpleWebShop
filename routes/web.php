<?php


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
    Route::get('/articlePriceJSON', 'ArticleController@articlePriceJSON');
    Route::get('/articleToggleJSON', 'ArticleController@articleToggleJSON');
    Route::get('/articleEditTabJSON', 'ArticleController@articleEditTabJSON');

    Route::post('/item/storeMedia/{item}/{type?}', 'ArticleController@storeMedia');
    Route::delete('/article/deletefile/{file}', 'ArticleController@deleteArticleFile');

    //price
    Route::get('/price', 'PriceController@index')->name('admin.priceArticleList');
    Route::post('/price/hotLine', 'PriceController@hotLinePriceXML');
    Route::post('/price/priceUA', 'PriceController@priceUAPriceXML');
    Route::post('/siteMap', 'PriceController@createSiteMap');
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
    Route::delete('/order/{parameter}', 'OrderController@destroy');

    //papers
    Route::get('/paperCategory', 'PaperController@PaperCategoryIndex')->name('admin.paperCategoryIndex');
    Route::post('/paperCategory/create', 'PaperController@PaperCategoryStore');
    Route::get('/paperCategory/{paper}/edit', 'PaperController@editPaperCategory')->name('admin.editPaperCategory');
    Route::delete('/paperCategory/{paper}', 'PaperController@PaperCategoryDestroy');
    Route::patch('/paperCategory/{paper}', 'PaperController@PaperCategoryUpdate');


    Route::get('/paper', 'PaperController@PaperIndex')->name('admin.paper');
    Route::get('/paper/create', 'PaperController@createNewPaper')->name('admin.createPaper');
    Route::post('/paper/create', 'PaperController@PaperStore');
    Route::delete('/paper/{paper}', 'PaperController@PaperDestroy');
    Route::get('/paper/{paper}/edit', 'PaperController@editPaper')->name('admin.editPaper');
    Route::patch('/paper/{paper}', 'PaperController@PaperUpdate');
    Route::post('/paper/storeMedia/{item}/{type?}', 'PaperController@storeMedia');

    //site parameter
    Route::get('/siteParameterEdit', 'SiteParameterController@edit')->name('admin.siteParameterEdit');
    Route::patch('/siteParameterStore', 'SiteParameterController@store');

    //promotion
    Route::get('/promotion', 'PromotionController@PromotionIndex')->name('admin.promotion');
    Route::get('/promotion/create', 'PromotionController@createNewPromotion')->name('admin.createPromotion');
    Route::post('/promotion/create', 'PromotionController@PromotionStore');
    Route::delete('/promotion/{promotion}', 'PromotionController@PromotionDestroy');
    Route::get('/promotion/{promotion}/edit', 'PromotionController@editPromotion')->name('admin.editPromotion');
    Route::patch('/promotion/{promotion}', 'PromotionController@PromotionUpdate');
    Route::post('/promotion/storeMedia/{promotion}/{type?}', 'PromotionController@storeMedia');
    Route::get('/promotion/promotion-article/{promotion}', 'PromotionController@indexPromotionArticle')->name('admin.promotion-article');
    Route::delete('/promotion/{promotion}/{article}', 'PromotionController@PromotionArticleDestroy');
});

Route::get('/', 'HomePageController@index');

Auth::routes();

//Route::get('/home', 'HomeController@index');

Route::get('/купить/{article}', 'ArticleController@show')->name('showArticle');
Route::get('/купить/{article}/в-корзину', 'ArticleController@addArticleToCart')->name('addArticleToCart');
Route::post('/купить/{article}/в-корзину', 'ArticleController@addArticleToCart')->name('addArticleToCart');
Route::get('/setArticleCount', 'ArticleController@SetArticleCountToCart');
Route::get('/articleViewPlate', 'CategoryController@articleViewPlate');
Route::get('/articleViewList', 'CategoryController@articleViewList');
Route::get('/setParametersJSON', 'CategoryController@setParametersJSON');

Route::get('/каталог/{category}', 'CategoryController@show')->name('showCategory');

Route::get('/каталог/order/{order?}', 'CategoryController@setArticlesOrder')->name('setArticlesOrder');
Route::post('/каталог/setParameters', 'CategoryController@setParameters');
Route::post('/каталог/eraseParameters', 'CategoryController@eraseParameters');

Route::get('/показать-заказ/', 'OrderController@show')->name('showOrder');
Route::post('/показать-заказ/create', 'OrderController@store');
Route::get('/успешный-заказ/{id}', 'OrderController@showSuccess')->name('showSuccessOrder');

Route::get('/статьи-категории/{category}', 'PaperController@indexPaperCategory')->name('showPaperCategory');
Route::get('/статья/{paper}', 'PaperController@showPaper')->name('showPaper');

Route::get('/акция/{id}', 'PromotionController@show')->name('showPromotion');