<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Banner;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $cate_product = DB::table('category_product')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->orderby('brand_id', "desc")->get() ;
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        return view('backend.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('banner',$banner);
    }
    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('product')->join('category_product','category_product.category_id','=','product.category_id')->join('brand_product','brand_product.brand_id','=','product.brand_id')->orderby('product.product_id','desc')->get();
        $manager_product = view('backend.all_product')->with('all_product',$all_product);
        return view('backend.layout')->with('backend.all_product',$manager_product);
    }
    public function save_product(Request $query){
        $data = array();
        $data['product_name'] = $query->product_name;
        $data['product_price'] = $query->product_price;
        $data['product_desc'] = $query->product_desc;
        $data['product_content'] = $query->product_content;
        $data['category_id'] = $query->product_cate;
        $data['brand_id'] = $query->product_brand;
        $data['product_status'] = $query->product_status;
        $data['product_image'] = $query->product_image;
        $get_image = $query->file('product_image');
        if($get_image){
            $new_image = rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('../public/upload/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('product')->insert($data); 
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('/add-product');
        }
        $data['product_image'] = '';
        DB::table('product')->insert($data); 
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('/add-product');
    }
    
    public function active_product( $product_id){
        DB::table('product')->where("product_id","=",$product_id)->update(["product_status"=>0]);
        Session::put('message','Ẩn trạng thái thành công');
        return Redirect::to('/all-product');
    }
    public function unactive_product($product_id){
        DB::table('product')->where("product_id","=",$product_id)->update(["product_status"=>1]);
        Session::put('message','Hiện trạng thái thành công');
        return Redirect::to('/all-product');
    }
    public function edit_product($product_id){
        $cate_product = DB::table('category_product')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->orderby('brand_id', "desc")->get() ;
        $edit_product = DB::table('product')->where("product_id","=",$product_id)->get();
        $manager_product = view('backend.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);
        return view('backend.layout')->with('backend.edit_product',$manager_product);
    }
    public function update_product(Request $query, $product_id){
        $data = array();
        $data['product_name'] = $query->product_name;
        $data['product_price'] = $query->product_price;
        $data['product_desc'] = $query->product_desc;
        $data['product_content'] = $query->product_content;
        $data['category_id'] = $query->product_cate;
        $data['brand_id'] = $query->product_brand;
        $data['product_status'] = $query->product_status;
        
        $get_image = $query->file('product_image');
        if($get_image){
            $new_image = rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('../public/upload/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('product')->where('product_id','=',$product_id)->update($data); 
            Session::put('message','Sửa sản phẩm thành công');
            return Redirect::to('/all-product');
        }
        DB::table('product')->where("product_id","=",$product_id)->update($data);
        Session::put('message','Sửa sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    public function delete_product($product_id){
        DB::table('product')->where("product_id","=", $product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    //frontend
    //Hàm lấy chi tiết sản phẩm
    public function show_details_product($product_id){
        //Lấy ra danh mục và thương hiệu sản phẩm bên side bar
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id', "desc")->get() ;
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        //lấy ra sản phẩm với id truyền vào
        $product = DB::table('product')->join('brand_product','product.brand_id','=','brand_product.brand_id')->join('category_product','category_product.category_id','=','product.category_id')->where('product_id',$product_id)->get() ;
        foreach($product as $key => $value){
            $brand_id = $value->brand_id;
        }
        $relate_product = DB::table('product')->join('brand_product','product.brand_id','=','brand_product.brand_id')->join('category_product','category_product.category_id','=','product.category_id')
        ->where('brand_product.brand_id',$brand_id)->whereNotIn('product.product_id',[$product_id])->get() ;
        
        return view('frontend.details_product')->with('banner',$banner)->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('product',$product)->with('relate_product',$relate_product);
    }
    // public function review_product(Request $request, $product_id){
    //     $data = array();
    //     $data['reviewer_email'] = $request->reviewer_email;
    //     $data['reviewer_name'] = $request->reviewer_name;
    //     $data['review_content'] = $request->review_content;
    //     $data['product_id'] = $product_id;
    //     DB::table('review_product')->insert($data); 
    //     return Redirect::to('/save-review-product')->with('product_id', $product_id);
    //     //Lấy ra danh mục và thương hiệu sản phẩm bên side bar
        
    //     }
    // public function save_review_product($product_id){
    //     $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', "desc")->get() ;
    //     $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id', "desc")->get() ;
    //     $review_product = DB::table('review_product')->where('review_product.product_id','=',$product_id)->orderby('review_id', "desc")->get() ;
    //     $product = DB::table('product')->join('brand_product','product.brand_id','=','brand_product.brand_id')->join('category_product','category_product.category_id','=','product.category_id')->where('product_id',$product_id)->get() ;
    //     if($review_product){
    //         return view('frontend.details_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('product',$product)->with('review_product',$review_product);
    //     }
    //     //lấy ra sản phẩm với id truyền vào
    //     else{
    //         $review_product = '';
    //         return view('frontend.details_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('product',$product)->with('review_product',$review_product);
    //     }
        
    // }
    }
    
