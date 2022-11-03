<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CustomerController extends Controller{
  public function all_customer(){
        $all_customer = DB::table('customer')->orderby('customer.customer_id','desc')->get();
        $manager_customer = view('backend.all_customer')->with('all_customer',$all_customer);
        return view('backend.layout')->with('backend.all_customer',$manager_customer);
  }
}
