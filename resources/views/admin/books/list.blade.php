@extends('admin.layout.master')
@section('title')
( Trang list Sách )
@endsection
@section('name_table')
Sách
@endsection
@section('method')
List
@endsection
@section('content')
<!-- /.col-lg-12 -->
<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> <a href="{!! route('books.create') !!}">Create</a></h5>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>STT</th>
            <th>ID</th>
            <th>Tên Danh Mục</th>
            <th>Image</th>
            <th>Tiêu Đề</th>
            <th>Tác giả</th>
            <th>Giá gốc</th>
            <th>Giá bìa</th>
            <th>Số trang</th>
            <th>Ngày đăng</th>
            <th>Trạng Thái</th>
            <th>Hot</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=0;?>
        @foreach($list as $ls)
        <?php $stt++;?>
        <tr class="odd gradeX" align="center">
            <td>{!! $stt !!}</td>
            <td>{!! $ls->id !!}</td>
            <td>
                <?php $cate=DB::table('categories')->where('id',$ls->category_id)->first(); ?>
                    @if(!empty($cate->name))
                        {!! $cate->name !!}
                    @endif
            </td>
            <td>
                <img width="50" height="50" src="{!! url('resources/upload/book',$ls->image)!!}">
            </td>
            <td>{!! $ls->title !!}</td>
            <td>
                <?php $tacgia=DB::table('books_writers')->where('book_id',$ls->id)->get(); ?>
                @if(count($tacgia)>1)
                    Nhiều Tác Giả
                @else
                    @foreach($writer as $value)
                        @foreach($tacgia as $tg)
                            @if($value->id==$tg->writer_id)
                                {{$value->name}}
                                <?php break;?>
                            @endif
                        @endforeach
                    @endforeach
                     
                @endif
            </td>
         
            <td>{!! number_format($ls->price,0,",",".") !!} VNĐ</td> <!-- chuyển về dạng tiền tệ-->
            <td>{!! number_format($ls->sale_price,0,",",".") !!} VNĐ</td> <!-- chuyển về dạng tiền tệ-->
            <td>{!! $ls->pages !!}</td>
            
            <td>
                <?php
                    // hiển thị ngày hoặc giờ hoặc phút đăng sản phẩm
                    echo date("d-m-Y H:i:s",strtoTime($ls->created_at));
                ?>
            </td>
            
            <td>
                @if($ls->published==1)
                   <span style="color:green"> published</span>
                @else
                    <span style="color:red"> not published</span>
                @endif
            </td>
            <td>
                @if($ls->hot_banchay==1)
                   <span style="color:red"> Bán Chạy</span>
                @else
                    <span style="color:#CCC"> Bình thường</span>
                @endif
            </td>
            <td class="center">
                    <form action="{!! route('books.destroy',$ls->id)!!}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    {{ method_field('DELETE') }} <!-- như trong html là : <input type="hidden" name="_method" value="PUT"> -->  
                    <button onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')" type="submit" id="delete" class="btn btn-link"><i class="fa fa-trash-o  fa-fw"></i>Delete</button>
                  </form>
            </td>
            <td class="center"><a href="{!! route('books.edit',$ls->id) !!}"><i style="margin-top:10px;" class="fa fa-pencil fa-fw"></i> Edit</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
