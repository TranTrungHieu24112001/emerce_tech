@extends('backend.layout')
@section('do-du-lieu')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa mục sản phẩm
                </header>
                @foreach($edit_category_product as $key => $edit_value)
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="post"action="{{url('/update-category-product/'.$edit_value->category_id)}}">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control" value="{{$edit_value->category_name}}" name="category_product_name" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize:none; " rows ="8"  class="form-control" id="exampleInputPassword1" placeholder="Nhập mô tả sản phẩm" name="category_product_desc">{{$edit_value->category_desc}}</textarea>
                            <script type="text/javascript">CKEDITOR.replace('category_product_desc');</script>
                        </div>
                        
                        <button type="submit" class="btn btn-info" name="add_category_product">Cập nhật</button>
                    </form>
                    </div>

                </div>
                @endforeach
            </section>

    </div>
</div>
@endsection