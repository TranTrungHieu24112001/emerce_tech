<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Banner;
use Illuminate\Support\Facades\Redirect;
class CategoryController extends Controller
{
    public function add_category_product(){
        return view('backend.add_category_product');
    }
    public function all_category_product(){
        $all_category_product = DB::table('category_product')->get();
        $manager_category_product = view('backend.all_category_product')->with('all_category_product',$all_category_product);
        return view('backend.layout')->with('backend.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $query){
        $data = array();
        $data['category_name'] = $query->category_product_name;
        $data['category_desc'] = $query->category_product_desc;
        $data['category_status'] = $query->category_product_status;
        DB::table('category_product')->insert($data); 
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('/add-category_product');
    }
    
    public function active_category_product( $category_product_id){
        DB::table('category_product')->where("category_id","=",$category_product_id)->update(["category_status"=>0]);
        Session::put('message','Ẩn trạng thái thành công');
        return Redirect::to('/all-category_product');
    }
    public function unactive_category_product($category_product_id){
        DB::table('category_product')->where("category_id","=",$category_product_id)->update(["category_status"=>1]);
        Session::put('message','Hiện trạng thái thành công');
        return Redirect::to('/all-category_product');
    }
    public function edit_category_product($category_product_id){
        $edit_category_product = DB::table('category_product')->where("category_id","=",$category_product_id)->get();
        $manager_category_product = view('backend.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('backend.layout')->with('backend.edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $query, $category_product_id){
        $data = array();
        $data['category_name'] = $query->category_product_name;
        $data['category_desc'] = $query->category_product_desc;
        DB::table('category_product')->where("category_id","=",$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('/all-category_product');
    }
    public function delete_category_product($category_product_id){
        DB::table('category_product')->where("category_id","=", $category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('/all-category_product');
    }

    public function show_product_cate($category_id){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id', "desc")->get() ;
        $category_by_id = DB::table('product')->join('category_product','product.category_id','=','category_product.category_id')->where('product.category_id','=',$category_id)->get();
        $cate_name = DB::table('category_product')->where('category_id',$category_id)->get();
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        return view('frontend.show_category')->with('banner',$banner)->with('cate_product',$cate_product)->with('cate_name',$cate_name)->with('brand_product',$brand_product)->with('product',$category_by_id);
    }
    public function show_product_brand($brand_id){
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id', "desc")->get() ;
        $brand_by_id = DB::table('product')->join('brand_product','product.brand_id','=','brand_product.brand_id')->where('product.brand_id','=',$brand_id)->get();
        $brand_name = DB::table('brand_product')->where('brand_id',$brand_id)->get();
        return view('frontend.show_brand')->with('banner',$banner)->with('cate_product',$cate_product)->with('brand_name',$brand_name)->with('brand_product',$brand_product)->with('product',$brand_by_id);
    }
}
