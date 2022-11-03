@extends('backend.layout')
@section('do-du-lieu')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thương hiệu sản phẩm
                </header>
                <?php
        $message = Session::get('message');
        if($message){
            echo '<h5  style="color:red;width:100%;align-item:center ;text-align:center;">'.$message.'</h5>';
            Session::put('message', null);
        }
    ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="post"action="{{url('/add-brand-product')}}">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" class="form-control" name="brand_product_name" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea style="resize:none; " rows ="8" class="form-control" id="exampleInputPassword1" placeholder="Nhập mô tả sản phẩm" name="brand_product_desc"></textarea>
                            <script type="text/javascript">CKEDITOR.replace('brand_product_desc');</script>
                        </div>
                        <div class="form-group">
                            <lable>Hiển thị</lable>
                            <select name="brand_product_status" class="form-control m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                                
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-info" name="add_brand_product">Nhập</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection