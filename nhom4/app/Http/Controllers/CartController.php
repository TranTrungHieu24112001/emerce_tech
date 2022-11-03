<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Banner;
use Cart;
session_start();
class CartController extends Controller{
    public function save_cart(Request $query){
        $product_id = $query->product_id_hidden;
        $quantity = $query->qty;
        $product_info =  DB::table('product')->where('product_id', $product_id)->first();
        $data['id'] = $product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '123';
        $data['options']['image'] = $product_info->product_image;
        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        Cart::add($data);
        Cart::setGlobalTax(2);
        return Redirect::to('/show-cart');
       
    }
    public function show_cart(){
        $cate_product = DB::table('category_product')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->orderby('brand_id', "desc")->get() ;
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        return view('frontend.cart')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('banner',$banner);
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $query){
        $rowId = $query->rowId_cart;
        $qty = $query->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
}