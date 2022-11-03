<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();
class ContactController extends Controller{
    public function manage_contact(){
        $all_contact = DB::table('contact')->get();
        $manager_contact = view('backend.manage_contact')->with('all_contact',$all_contact);
        return view('backend.layout')->with('backend.manage_contact',$manager_contact);
    }

    public function view_contact($contact_id){
        $contact_by_id = DB::table('contact')->where("contact_id","=",$contact_id)->get();
        $manager_contact = view('backend.view_contact')->with('contact_by_id',$contact_by_id);
        return view('backend.layout')->with('backend.view_contact',$manager_contact);
    }

    public function delete_contact($contact_id){
        DB::table('contact')->where("contact_id","=", $contact_id)->delete();
        Session::put('message','Xóa liên hệ thành công');
        return Redirect::to('/manage-contact');
    }
}