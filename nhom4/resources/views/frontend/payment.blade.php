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
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
        </div>
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
                <div class="table-responsive cart_info">
				<?php
					$content = Cart::content();
					
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<th class="image">Sản phẩm</th>
							<th class="description">Hình ảnh</th>
							<th class="price">Giá</th>
							<th class="quantity">Số lượng</th>
							<th class="total">Tổng tiền</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $v_content)
						<tr>
							<td class ="cart_product">
									<h4>{{$v_content->name}}</h4>
							</td>
							<td class ="cart_description">
								<img src="{{url('../public/upload/product/'.$v_content->options->image)}}" width="50" alt="" />
							</td>
							<td class ="cart_price">
								<p>{{number_format($v_content->price).' '.'VND'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									
									
										<input class ="cart_quantity_input" type = "text" name="cart_quantity" value="{{$v_content->qty}}" autocomplete = "off" size = "2"/>
										<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control"/>
										<input type="submit" name="update_qty" class="btn btn-defauld btn-sm" value="Cập nhật"/>
									
								</div>
							</td>
							<td class="cart_total">
								
								<?php
									$subtotal = $v_content->price * $v_content->qty;
									echo number_format($subtotal).' '.'vnd';
								?>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			</div>
            
			<div class="review-payment">
				<h2>Chọn hình thức thanh toán</h2>
			</div>
            <br>
            <br>
            <form action="{{url('/order-place')}}" method="post">
                {{csrf_field()}}
			<div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Chuyển khoản</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="checkbox"> Nhận tiền mặt</label>
					</span>
					<input class="btn btn-primary" type="submit" value="Đặt hàng"/>
				</div>
                
            </form>
		</div>
	</section>
@endsection