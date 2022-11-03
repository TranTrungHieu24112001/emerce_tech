@extends('backend.layout')
@section('do-du-lieu')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm banner
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
                        <form role="form" method="post"action="{{url('/save-banner')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên banner</label>
                            <input type="text" class="form-control" name="banner_name" id="exampleInputEmail1" placeholder="Nhập tên banner">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ảnh banner</label>
                            <input type="file" class="form-control" name="banner_image" id="exampleInputEmail1" placeholder="Thêm ảnh">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả banner</label>
                            <textarea style="resize:none; " rows ="8" class="form-control" id="exampleInputPassword1" placeholder="Nhập mô tả banner" name="banner_desc"></textarea>
                            <script type="text/javascript">CKEDITOR.replace('banner_desc');</script>
                        </div>
                        <div class="form-group">
                            <lable>Hiển thị</lable>
                            <select name="banner_status" class="form-control m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                                
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-info" name="add_banner">Nhập</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection