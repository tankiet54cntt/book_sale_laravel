@extends('admin.layout.master')
@section('title')
( Trang cập nhật Groups )
@endsection
@section('name_table')
Nhóm Người Dùng
@endsection
@section('method')
Update
@endsection
@section('content')
<!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
@include('error')
<button type="reset" class="btn btn-default"><a href="{!! route('users.index') !!}"><i class="fa fa-undo" aria-hidden="true"></i> Back</a></button><br><br>
   <form action="{!! route('users.update',$user_edit->id)!!}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    {{ method_field('PUT') }} <!-- như trong html là : <input type="hidden" name="_method" value="PUT"> -->
       <div class="form-group">
            <label>Tên Nhóm</label>
            <select class="form-control" name="sltParent">
                @foreach($group as $gr)
                    <option value="{{ $gr->id }}" @if($gr->id==$user_edit->group->id) selected="" @endif>
                            {{ $gr->name }} -- 
                                @if($gr->level==1) 
                                     Quản trị 
                                @elseif($gr->level==0) 
                                    Nhân Viên
                                @else
                                    Khách Hàng
                                @endif 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>User Name</label>
            <input class="form-control" name="txt_username" placeholder="Please Enter User Name" value="{!! $user_edit->username !!}"  />
            
        </div>
        <div class="form-group">
            <label><input type="checkbox" id="checkpassword" name="checkpassword"> Password Mới</label>
            <input type="password" class="form-control" name="txt_password" placeholder="Mật Khẩu Mới" value=""  />
            
        </div>
        <div class="form-group">
            <label>Mật Khẩu Xác nhận</label>
            <input type="password" class="form-control" name="txtRePass" placeholder="Please Enter RePassword" />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="txt_email" placeholder="Please Enter Email" value="{!! $user_edit->email !!}"  />          
        </div>
         <div class="form-group">
            <label>firstname</label>
            <input class="form-control" name="txt_firstname" placeholder="Please Enter firstname" value="{!! $user_edit->firstname !!}"  />          
        </div>
         <div class="form-group">
            <label>lastname</label>
            <input class="form-control" name="txt_lastname" placeholder="Please Enter lastname" value="{!! $user_edit->lastname !!}"  />          
        </div>
        <div class="form-group">
            <label>address</label>
            <input class="form-control" name="txt_address" placeholder="Please Enter Address" value="{!! $user_edit->address !!}"  />          
        </div>
        <div class="form-group">
            <label>Số Phone</label>
            <input type="tel" class="form-control" name="txt_phone" placeholder="Please Enter Phone" value="{!! $user_edit->phone_number !!}"  />          
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Category Edit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    </form> 
</div>
@endsection