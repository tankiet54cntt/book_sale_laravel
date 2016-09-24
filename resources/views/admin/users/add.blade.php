@extends('admin.layout.master')
@section('title')
( Trang thêm Nhóm )
@endsection
@section('name_table')
Nhóm User
@endsection
@section('method')
Add
@endsection
@section('content')
<!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
<!-- THÔNG BÁO LỖI-->
@include('error')
<!-- THÔNG BÁO LỖI-->
<button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> <a href="{!! route('users.index') !!}">Back</a></button><br><br>
    <form action="{!! route('users.store')!!}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Tên Nhóm</label>
            <select class="form-control" name="sltParent">
                @foreach($group as $gr)
                    <option value="{{ $gr->id }}">
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
            <input class="form-control" name="txt_username" placeholder="Please Enter User Name" value="{!! old('txt_username') !!}"  />
            
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="txt_password" placeholder="Please Enter Password" value="{!! old('txt_password') !!}"  />
            
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="txt_email" placeholder="Please Enter Email" value="{!! old('txt_email') !!}"  />          
        </div>
         <div class="form-group">
            <label>firstname</label>
            <input class="form-control" name="txt_firstname" placeholder="Please Enter firstname" value="{!! old('txt_firstname') !!}"  />          
        </div>
         <div class="form-group">
            <label>lastname</label>
            <input class="form-control" name="txt_lastname" placeholder="Please Enter lastname" value="{!! old('txt_lastname') !!}"  />          
        </div>
        <div class="form-group">
            <label>address</label>
            <input class="form-control" name="txt_address" placeholder="Please Enter Address" value="{!! old('txt_address') !!}"  />          
        </div>
        <div class="form-group">
            <label>Số Phone</label>
            <input type="tel" class="form-control" name="txt_phone" placeholder="Please Enter Phone" value="{!! old('txt_phone') !!}"  />          
        </div>
        
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Thêm User</button>
        <button type="reset" class="btn btn-default">Reset</button>
        <form>
        </div>
@endsection
