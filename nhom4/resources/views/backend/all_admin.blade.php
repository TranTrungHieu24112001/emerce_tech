@extends('backend.layout')
@section('do-du-lieu')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê Admin
    </div>

    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <?php
        $message = Session::get('message');
        if($message){
            echo '<h5  style="color:red;width:100%;align-item:center ;text-align:center;">'.$message.'</h5>';
            Session::put('message', null);
        }
    ?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Email admin</th>
            <th>Admin name</th>
            <th>Số điện thoại</th>
            <th>Role</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_admin as $adminkey => $admin)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $admin->admin_email}}</td>
            <td>{{ $admin->admin_name}}</td>
            <td>{{ $admin->admin_phone}}</td>
            <td><span class="text-ellipsis">
              <?php
                if($admin->admin_role == 0){
              ?>
                   admin
              <?php
                }
                else if($admin->admin_role == 1){
              ?>
                  Manager
              <?php
                }
                else {
              ?>
                  Non product
              <?php
                }
              ?>
            </span></td>
            <?php
                if(Session::get('admin_role') == 0){
              ?>
            <td>
              <a href="{{url('/edit-admin/'.$admin->admin_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a href="{{url('/delete-admin/'.$admin->admin_id)}}" onclick="return window.confirm('Bạn có muốn xóa admin '{{$admin->admin_name }}'');" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
            <?php
                }
                else {
              ?>
              <td></td>
              <?php
                }
              ?>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">

        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection
