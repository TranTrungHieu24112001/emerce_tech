<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller{
    public function add_brand_product(){
        return view('backend.add_brand_product');
    }
    public function all_brand_product(){
        $all_brand_product = DB::table('brand_product')->get();
        $manager_brand_product = view('backend.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('backend.layout')->with('backend.all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(Request $query){
        $data = array();
        $data['brand_name'] = $query->brand_product_name;
        $data['brand_desc'] = $query->brand_product_desc;
        $data['brand_status'] = $query->brand_product_status;
        DB::table('brand_product')->insert($data); 
        Session::put('message','Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('/add-brand_product');
    }
    
    public function active_brand_product( $brand_product_id){
        DB::table('brand_product')->where("brand_id","=",$brand_product_id)->update(["brand_status"=>0]);
        Session::put('message','Ẩn trạng thái thành công');
        return Redirect::to('/all-brand_product');
    }
    public function unactive_brand_product($brand_product_id){
        DB::table('brand_product')->where("brand_id","=",$brand_product_id)->update(["brand_status"=>1]);
        Session::put('message','Hiện trạng thái thành công');
        return Redirect::to('/all-brand_product');
    }
    public function edit_brand_product($brand_product_id){
        $edit_brand_product = DB::table('brand_product')->where("brand_id","=",$brand_product_id)->get();
        $manager_brand_product = view('backend.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('backend.layout')->with('backend.edit_brand_product',$manager_brand_product);
    }
    public function update_brand_product(Request $query, $brand_product_id){
        $data = array();
        $data['brand_name'] = $query->brand_product_name;
        $data['brand_desc'] = $query->brand_product_desc;
        DB::table('brand_product')->where("brand_id","=",$brand_product_id)->update($data);
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand_product');
    }
    public function delete_brand_product($brand_product_id){
        DB::table('brand_product')->where("brand_id","=", $brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand_product');
    }
}