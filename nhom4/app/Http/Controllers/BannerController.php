<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Banner;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
class BannerController extends Controller
{
    public function magane_banner(){
        $all_banner = Banner::orderBy('banner_id', 'DESC')->get();
        return view('backend.list_banner')->with(compact('all_banner'));
    }
    public function add_banner(){
        return view('backend.add_banner');
    }
    public function save_banner(Request $query){
        $data = array();
        $data['banner_name'] = $query->banner_name;
       
        $data['banner_desc'] = $query->banner_desc;
       
        
        $data['banner_status'] = $query->banner_status;
        $data['banner_image'] = $query->banner_image;
        $get_image = $query->file('banner_image');
        if($get_image){
            $new_image = rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('../public/upload/banner', $new_image);
            $data['banner_image'] = $new_image;
            DB::table('banner')->insert($data); 
            Session::put('message','Thêm banner thành công');
            return Redirect::to('/add-banner');
        }
        $data['banner_image'] = '';
        DB::table('banner')->insert($data); 
        Session::put('message','Thêm banner thành công');
        return Redirect::to('/add-banner');
    }
    public function active_banner( $banner_id){
        DB::table('banner')->where("banner_id","=",$banner_id)->update(["banner_status"=>0]);
        Session::put('message','Ẩn trạng thái thành công');
        return Redirect::to('/manage-banner');
    }
    public function unactive_banner($banner_id){
        DB::table('banner')->where("banner_id","=",$banner_id)->update(["banner_status"=>1]);
        Session::put('message','Hiện trạng thái thành công');
        return Redirect::to('/manage-banner');
    }
}