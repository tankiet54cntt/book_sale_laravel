@extends('admin.layout.master')
@section('title')
( Trang hiển thị danh sách Tác giả)
@endsection
@section('name_table')
Tác Giả
@endsection
@section('method')
List
@endsection
@section('content')
<!-- /.col-lg-12 -->
 <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> <a href="{{ route('writers.create')}}">Create</a></h5>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>STT</th>
            <th>ID</th>
            <th>Tên Tác Giả</th>
            <th>Tiểu Sử</th>       
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=0; ?>
        @foreach($list as $ls)
        <?php $stt++;?>
        <tr class="odd gradeX" align="center">
            <td>{!! $stt !!}</td>
            <td>{!! $ls->id !!}</td>
            <td>
                {!! $ls->name !!}
            </td>
            <td>
                @if($ls->story==NULL) 
                    <span style="color:#CCC;font-weight:bold"> Chưa có thông tin gì </span>
                @else
                    {!! $ls->story !!}
                @endif
            </td>
            <td class="center">
                    
                  <form action="{!! route('writers.destroy',$ls->id)!!}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    {{ method_field('DELETE') }} <!-- như trong html là : <input type="hidden" name="_method" value="DELETE"> -->  
                    <button onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')" type="submit" id="delete" class="btn btn-link"><i class="fa fa-trash-o  fa-fw"></i> Delete</button>
                  </form>
            </td>
            <td class="center"><a href="{!! route('writers.edit',$ls->id) !!}"><i style="margin-top:10px;" class="fa fa-pencil fa-fw"></i> Edit</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection