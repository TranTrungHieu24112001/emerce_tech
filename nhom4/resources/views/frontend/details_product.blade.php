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
@foreach($product as $key => $pro)
    <div class="product-details"><!--product-details-->
    
        <div class="col-sm-5">
            <div class="view-product">
                <img src="{{url('../public/upload/product/'.$pro->product_image)}}" />
                <h3>ZOOM</h3>
            </div>
            

        </div>
        
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                <h2>{{$pro->product_name}}</h2>
                <img src="images/product-details/rating.png" alt="" />
                <form method ="POST" action="{{url('/save-cart')}}">
                    {{csrf_field()}}
                <span>
                    <span>{{$pro->product_price}} VND</span>
                    <label>Số lượng:</label>
                    <input type="number" value="3" name = "qty" />
                    <input type="hidden" value="{{$pro->product_id}}" name = "product_id_hidden" />
                    <button type="submit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm vào giỏ hàng
                    </button>
                </span>
                </form>
                <p><b>Khả dụng:</b> Trong kho</p>
                <p><b>Tình trạng:</b> Mới</p>
                <p><b>Thương hiệu:</b> {{$pro->brand_name}}</p>
                <a href=""><img src="{{url('../public/frontend/images/share.png')}}" class="share img-responsive"  alt="" /></a>
            </div><!--/product-information-->
        </div>
    
    </div><!--/product-details-->
    
    <div class="category-tab shop-details-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
                <li><a href="#content" data-toggle="tab">Nội dung sản phẩm</a></li>
                <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade" id="details" >
                {{$pro->product_desc}}
            </div>
            <div class="tab-pane fade" id="details" >
                {{$pro->product_content}}
            </div>
            <div class="tab-pane fade active in" id="reviews" >
                
                <div class="col-sm-12">
                   
                    <ul>
                        <li><a href=""><i class="fa fa-user"></i></a></li>
                        <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                        <li><a href=""><i class="fa fa-calendar-o"></i>19 Tháng 7 2022</a></li>
                    </ul>
                    <p>Sản phẩm dùng tốt, dễ dàng lắp đặt và sử dụng, phù hợp với nhiều loại máy. Hiệu xuất cao và có khả năng thích ứng tốt với nhiều dòng máy. Giá cả phù hợp, được đóng gói cẩn thận. Giao hàng nhanh tiện lợi.</p>
                    <p><b>Viết đánh giá của bạn</b></p>
                   
                    <form action="{{url('/danh-gia-san-pham/'.$pro->product_id)}}" method="post">
                        <span>
                            <input type="text" placeholder="Họ Tên" name="reviewer_name"/>
                            <input type="email" placeholder="Email" name="reviewer_email"/>
                        </span>
                        <textarea name="review_content" ></textarea>
                        <b>Đánh giá: </b> <img src="{{url('../public/frontend/images/rating.png')}}" alt="" />
                        <button type="submit" class="btn btn-default pull-right">
                            Đăng bài
                        </button>
                    </form>
                </div>

            </div>
            
        </div>
    </div><!--/category-tab-->
    @endforeach
    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">Các sản phẩm lên quan</h2>
        
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @foreach($relate_product as $key => $re_pro)	
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{url('../public/upload/product/'.$re_pro->product_image)}}" alt="" />
                                    <h2>{{$re_pro->product_price}}</h2>
                                    <p>{{$re_pro->product_name}}</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
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