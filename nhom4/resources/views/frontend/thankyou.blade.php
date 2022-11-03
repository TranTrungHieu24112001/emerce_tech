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
        <div>
            <h2>Cảm ơn bạn đã mua hàng<h2>
        </div>
</div>
	</section>
@endsection