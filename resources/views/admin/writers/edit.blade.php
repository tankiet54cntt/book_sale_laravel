@extends('admin.layout.master')
@section('title')
( Trang cập nhật Tác Giả )
@endsection
@section('name_table')
Tác Giả
@endsection
@section('method')
Update
@endsection
@section('content')
<!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
@include('error')
<button type="reset" class="btn btn-default"><a href="{!! route('writers.index') !!}"><i class="fa fa-undo" aria-hidden="true"></i> Back</a></button><br><br>
   <form action="{!! route('writers.update',$writer_edit->id)!!}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    {{ method_field('PUT') }} <!-- như trong html là : <input type="hidden" name="_method" value="PUT"> -->
       
        
       <div class="form-group">
            <label>Tên Tác giả</label>
            <input class="form-control" name="txt_writer" placeholder="Please Enter Category Name" value="{!! $writer_edit->name !!}" id="txt_writer" />
             <!--{!! $errors->first('txtCateName') !!}-->
            <!-- <input type="hidden" name="txt_writer_slug" value="" id="slug_txt_writer"> -->
        </div>
        <div class="form-group">
            <label>Tiểu Sử</label>
            <textarea class="form-control" rows="3" name="txt_story">{!! $writer_edit->story !!}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Category Edit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    </form> 
</div>
@endsection