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
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Kết quả tìm kiếm</h2>
        @foreach($search_product_price as $key => $pro)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="{{url('/chi-tiet-san-pham/'.$pro->product_id)}}" ><img src="{{url('../public/upload/product/'.$pro->product_image)}}" alt="" />
                            <h2>{{number_format($pro->product_price)}} VND</h2>
                            <p>{{$pro->product_name}}</p>
                            </a>
                            <a href="{{url('/chi-tiet-san-pham/'.$pro->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                        </div>
                        
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                    </ul>
                </div>
            </div>
        </div> 
        @endforeach
    </div><!--features_items-->
@endsection