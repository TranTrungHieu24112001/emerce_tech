<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Banner;
use Mail;
session_start();

class HomeController extends Controller
{
   public function index(){
    $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();

        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id', "desc")->get() ;
        $product = DB::table('product')->where('product_status','1')->orderby('product_id', "desc")->limit(6)->get() ;
        return view('frontend.home')->with('cate_product',$cate_product)->with('banner',$banner)->with('brand_product',$brand_product)->with('product',$product);
    }
    public function search(Request $query){
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $keyword = $query->keyword_submit;
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id', "desc")->get() ;
        $search_product = DB::table('product')->where('product_name','like','%'.$keyword.'%')->get() ;
        return view('frontend.search')->with('banner',$banner)->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('search_product',$search_product);
    }
    public function searchPrice(Request $query){
        $keywordFrom = $query->up;
        $keywordTo = $query->down;
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', "desc")->get() ;
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id', "desc")->get() ;
        $search_product_price = DB::table('product')->whereBetween('product_price',[$keywordFrom,$keywordTo])->get() ;
        return view('frontend.search_price')->with('banner',$banner)->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('search_product_price',$search_product_price);
    }
    public function contact(){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', "desc")->get() ;
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id', "desc")->get() ;
        return view('frontend.contact')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('banner',$banner);
    }

    public function add_contact(Request $query){
        $data = array();
        $data['contact_name'] = $query->contact_name;
        $data['contact_email'] = $query->contact_email;
        $data['contact_phone'] = $query->contact_phone;
        $data['contact_message'] = $query->contact_message;
        DB::table('contact')->insert($data); 
        Session::put('message','Liên hệ thành công');
        return Redirect::to('/contact');
    }
    public function send_mail(){
        
        $name = "Trần Trung Hiếu";

        

        Mail::send('frontend.send_mail',compact('name'),function($email) use ($name){
        $email->subject('test mail');
            $email->to('hieunadal2411@gmail.com',$name);
});


    }
    public function infor_account(){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', "desc")->get() ;
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id', "desc")->get() ;
        $infor_account = DB::table('customer')->where('customer_email', Session::get('customer_email'))->get();
        return view('frontend.fix_information')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('banner',$banner)->with('infor_account',$infor_account);
    }
    public function update_customer(Request $query,$customer_id){
        $data = array();
        $data['customer_email'] = $query->email_account;
        
        $data['customer_name'] = $query->name_account;
        $data['customer_phone'] = $query->phone_account;
  
        DB::table('customer')->where("customer_id","=",$customer_id)->update($data);
        Session::put('message','Cập nhật customer thành công');
        return Redirect::to('/infor-account');
    }
    public function miss_account(){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', "desc")->get() ;
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id', "desc")->get() ;
        return view('frontend.miss_account')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('banner',$banner);
    }
    public function send_pass(Request $query){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', "desc")->get() ;
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id', "desc")->get() ;
        $user = DB::table('customer')->where('customer_email',$query->email_account)->count();
        $users = DB::table('customer')->where('customer_email',$query->email_account)->get();
        if($user == 0){
            Session::put('message','Tài khoản chưa tồn tại, mời tạo tài khoản');
            return Redirect::to('/miss-account');
        }
        else{
            $name = rand(000000,999999);
            Mail::send('frontend.send_mail',compact('name'),function($email) use ($name){
            $email->subject('Mã lấy lại mật khẩu');
            $email->to('hieunadal2411@gmail.com',$name);
            });
            $data = array();
            $data['customer_email'] = $query->email_account;
            $data['code_number'] = $name;
  
            $code_id = DB::table('code')->insertGetId($data);
            $code_infor = DB::table('code')->where('code_id',$code_id)->get();
            return view('frontend.send_pass')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('banner',$banner)->with('code_infor',$code_infor);
        }
    }
    public function reset_pass(Request $query, $code_number){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', "desc")->get() ;
        $banner = Banner::orderBy('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id', "desc")->get() ;
        $number = $query->code_number;
        $code_infor = DB::table('code')->where('code_number',$code_number)->get();
       
        if($number == $code_number){
            return view('frontend.reset_pass')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('banner',$banner)->with('code_infor',$code_infor);
        }
        else{
            Session::put('message','Mã không đúng, mời nhận và nhập lại mã');
            return Redirect::to('/send-pass');
        }
    }
    public function update_pass(Request $query, $customer_email){
        $data = array();
    
        $data['customer_password']=md5($query->re_pass_account);
        
        $user = DB::table('customer')->where('customer_email',$customer_email)->update($data);
        
        Session::put('message','Sửa mật khẩu thành công');
        return Redirect::to('/login-checkout');
        
        
       
       
    
        
    }
}
