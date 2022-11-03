<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{
    public function index(){
        return view('admin_login');
    }
    public function dashboard(){
        return view ('backend.home');
    }
    public function login(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('admin')->where("admin_email","=",$admin_email)->where("admin_password","=",$admin_password)->first();
        
        if($result){
            Session::put('admin_email', $result->admin_email);
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            Session::put('admin_role', $result->admin_role);
            return Redirect::to('/dashboard');
        }
        else{
            Session::put('message','Nhập sai thông tin, mời nhập lại');
            return Redirect::to('/admin');
        }
    }
    public function logout(){
        Session::put('admin_name', null);
        Session::put('admin_email',null);
        Session::put('admin_id',null);
        Session::put('admin_role',null);
        return Redirect::to('/admin');
    }
    
    public function add_admin(){
        return view('backend.add_admin');
    }
    public function all_admin(){
        $all_admin = DB::table('admin')->get();
        $manager_admin = view('backend.all_admin')->with('all_admin',$all_admin);
        return view('backend.layout')->with('backend.all_admin',$manager_admin);
    }
    public function save_admin(Request $query){
        $data = array();
        $data['admin_email'] = $query->admin_email;
        $data['admin_password'] = md5($query->admin_password);
        $data['admin_name'] = $query->admin_name;
        $data['admin_phone'] = $query->admin_phone;
        $data['admin_role'] = $query->admin_role;
        DB::table('admin')->insert($data);
        Session::put('message','Thêm danh admin thành công');
        return Redirect::to('/add-admin');
    }
    public function edit_admin($admin_id){
        $edit_admin = DB::table('admin')->where("admin_id","=",$admin_id)->get();
        $manager_admin = view('backend.edit_admin')->with('edit_admin',$edit_admin);
        return view('backend.layout')->with('backend.edit_admin',$manager_admin);
    }
    public function update_admin(Request $query, $admin_id){
        $data = array();
        $data['admin_email'] = $query->admin_email;
        
        $data['admin_name'] = $query->admin_name;
        $data['admin_phone'] = $query->admin_phone;
        $data['admin_role'] = $query->admin_role;
        DB::table('admin')->where("admin_id","=",$admin_id)->update($data);
        Session::put('message','Cập nhật admin thành công');
        return Redirect::to('/all-admin');
    }
    public function delete_admin($admin_id){
        DB::table('admin')->where("admin_id","=", $admin_id)->delete();
        Session::put('message','Xóa admin thành công');
        return Redirect::to('/all-admin');
    }
}
