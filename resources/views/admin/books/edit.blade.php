@extends('admin.layout.master')
@section('title')
( Trang thêm Sách )
@endsection
@section('name_table')
Sách
@endsection
@section('method')
Edit
@endsection
@section('content')
<!-- /.col-lg-12 --><!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
    <!-- Hiện thông báo lỗi : vì mỗi cách hiện đều giống nhau nên ta gộp chung vào 1 file cho nó tiện-->
    @include('error')
    <!-- Hiện thông báo lỗi : vì mỗi cách hiện đều giống nhau nên ta gộp chung vào 1 file cho nó tiện-->
    <button  class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> <a href="{!! route('books.index') !!}">Back</a></button><br><br>
    <form action="{!! route('books.update',$book_edit->id) !!}" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        {{ method_field('PUT') }}
        <div class="form-group">
            <label>Category Parent</label>
            <select class="form-control" name="sltParent">
                <option value="">Please Choose Category</option>
                <?php cate_parent($category,0,'--',$book_edit->category_id);// hàm này nằm ở trong app/Tankiet/functions.php ta tự định nghĩa?>
            </select>
        </div>
        <div class="form-group">
            <label>Tiêu Đề</label>
            <input class="form-control" name="txtTitle" placeholder="Please Enter Title" value="{!! $book_edit->title !!}"  />
        </div>
        <div class="form-group">
            <label>Ảnh</label>
            <img src="{{ asset('resources/upload/book/'.$book_edit->image)}}" width="100" height="100"><br><br>
            <input type="file" name="fImages" value="{!! $book_edit->image !!}">
            <input type="hidden" name="image_current" value="{!!  $book_edit->image !!}">
        </div>
        <div class="form-group">
            <label>Giá gốc</label>
            <input class="form-control" name="txtPrice" placeholder="Please Enter Giá gốc" value="{!! $book_edit->price !!}"/>
        </div>
        <div class="form-group">
            <label>Giá Bìa</label>
            <input class="form-control" name="txtSale_price" placeholder="Please Enter Giá Bìa" value="{!! $book_edit->sale_price !!}"/>
        </div>
        <div class="form-group">
            <label>Tổng số trang</label>
            <input class="form-control" name="txtSotrang" placeholder="Please Enter Số trang" value="{!! $book_edit->pages !!}"/>
        </div>
        <div class="form-group">
            <label>Link download</label>
            <input class="form-control" name="txt_linkdown" placeholder="NULL" value="{!! $book_edit->linkdownload !!}"/>
        </div>
        <div class="form-group">
            <label>Intro</label>
            <textarea class="form-control" rows="3" name="txtIntro">{!! $book_edit->info !!}</textarea>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" rows="3" name="txtContent">{!! $book_edit->content !!}</textarea>
            <script type="text/javascript">
                ckeditor("txtContent")
            </script>
        </div>
        <br><br>
        <button type="submit" class="btn btn-primary">Sửa Sách</button>
        <button type="reset" class="btn btn-default">Reset</button>

    </div>
    <!--Tạo ra nhiều hình ảnh chi tiết khi thêm 1 sản phẩm -->
    <div class="col-md-1"></div>
    <div class="col-md-4"><br><br><br>
        <div class="form-group">
            <label>Trang Thái</label><br>
            <label class="radio-inline">
                <input name="rdoStatus" value="1"  type="radio" @if($book_edit->published==1) checked="" @endif>Public
            </label>
            <label class="radio-inline">
                <input name="rdoStatus" value="0" type="radio" @if($book_edit->published==0) checked="" @endif>Private
            </label>
        </div>
        
        <div class="form-group">
            <label>Sách Bán Chạy?</label><br>
            <label class="radio-inline">
                <input name="rdoHot" value="1"  type="radio" @if($book_edit->hot_banchay==1) checked="" @endif>Có
            </label>
            <label class="radio-inline">
                <input name="rdoHot" value="0" type="radio" @if($book_edit->hot_banchay==0) checked="" @endif>Không
            </label>
        </div>
        <div class="form-group">
            <label>Tác Giả</label>
            
            <select class="form-control" name="sltParent_tacgia[]" size="15" multiple="multiple">
              <!--  <option value="">Please Choose Category</option> -->


            @foreach($writer as $tg)
    <option value="{{ $tg->id }}" @if(count($book_writer)>0) @foreach($book_writer as $b_w) @if($tg->id==$b_w->writer_id) selected="selected" <?php break;?>@endif @endforeach @endif>
                                 {{$tg->name}}
                            </option>
            @endforeach
                
            </select>
            
        </div>
    </div>
  <form>
@endsection
