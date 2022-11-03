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
                    <li class="active"><a href="#login" data-toggle="tab">Lấy lại mật khẩu</a></li>
             
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="login" >
                    <div class="login-form"><!--login form-->
                        <h2>Nhập email của bạn để lấy mã</h2>
                        
                        <form action="{{url('/send-pass')}}" method="post">
                        {{csrf_field()}}
                        
                            
                            <input type="text" placeholder="Email" name="email_account"/>
                            
                        
                            <button type="submit" class="btn btn-default">Gửi mã</button>
                        </form>
                     
                    </div><!--/login form-->
                </div>
                

                
            </div>
        </div>
    </div>
@endsection