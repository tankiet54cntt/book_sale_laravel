@extends('admin.layout.master')
@section('title')
( Trang thêm Tác Giả )
@endsection
@section('name_table')
Tác giả
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
<button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> <a href="{!! route('writers.index') !!}">Back</a></button><br><br>
    <form action="{!! route('writers.store')!!}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Tên Tác giả</label>
            <input class="form-control" name="txt_writer" placeholder="Please Enter Writer Name" value="{!! old('txt_writer') !!}" id="txt_writer" />
             <!--{!! $errors->first('txtCateName') !!}-->
             <input type="hidden" name="txt_writer_slug" value="" id="slug_txt_writer">
        </div>
        <div class="form-group">
            <label>Tiểu Sử</label>
            <textarea class="form-control" rows="3" name="txt_story">{!! old('txt_story') !!}</textarea>
        </div>
       
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Tác Giả</button>
        <button type="reset" class="btn btn-default">Reset</button>
        <form>
        </div>
@endsection
@section('script')
      <script src="{{ url('public/admin/js/slug.js') }}"></script>
@endsection