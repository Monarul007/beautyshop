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

Route::get('/', 'IndexController@index')->name('home');
Route::get('/loadmore', 'IndexController@products_loadmore')->name('loadmore');

Route::get('/products/{id}', 'ProductsController@singleProduct')->name('singleProduct');
Route::get('/shop', 'PagesController@index')->name('shop');
Route::get('/category/{url}', 'PagesController@products')->name('category');
Route::get('/brands/{url}', 'PagesController@brands')->name('brands');
Route::get('/get-product-price', 'ProductsController@productPrice')->name('get-product-price');
Route::match(['get','post'],'/add-cart','ProductsController@addtoCart')->name('add-cart');
Route::match(['get','post'],'/cart','ProductsController@cart')->name('cart');
Route::get('/cart/delete-product/{id}','ProductsController@deleteCartProduct')->name('deleteCartProduct');
Route::get('/cart/update-cart','ProductsController@updateCartProduct')->name('updateCartProduct');
Route::post('/cart/apply-coupon', 'ProductsController@applyCoupon')->name('applyCoupon');

//User Login and Register
Route::get('/login_register','UsersController@LoginRegister')->name('LoginRegister');
Route::post('/user_register','UsersController@register')->name('user_register');
Route::post('/user_logoin','UsersController@logoin')->name('user_logoin');
Route::get('/user_logout','UsersController@logout')->name('user_logout');

Route::group(['middleware' => ['userlogin']], function(){
    //User Account Page
    Route::get('/myaccount','UsersController@myaccount')->name('useraccount');
    Route::get('/invoice/{id}', 'UsersController@invoice')->name('Uinvoice');
    Route::match(['get','post'],'/users/cancel_order/{id}','UsersController@updateOrder');
    Route::post('/users/myaccount','UsersController@updateBilling')->name('updateBill');
    Route::post('/myaccount','UsersController@updateShipping')->name('updateShipp');
});

Auth::routes();

// Checkout Page Routes
Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::match(['get','post'],'/placeorder', 'CheckoutController@create')->name('checkout.create');
Route::post('/get_details', 'CheckoutController@get_details')->name('get_details');
Route::get('/invoice', 'CheckoutController@invoice')->name('invoice');

//Paypal Integrations
Route::get('/test', 'CheckoutController@paypal')->name('paypal');
Route::get('/execute-payment', 'PaymentController@execute')->name('execute');
Route::post('/create-payment', 'PaymentController@create')->name('create-payment');

Route::post('/search-products', 'PagesController@search')->name('search');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/admin/settings', 'PagesController@general_settings');
    Route::post('/dashboard/general_settings/', 'PagesController@general_settings_save')->name('general_settings_save');

    //Categories Routes (Admin Panel)
    Route::match(['get','post'],'/admin/create_category','CategoryController@CreateCategory');
    Route::match(['get','post'],'/admin/edit_category/{id}','CategoryController@editCategory');
    Route::match(['get','post'],'/admin/delete_category/{id}','CategoryController@deleteCategory');
    Route::get('/admin/view_categories', 'CategoryController@viewCategories');
    Route::get('/dashboard', 'HomeController@index')->name('Dashboard');

    //Brands Routes (Admin Panel)
    Route::match(['get','post'],'/admin/create_brand','BrandsController@CreateBrand');
    Route::match(['get','post'],'/admin/edit_brand/{id}','BrandsController@editBrand');
    Route::match(['get','post'],'/admin/delete_brand/{id}','BrandsController@deleteBrand');
    Route::get('/admin/view_brands', 'BrandsController@viewBrands');

    //Products Routes (Admin Panel)
    Route::match(['get','post'],'/admin/add_product','ProductsController@addProduct');
    Route::match(['get','post'],'/admin/edit_product/{id}','ProductsController@editProduct');
    Route::match(['get','post'],'/admin/delete_product/{id}','ProductsController@deleteProduct');
    Route::get('/admin/view_products', 'ProductsController@ViewProducts');

    //Product Arribute (Admin Panel)
    Route::match(['get','post'],'/admin/create_attribute/{id}','ProductsController@createAttribute');
    Route::match(['get','post'],'/admin/delete_attribute/{id}','ProductsController@deleteAttribute');

    //Coupons Routes (Admin Panel)
    Route::match(['get','post'],'/admin/create_coupon','CouponsController@createCoupon');
    Route::match(['get','post'],'/admin/edit_coupon/{id}','CouponsController@editCoupon');
    Route::get('/admin/view_coupons','CouponsController@ViewCoupons');
    Route::match(['get','post'],'/admin/delete_coupon/{id}','CouponsController@deleteCoupon');

    //Order Management
    Route::match(['get','post'],'orders/get_pending', 'OrderController@pendings')->name('orders.pending');
    Route::match(['get','post'],'orders/get_confirmed', 'OrderController@getConfirmed')->name('orders.confirmed');
    Route::match(['get','post'],'/admin/get_canceled', 'OrderController@getCanceled')->name('orders.canceled');
    Route::resource('orders', 'OrderController');
    // Route::get('/admin/get_confirmed', 'OrderController@getConfirmed')->name('admin.orders.confirmed');
    Route::get('/admin/get_shipped', 'OrderController@getShipped')->name('orders.shipped');
    Route::get('/admin/get_delivered', 'OrderController@getDelivered')->name('orders.delivered');
    Route::get('/admin/get_canceled', 'OrderController@getCanceled')->name('orders.canceled');
    Route::get('/admin/get_invoice/{id}', 'OrderController@getInvoice')->name('admin.orders.invoice');
    //Pending
    Route::post('/admin/save_pending', 'OrderController@save_pending')->name('admin.orders.save_pending');
    Route::post('/admin/cancel_pending', 'OrderController@cancel_pending')->name('admin.orders.cancel_pending');
    Route::post('/admin/saveas_paid', 'OrderController@saveas_paid')->name('admin.orders.saveas_paid');
    //Confirmed
    Route::post('/admin/save_confirmed', 'OrderController@save_confirmed')->name('admin.orders.save_confirmed');
    Route::post('/admin/cancel_confirmed', 'OrderController@cancel_confirmed')->name('admin.orders.cancel_confirmed');
    Route::post('/admin/confirm_paid', 'OrderController@confirm_paid')->name('admin.orders.confirm_paid');
    //Canceled
    Route::post('/admin/confirm_canceled', 'OrderController@confirm_canceled')->name('admin.orders.confirm_canceled');

    //Admin Banners
    Route::match(['get','post'],'/admin/add_banner','BannersController@addBanner')->name('admin.add_banner');
    Route::match(['get','post'],'/admin/view_banners','BannersController@viewBanners')->name('admin.view_banners');
    Route::match(['get','post'],'/admin/edit_banner/{id}','BannersController@editBanner');
    Route::match(['get','post'],'/admin/delete_banner/{id}','BannersController@deleteBanner');

});


