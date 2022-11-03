@extends('welcome')
<style>
    .bgimg1{
        display: none;
    
    }
    #slider{
        display:none;
    }
    .left, .right{
        display :none;
    }
</style>
@section('feature-items')
<div class="container" style="width:550px;">
        <div class="category-tab shop-details-tab"><!--category-tab-->
        <?php
        $message = Session::get('message');
        if($message){
            echo '<h5  style="color:red;width:100%;align-item:center ;text-align:center;">'.$message.'</h5>';
            Session::put('message', null);
        }
    ?>
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#login" data-toggle="tab">Thông tin tài khoản</a></li>
             
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="login" >
                    <div class="login-form"><!--login form-->
                        <h2>Sửa thông tin tài khoản</h2>
                        @foreach($infor_account as $key => $infor)
                        <form action="{{url('/update-customer/'.$infor->customer_id)}}" method="post">
                        {{csrf_field()}}
                        
                            <input type="text" value="{{$infor->customer_name}}" name="name_account"/>
                            <input type="text" value="{{$infor->customer_email}}" name="email_account"/>
                            <input type="text" value="{{$infor->customer_phone}}" name="phone_account" />
                        
                            <button type="submit" class="btn btn-default">Sửa</button>
                        </form>
                        @endforeach  
                    </div><!--/login form-->
                </div>
                

                
            </div>
        </div>
    </div>
@endsection