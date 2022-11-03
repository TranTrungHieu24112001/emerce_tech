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

//frontend
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CateNewsController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('',[HomeController::class, 'index']);
Route::get('Trangchu',[HomeController::class, 'index']);
Route::post('/tim-kiem',[HomeController::class,'search']);
Route::post('/tim-kiem-gia',[HomeController::class,'searchPrice']);
Route::get('/contact',[HomeController::class, 'contact']);
Route::post('/add-contact',[HomeController::class,'add_contact']);
//danh muc san pham

Route::get('danh-muc-san-pham/{category_id}',[CategoryController::class, 'show_product_cate']);
Route::get('thuong-hieu-san-pham/{brand_id}',[CategoryController::class, 'show_product_brand']);

//chi tiet san pham
Route::get('chi-tiet-san-pham/{product_id}',[ProductController::class, 'show_details_product']);

//gio hang san pham
Route::post('/save-cart',[CartController::class,'save_cart']);
Route::post('/update-cart-quantity',[CartController::class,'update_cart_quantity']);
Route::get('/show-cart',[CartController::class, 'show_cart']);
Route::get('/delete-to-cart/{rowId}',[CartController::class,'delete_to_cart']);

//account
Route::get('/infor-account',[HomeController::class, 'infor_account']);
Route::post('/update-customer/{customer_id}',[HomeController::class, 'update_customer']);
Route::get('/miss-account',[HomeController::class, 'miss_account']);
Route::post('/send-pass',[HomeController::class, 'send_pass']);
Route::post('/reset-pass/{code_number}',[HomeController::class, 'reset_pass']);
Route::post('/update-pass/{customer_email}',[HomeController::class, 'update_pass']);

//checkout

Route::get('/login-checkout',[CheckoutController::class,'login_checkout']);
Route::post('/add-customer',[CheckoutController::class,'add_customer']);
Route::post('/login',[CheckoutController::class,'login_customer']);
Route::get('/checkout',[CheckoutController::class,'checkout']);
Route::post('/save-checkout-customer',[CheckoutController::class,'save_checkout_customer']);
Route::get('/payment',[CheckoutController::class,'payment']);
Route::get('/logout-checkout',[CheckoutController::class,'logout']);
Route::post('/order-place',[CheckoutController::class,'order_place']);


//backend

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'dashboard']);
Route::post('/admin-dashboard', [AdminController::class, 'login']);
Route::get('/logout',[AdminController::class,'logout']);

//Category product

Route::get('/all-category_product',[CategoryController::class, 'all_category_product']);
Route::get('/add-category_product',[CategoryController::class, 'add_category_product']);
Route::post('/add-category-product',[CategoryController::class,'save_category_product']);

Route::get('/active-category-product/{category_product_id}',[CategoryController::class, 'active_category_product']);
Route::get('/unactive-category-product/{category_product_id}',[CategoryController::class, 'unactive_category_product']);

Route::get('/edit-category-product/{category_product_id}',[CategoryController::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}',[CategoryController::class, 'delete_category_product']);
Route::post('/update-category-product/{category_product_id}',[CategoryController::class, 'update_category_product']);

//Brand product

Route::get('/all-brand_product',[BrandController::class, 'all_brand_product']);
Route::get('/add-brand_product',[BrandController::class, 'add_brand_product']);
Route::post('/add-brand-product',[BrandController::class,'save_brand_product']);

Route::get('/active-brand-product/{brand_product_id}',[BrandController::class, 'active_brand_product']);
Route::get('/unactive-brand-product/{brand_product_id}',[BrandController::class, 'unactive_brand_product']);

Route::get('/edit-brand-product/{brand_product_id}',[BrandController::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}',[BrandController::class, 'delete_brand_product']);
Route::post('/update-brand-product/{brand_product_id}',[BrandController::class, 'update_brand_product']);

//Product

Route::get('/all-product',[ProductController::class, 'all_product']);
Route::get('/add-product',[ProductController::class, 'add_product']);
Route::post('/save-product',[ProductController::class,'save_product']);

Route::get('/active-product/{product_id}',[ProductController::class, 'active_product']);
Route::get('/unactive-product/{product_id}',[ProductController::class, 'unactive_product']);

Route::get('/edit-product/{product_id}',[ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}',[ProductController::class, 'delete_product']);
Route::post('/update-product/{product_id}',[ProductController::class, 'update_product']);

//order

Route::get('/manage-order',[CheckoutController::class,'manage_order']);
Route::get('/view-order/{orderid}',[CheckoutController::class,'view_order']);
Route::get('/delete-order/{orderid}',[CheckoutController::class,'delete_order']);

//news

Route::get('/add-cate-news',[CateNewsController::class,'add_cate_news']);
Route::post('/save-cate-news',[CateNewsController::class, 'save_cate_news']);
Route::get('/all-cate-news',[CateNewsController::class,'all_cate_news']);

//banner
Route::get('/manage-banner',[BannerController::class,'magane_banner']);
Route::get('/add-banner',[BannerController::class,'add_banner']);
Route::post('/save-banner',[BannerController::class, 'save_banner']);
Route::get('/active-banner/{banner_id}',[BannerController::class, 'active_banner']);
Route::get('/unactive-banner/{banner_id}',[BannerController::class, 'unactive_banner']);

//contact

Route::get('/manage-contact',[ContactController::class,'manage_contact']);
Route::get('/view-contact/{contact_id}',[ContactController::class,'view_contact']);
Route::get('/delete-contact/{contact_id}',[ContactController::class,'delete_contact']);

//Customer

Route::get('/all-customer',[CustomerController::class,'all_customer']);

//admin

Route::get('/all-admin',[AdminController::class, 'all_admin']);
Route::get('/add-admin',[AdminController::class, 'add_admin']);
Route::post('/add-admin',[AdminController::class,'save_admin']);

Route::get('/edit-admin/{admin_id}',[AdminController::class, 'edit_admin']);
Route::get('/delete-admin/{admin_id}',[AdminController::class, 'delete_admin']);
Route::post('/update-admin/{admin_id}',[AdminController::class, 'update_admin']);


//send mail
Route::get('/send-mail',[HomeController::class,'send_mail']);