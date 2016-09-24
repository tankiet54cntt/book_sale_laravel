@extends('admin.layout.master')
@section('title')
( Trang thêm Sách )
@endsection
@section('name_table')
Sách
@endsection
@section('method')
Add
@endsection
@section('content')
<!-- /.col-lg-12 --><!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
    <!-- Hiện thông báo lỗi : vì mỗi cách hiện đều giống nhau nên ta gộp chung vào 1 file cho nó tiện-->
    @include('error')
    <!-- Hiện thông báo lỗi : vì mỗi cách hiện đều giống nhau nên ta gộp chung vào 1 file cho nó tiện-->
    <button  class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> <a href="{!! route('books.index') !!}">Back</a></button><br><br>
    <form action="{!! route('books.store') !!}" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Category Parent</label>
            <select class="form-control" name="sltParent">
                <option value="">Please Choose Category</option>
                <?php cate_parent_book($category,0,'--',old('sltParent'));// hàm này nằm ở trong app/Tankiet/functions.php ta tự định nghĩa?>
            </select>
        </div>
        <div class="form-group">
            <label>Tiêu Đề</label>
            <input class="form-control" name="txtTitle" placeholder="Please Enter Title" value="{!! old('txtTitle') !!}" id="txtTitle" />
            <input type="hidden" name="txtTitle_slug" value="" id="slug_txtTitle">
        </div>
        <div class="form-group">
            <label>Ảnh</label>
            <input type="file" name="fImages" value="{!! old('fImages') !!}">
        </div>
        <div class="form-group">
            <label>Giá gốc</label>
            <input class="form-control" name="txtPrice" placeholder="Please Enter Giá gốc" value="{!! old('txtPrice') !!}"/>
        </div>
        <div class="form-group">
            <label>Giá Bìa</label>
            <input class="form-control" name="txtSale_price" placeholder="Please Enter Giá Bìa" value="{!! old('txtSale_price') !!}"/>
        </div>
        <div class="form-group">
            <label>Tổng số trang</label>
            <input class="form-control" name="txtSotrang" placeholder="Please Enter Số trang" value="{!! old('txtSotrang') !!}"/>
        </div>
        <div class="form-group">
            <label>Link download</label>
            <input class="form-control" name="txt_linkdown" placeholder="Please Enter link download" value="{!! old('txt_linkdown') !!}"/>
        </div>
        <div class="form-group">
            <label>Intro</label>
            <textarea class="form-control" rows="3" name="txtIntro">{!! old('txtIntro')!!}</textarea>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent')!!}</textarea>
            <script type="text/javascript">
                ckeditor("txtContent")
            </script>
        </div>
        <br><br>
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Sách</button>
        <button type="reset" class="btn btn-default">Reset</button>

    </div>
    <!--Tạo ra nhiều hình ảnh chi tiết khi thêm 1 sản phẩm -->
    <div class="col-md-1"></div>
    <div class="col-md-4"><br><br><br>
        <div class="form-group">
            <label>Trang Thái</label><br>
            <label class="radio-inline">
                <input name="rdoStatus" value="1" checked="" type="radio">Public
            </label>
            <label class="radio-inline">
                <input name="rdoStatus" value="0" type="radio">Private
            </label>
        </div>
        <div class="form-group">
            <label>Sách Bán Chạy?</label><br>
            <label class="radio-inline">
                <input name="rdoHot" value="1"  type="radio">Có
            </label>
            <label class="radio-inline">
                <input name="rdoHot" value="0" checked="" type="radio">Không
            </label>
        </div>
        
        <div class="form-group">
            <label>Tác Giả</label>
            
            <select class="form-control" name="sltParent_tacgia[]" size="15" multiple="multiple">
              <!--  <option value="">Please Choose Category</option> -->
                 @foreach($writer as $tg)
                    <option value="{{ $tg->id }}">
                         {{$tg->name}}
                    </option>
                 @endforeach
            </select>        
        </div>

    </div>
  <form>
@endsection
@section('script')
      <script src="{{ url('public/admin/js/slug.js') }}"></script>
@endsection