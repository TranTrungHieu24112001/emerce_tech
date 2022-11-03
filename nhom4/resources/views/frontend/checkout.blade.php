@extends('welcome')
<style>
    .bgimg1{
        display: none;
    
    }
    #slider{
        display:none;
    }
</style>
@section('feature-items')
<section id="cart_items">
		<div class="container">
        <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{url('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán</li>
				</ol>
        </div>

			<div class="register-req">
				<p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-9">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form action="{{url('/save-checkout-customer')}}" method="post">
                            {{csrf_field()}}
								<input type="text" placeholder="Email" name="shipping_email">
								<input type="text" placeholder="Họ tên"name="shipping_name">
								<input type="text" placeholder="Địa chỉ"name="shipping_address">
								<input type="text" placeholder="Số điện thoại"name="shipping_phone">
                                <textarea   placeholder="Ghi chú đơn hàng" rows="16" name="shipping_note"></textarea>
                                <button class="btn btn-primary" type="submit">Gửi</button>
                                
                            </form>
							
						</div>
					</div>
										
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section>
@endsection