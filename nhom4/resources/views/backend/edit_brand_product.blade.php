@extends('backend.layout')
@section('do-du-lieu')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa thương hiệu sản phẩm
                </header>
                @foreach($edit_brand_product as $key => $edit_value)
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="post"action="{{url('/update-brand-product/'.$edit_value->brand_id)}}">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" class="form-control" value="{{$edit_value->brand_name}}" name="brand_product_name" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea style="resize:none; " rows ="8"  class="form-control" id="exampleInputPassword1" placeholder="Nhập mô tả sản phẩm" name="brand_product_desc">{{$edit_value->brand_desc}}</textarea>
                            <script type="text/javascript">CKEDITOR.replace('brand_product_desc');</script>
                        </div>
                        
                        <button type="submit" class="btn btn-info" name="add_brand_product">Cập nhật</button>
                    </form>
                    </div>

                </div>
                @endforeach
            </section>

    </div>
</div>
@endsection