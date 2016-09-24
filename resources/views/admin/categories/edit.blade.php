@extends('admin.layout.master')
@section('title')
( Trang cập nhật category )
@endsection
@section('name_table')
Category
@endsection
@section('method')
Update
@endsection
@section('content')
<!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
@include('error')
<button type="reset" class="btn btn-default"><a href="{!! route('categories.index') !!}"><i class="fa fa-undo" aria-hidden="true"></i> Back</a></button><br><br>
   <form action="{!! route('categories.update',$cate_edit->id)!!}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    {{ method_field('PUT') }} <!-- như trong html là : <input type="hidden" name="_method" value="PUT"> -->
        <div class="form-group">
            <label>Category Parent</label>
            <select class="form-control" name="sltParent">
                <option value="0">Please Choose Category</option>
                <?php cate_parent($parent,0,$str='--',$cate_edit['parent_id']);// hàm này nằm ở trong app/Tankiet/functions.php ta tự định nghĩa?>
            </select>
        </div>
        <div class="form-group">
            <label>Category Name</label>
            <input class="form-control" name="txtCateName" value="{!! $cate_edit->name !!}" />
        </div>
       
        <div class="form-group">
            <label>Category Description</label>
            <textarea class="form-control" rows="3" name="txtDescription">{!! $cate_edit->description !!}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Category Edit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    </form> 
</div>
@endsection