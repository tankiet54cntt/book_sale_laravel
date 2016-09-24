@extends('admin.layout.master')
@section('title')
( Trang hiển thị danh sách Nhóm người dùng)
@endsection
@section('name_table')
Nhóm người dùng
@endsection
@section('method')
List
@endsection
@section('content')
<!-- /.col-lg-12 -->
 <h5><a href="{{ route('groups.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create</a></h5>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>STT</th>
            <th>ID</th>
            <th>Tên Nhóm</th>
            <th>Mô Tả</th>
            <th>Level</th>       
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
                @if($ls->description==NULL) 
                    <span style="color:#CCC;font-weight:bold"> NULL </span>
                @else
                    {!! $ls->description !!}
                @endif
            </td>
            <td>
                @if($ls->level==1) 
                    <span style="color:green;font-weight:bold"> Quản trị </span>
                @elseif($ls->level==0) 
                    <span style="color:blue;font-weight:bold"> Nhân Viên </span>
                @else
                    <span style="color:pink;font-weight:bold"> Khách Hàng </span>
                @endif 
            </td>
            <td class="center">
                    
                  <form action="{!! route('groups.destroy',$ls->id)!!}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    {{ method_field('DELETE') }} <!-- như trong html là : <input type="hidden" name="_method" value="DELETE"> -->  
                    <button onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')" type="submit" id="delete" class="btn btn-link"><i class="fa fa-trash-o  fa-fw"></i> Delete</button>
                  </form>
            </td>
            <td class="center"><a href="{!! route('groups.edit',$ls->id) !!}"><i style="margin-top:10px;" class="fa fa-pencil fa-fw"></i> Edit</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection