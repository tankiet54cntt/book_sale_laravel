@extends('admin.layout.master')
@section('title')
( Trang hiển thị danh sách Người dùng)
@endsection
@section('name_table')
Người dùng
@endsection
@section('method')
List
@endsection
@section('content')
<!-- /.col-lg-12 -->
 <h5><a href="{{ route('users.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create</a></h5>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>STT</th>
            <th>ID</th>
            <th>Tên Nhóm</th>
            <th>Tên UserName</th>
            <th>email</th>
            <th>firstname</th>  
            <th>lastname</th>
            <th>address</th>
            <th>Số Phone</th>        
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
                
                    <?php
                        $group_name=DB::table('groups')->where('id',$ls->group_id)->first();
                        echo $group_name->name;
                    ?>
            </td>
            <td>
                {!! $ls->username !!}
            </td>
            <td>
                {!! $ls->email !!}
            </td>
            <td>
                {!! $ls->firstname !!}
            </td>
            <td>
                {!! $ls->lastname !!}
            </td>
            <td>
               {!! $ls->address !!}
            </td>
            <td>
                {!! $ls->phone_number !!}
            </td>
           
            <td class="center">
                    
                  <form action="{!! route('users.destroy',$ls->id)!!}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    {{ method_field('DELETE') }} <!-- như trong html là : <input type="hidden" name="_method" value="DELETE"> -->  
                    <button onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')" type="submit" id="delete" class="btn btn-link"><i class="fa fa-trash-o  fa-fw"></i> Delete</button>
                  </form>
            </td>
            <td class="center"><a href="{!! route('users.edit',$ls->id) !!}"><i style="margin-top:10px;" class="fa fa-pencil fa-fw"></i> Edit</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection