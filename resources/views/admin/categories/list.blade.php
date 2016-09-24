@extends('admin.layout.master')
@section('title')
( Trang hiển thị danh sách Category)
@endsection
@section('name_table')
Category
@endsection
@section('method')
List
@endsection
@section('content')
<!-- /.col-lg-12 -->
 <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> <a href="{{ route('categories.create')}}">Create</a></h5>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>STT</th>
            <th>ID</th>
            <th>Danh Mục Parent</th>
            <th>Tên</th>
            <th>Mô Tả </th>       
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
                @if($ls->parent_id==0)
                    {!! "None" !!}
                @else
                    <?php
                        $parent_name=DB::table('categories')->where('id',$ls->parent_id)->first();
                        echo $parent_name->name;
                    ?>
                @endif  
            </td>
            <td>
                {!! $ls->name !!}
            </td>
            <td>
                {!! $ls->description !!}
            </td>
            <td class="center">
                    
                  <form action="{!! route('categories.destroy',$ls->id)!!}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    {{ method_field('DELETE') }} <!-- như trong html là : <input type="hidden" name="_method" value="PUT"> -->  
                    <button onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')" type="submit" id="delete" class="btn btn-link"><i class="fa fa-trash-o  fa-fw"></i>Delete</button>
                  </form>
            </td>
            <td class="center"><a href="{!! route('categories.edit',$ls->id) !!}"><i style="margin-top:10px;" class="fa fa-pencil fa-fw"></i> Edit</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection