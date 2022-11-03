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
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#login" data-toggle="tab">Đăng Nhập</a></li>
                    <li><a href="#logout" data-toggle="tab">Đăng Ký</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="login" >
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <?php
        $message = Session::get('message');
        if($message){
            echo '<h5  style="color:red;width:100%;align-item:center ;text-align:center;">'.$message.'</h5>';
            Session::put('message', null);
        }
    ?>
                        <form action="{{url('/login')}}" method="post">
                        {{csrf_field()}}
                            <input type="text" placeholder="Email" name="email_account"/>
                            <input type="password" placeholder="Password" name="password_account" />
                            <a href="{{url('/miss-account')}}" style="cursor: pointer;">Quên mật khẩu</a>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                
                <div class="tab-pane fade" id="logout" >
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <?php
        $message = Session::get('message');
        if($message){
            echo '<h5  style="color:red;width:100%;align-item:center ;text-align:center;">'.$message.'</h5>';
            Session::put('message', null);
        }
    ?>
                        <form action="{{url('/add-customer')}}" method="post">
                            {{csrf_field()}}
                            <input type="text" placeholder="Name" name="customer_name"/>
                            <input type="email" placeholder="Email Address" name="customer_email"/>
                            <input type="password" placeholder="Password" name="customer_password"/>
                            <input type="text" placeholder="Phone" name="customer_phone"/>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
                
            </div>
        </div>
    </div>
@endsection