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
<button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> <a href="{!! route('groups.index') !!}">Back</a></button><br><br>
    <form action="{!! route('groups.store')!!}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Tên Nhóm</label>
            <input class="form-control" name="txt_group" placeholder="Please Enter Group Name" value="{!! old('txt_group') !!}"  />
             <!--{!! $errors->first('txtCateName') !!}-->
        </div>
        <div class="form-group">
            <label>Mô Tả</label>
            <textarea class="form-control" rows="3" name="txt_description">{!! old('txt_description') !!}</textarea>
        </div>
        <div class="form-group">
            <label>Level</label><br>
            <label class="radio-inline">
                <input name="rdoLevel" value="1" checked="" type="radio">Quản Trị
            </label>
            <label class="radio-inline">
                <input name="rdoLevel" value="0" type="radio">Nhân Viên
            </label>
            <label class="radio-inline">
                <input name="rdoLevel" value="2" type="radio">Khách Hàng
            </label>
        </div><br>
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Group</button>
        <button type="reset" class="btn btn-default">Reset</button>
        <form>
        </div>
@endsection
