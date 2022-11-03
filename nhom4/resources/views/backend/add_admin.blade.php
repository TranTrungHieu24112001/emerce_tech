@extends('backend.layout')
@section('do-du-lieu')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm admin
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
                        <form role="form" method="post"action="{{url('/add-admin')}}">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" name="admin_email" id="exampleInputEmail1" placeholder="Nhập email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" name="admin_password" id="exampleInputEmail1" placeholder="Nhập password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên admin</label>
                            <input type="text" class="form-control" name="admin_name" id="exampleInputEmail1" placeholder="Nhập Tên admin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" class="form-control" name="admin_phone" id="exampleInputEmail1" placeholder="Nhập Số điện thoại">
                        </div>
                        <div class="form-group">
                            <lable>Role</lable>
                            <select name="admin_role" class="form-control m-bot15">
                                <option value="0">Admin</option>
                                <option value="1">Manager</option>
                                <option value="2">Add Product</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info" name="add_category_product">Nhập</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection
