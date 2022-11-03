@extends('welcome')
@section('feature-items')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Sản phẩm nổi bật</h2>
        @foreach($product as $key => $pro)
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
@section('do-du-lieu')
    <div class="category-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
            @php
							$i=0;
							@endphp
            @foreach($brand_product as $key => $brand_pro)
            @php
							$i++
							@endphp
            
                <li class="{{$i==1 ? 'active' : ''}}"><a href="#{{$brand_pro->brand_id}}" data-toggle="tab">{{$brand_pro->brand_name}}</a></li>
            
            @endforeach
            </ul>
        </div>
        <div class="tab-content">
        @foreach($brand_product as $key => $brand_pro)
            <div class="tab-pane fade active in" id="{{$brand_pro->brand_id}}" >
                <?php
                    $product = DB::table('product')->where('brand_id',$brand_pro->brand_id)->orderby('product_id', "desc")->limit(4)->get() ;
                ?>
                @foreach($product as $key => $pro)
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{url('../public/upload/product/'.$pro->product_image)}}" alt="" />
                                <h2>{{number_format($pro->product_price)}} VND</h2>
                                <p>{{$pro->product_name}}</p>
                                <a href="{{url('/chi-tiet-san-pham/'.$pro->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Mua hàng</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            @endforeach
        </div>
    </div><!--/category-tab-->

    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">recommended items</h2>
        
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">	
                <?php
                    $product = DB::table('product')->where('product_price','<','5000000')->where('category_id','4')->orderby('product_id', "desc")->limit(3   )->get() ;
                ?>
                @foreach($product as $key => $pro)
                    <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{url('../public/upload/product/'.$pro->product_image)}}" alt="" />
                                <h2>{{number_format($pro->product_price)}}</h2>
                                <p>{{$pro->product_name}}</p>
                                <a href="{{url('/chi-tiet-san-pham/'.$pro->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Mua hàng</a>
                            </div>
                            
                        </div>
                    </div>
                    </div>
                    @endforeach
                </div>
                <div class="item">
                <?php
                    $product1 = DB::table('product')->where('product_price','<','5000000')->where('category_id','8')->orderby('product_id', "desc")->limit(3   )->get() ;
                ?>	
                    @foreach($product1 as $key => $pro)
                    <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{url('../public/upload/product/'.$pro->product_image)}}" alt="" />
                                <h2>{{number_format($pro->product_price)}}</h2>
                                <p>{{$pro->product_name}}</p>
                                <a href="{{url('/chi-tiet-san-pham/'.$pro->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Mua hàng</a>
                            </div>
                            
                        </div>
                    </div>
                    </div>
                    @endforeach
                </div>
            </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>			
        </div>
    </div><!--/recommended_items-->
@endsection
