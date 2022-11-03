@extends('backend.layout')
@section('do-du-lieu')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa admin
                </header>
                @foreach($edit_admin as $key => $edit_value)
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="post"action="{{url('/update-admin/'.$edit_value->admin_id)}}">
                            {{ csrf_field() }}
                         <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" value="{{$edit_value->admin_email}}" name="admin_email" id="exampleInputEmail1" placeholder="Nhập email">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên admin</label>
                            <input type="text" class="form-control" value="{{$edit_value->admin_name}}" name="admin_name" id="exampleInputEmail1" placeholder="Nhập Tên admin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" class="form-control" value="{{$edit_value->admin_phone}}" name="admin_phone" id="exampleInputEmail1" placeholder="Nhập Số điện thoại">
                        </div>
                        <div class="form-group">
                            <lable>Role</lable>
                            <select name="admin_role" class="form-control m-bot15">
                                <option value="0">Admin</option>
                                <option value="1">Manager</option>
                                <option value="2">Non Product</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info" name="add_admin">Cập nhật</button>
                    </form>
                    </div>

                </div>
                @endforeach
            </section>
    </div>
</div>
@endsection
