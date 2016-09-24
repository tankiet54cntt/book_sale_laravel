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
<button type="reset" class="btn btn-default"><a href="{!! route('groups.index') !!}"><i class="fa fa-undo" aria-hidden="true"></i> Back</a></button><br><br>
   <form action="{!! route('groups.update',$group_edit->id)!!}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    {{ method_field('PUT') }} <!-- như trong html là : <input type="hidden" name="_method" value="PUT"> -->
       
        
       <div class="form-group">
            <label>Tên Nhóm</label>
            <input class="form-control" name="txt_group" placeholder="Please Enter Group Name" value="{!! $group_edit->name !!}"  />
             <!--{!! $errors->first('txtCateName') !!}-->
        </div>
        <div class="form-group">
            <label>Mô Tả</label>
            <textarea class="form-control" rows="3" name="txt_description">{!! $group_edit->description !!}</textarea>
        </div>
        <div class="form-group">
            <label>Level</label><br>
            <label class="radio-inline">
                <input name="rdoLevel" value="1" type="radio" @if($group_edit->level==1) checked="" @endif >Quản Trị
            </label>
            <label class="radio-inline">
                <input name="rdoLevel" value="0" type="radio" @if($group_edit->level==0) checked="" @endif>Nhân Viên
            </label>
            <label class="radio-inline">
                <input name="rdoLevel" value="2" type="radio" @if($group_edit->level==2) checked="" @endif>Khách Hàng
            </label>
        </div><br>
        <button type="submit" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Category Edit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    </form> 
</div>
@endsection