@extends('admin.layout.master')
@section('title')
( Trang thêm category )
@endsection
@section('name_table')
Category
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
<button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> <a href="{!! route('categories.index') !!}">Back</a></button><br><br>
    <form action="{!! route('categories.store')!!}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Category Parent</label>
            <select class="form-control" name="sltParent">
                <option value="">Please Choose Category</option>
                <?php cate_parent($parent,0,'--',old('sltParent'));// hàm này nằm ở trong app/Tankiet/functions.php ta tự định nghĩa?>
            </select>
        </div>
        <div class="form-group">
            <label>Category Name</label>
            <input class="form-control" name="txtCateName" placeholder="Please Enter Category Name" value="{!! old('txtCateName') !!}" id="catename" />
             <!--{!! $errors->first('txtCateName') !!}-->
             <input type="hidden" name="txtCateName_slug" value="" id="slug_catename">
        </div>
        <div class="form-group">
            <label>Category Description</label>
            <textarea class="form-control" rows="3" name="txtDescription">{!! old('txtDescription') !!}</textarea>
        </div>
       
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Category Add</button>
        <button type="reset" class="btn btn-default">Reset</button>
        <form>
        </div>
@endsection
@section('script')
      <script src="{{ url('public/admin/js/slug.js') }}"></script>
@endsection