<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Models\Banner;
session_start();
class CheckoutController extends Controller{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout(){
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $cate_product = DB::table('category_product')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->orderby('brand_id', "desc")->get() ;
       
        return view('frontend.logincheckout')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('banner',$banner);
    }
    public function add_customer(Request $query){
        $data = array();
        $data['customer_name']=$query->customer_name;
        $data['customer_email']=$query->customer_email;
        $data['customer_password']=md5($query->customer_password);
        $data['customer_phone']=$query->customer_phone;
        $user = DB::table('customer')->where('customer_email',$query->customer_email)->count();
        if($user>0){
            Session::put('message','Email đã tồn tại mời nhập email khác!');
            return Redirect::to('/login-checkout');
        }
        else{
        $customer_id = DB::table('customer')->insertGetId($data);
       
        return Redirect::to('/login-checkout');
        }
    }
    public function login_customer(Request $request){
        $customer_email = $request->email_account;
        $customer_password = md5($request->password_account);
        $result = DB::table('customer')->where("customer_email","=",$customer_email)->where("customer_password","=",$customer_password)->first();
        
        if($result){
            Session::put('customer_email', $result->customer_email);
            Session::put('customer_name', $result->customer_name);
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        }
        else{
            Session::put('message','Nhập sai thông tin, mời nhập lại');
            return Redirect::to('/login-checkout');
        }
    }
    public function checkout(){
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $cate_product = DB::table('category_product')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->orderby('brand_id', "desc")->get() ;
       
        return view('frontend.checkout')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('banner',$banner);
    }
    public function save_checkout_customer(Request $query){
        $data = array();
        $data['shipping_name']=$query->shipping_name;
        $data['shipping_email']=$query->shipping_email;
        $data['shipping_note']=$query->shipping_note;
        $data['shipping_address']=$query->shipping_address;
        $data['shipping_phone']=$query->shipping_phone;
        $shipping_id = DB::table('shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        return Redirect::to('/payment');
    }
    public function payment(){
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $cate_product = DB::table('category_product')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->orderby('brand_id', "desc")->get() ;
       
        return view('frontend.payment')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('banner', $banner);
    }
    public function order_place(Request $query){
        $data = array();
        $data['payment_method']=$query->payment_option;
        $data['payment_status']='Đang chờ xử lý';
        $payment_id = DB::table('payment')->insertGetId($data);

        //insert order

        $order_data = array();
        $order_data['customer_id']=Session::get('customer_id');
        $order_data['shipping_id']=Session::get('shipping_id');
        $order_data['payment_id']=$payment_id;
        $order_data['order_total']=Cart::total();
        $order_data['order_status']='Đang chờ xử lý';
        $order_id = DB::table('order')->insertGetId($order_data);

        //insert order details
        $content = Cart::content();
        foreach($content as $v_content){
        $order_d_data = array();
        $order_d_data['order_id']=$order_id;
        $order_d_data['product_id']=$v_content->id;
        $order_d_data['product_name']=$v_content->name;
        $order_d_data['product_price']=$v_content->price;
        $order_d_data['product_sale_quantity']=$v_content->qty;
        DB::table('order_details')->insert($order_d_data);
        }
        if($data['payment_method']==1){
            Cart::destroy();
            $cate_product = DB::table('category_product')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->orderby('brand_id', "desc")->get() ;
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        return view('frontend.thankyou')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('banner',$banner);
        }
        elseif($data['payment_method']==2){
            Cart::destroy();
            $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
            $cate_product = DB::table('category_product')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->orderby('brand_id', "desc")->get() ;
       
        return view('frontend.thankyou')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('banner',$banner);
        }
        //return Redirect::to('/payment');
    }
    public function manage_order(){
        $this->AuthLogin();
        $all_order = DB::table('order')->join('customer','customer.customer_id','=','order.customer_id')->select('order.*','customer.customer_name')->orderby('order.order_id','desc')->get();
        $manager_order = view('backend.manage_order')->with('all_order',$all_order);
        return view('backend.layout')->with('backend.manage_order',$manager_order);
    }
    public function logout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function view_order($orderid){
        $this->AuthLogin();
        $order_by_id = DB::table('order')->join('customer','customer.customer_id','=','order.customer_id')
        ->join('shipping','shipping.shipping_id','=','order.shipping_id')
        ->join('order_details','order_details.order_id','=','order.order_id')
        ->select('order.*','customer.*','order_details.*','shipping.*')->first();
        $manager_order = view('backend.view_order')->with('order_by_id',$order_by_id);
        return view('backend.layout')->with('backend.view_order',$manager_order);
        
    }
}