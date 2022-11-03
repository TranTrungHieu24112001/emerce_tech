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
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{url('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
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
									<form action="{{url('/update-cart-quantity')}}" method="post">
									{{csrf_field()}}
										<input class ="cart_quantity_input" type = "text" name="cart_quantity" value="{{$v_content->qty}}" autocomplete = "off" size = "2"/>
										<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control"/>
										<button type="submit" name="update_qty" class="btn btn-defauld btn-sm">Cập nhật</button>
									</from>
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
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền <span>{{Cart::subtotal(0).' '.'vnd'}}</span></li>
							<!-- <li>Eco Tax <span>$2</span></li> -->
							<li>Thuế <span>{{Cart::tax(0).' '.'vnd'}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Tổng cộng <span>{{Cart::total(0).' '.'vnd'}}</span></li>
						</ul>
						<?php
								if(Session::get('customer_id')!=Null){ ?>
								<a class="btn btn-default check_out" href="{{url('checkout')}}">Thanh toán</a>
								<?php }else{ ?>
								<li><a href="{{url('/login-checkout')}}"><i class="btn btn-default check_out"></i>Thanh toán</a></li>
								<?php } ?>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection