@extends('admin.layout.master')
@section('title')
Trang Chủ Admin
@endsection
@section('name_table')
Trang Chủ
@endsection
@section('method')
Admin
@endsection
@section('content')
@if(count($don_hang_cho)==0)
CHƯA CÓ ĐƠN HÀNG NÀO CHỜ THANH TOÁM CẢ
@else
<span style="color:red;">{{$errors->first()}}</span><br>
<form method="POST" action="{{route('duyettatca')}}">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="checkbox" name="checktin" id="check_all"> Chọn Tất Cả  <button class="btn btn-success">Duyệt</button><br><br>
<!-- kiểm tra thử xem đếm có chính xác không
<input type="text" name="demcheck" id="demcheck" disabled="true">
-->
</form>
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center" width="100%">
            <th>STT</th>
            <th>User_id</th>
            <th>customer_info</th>
            <th>order_info</th>
            <th>payment_info</th>  
            <th>Ngày Đặt hàng</th>         
            
            <th>Thanh Toán</th>
            <th>Hủy</th>                           
            
        </tr>
    </thead>
    <tbody>
        <?php $stt=0;?>
        @foreach($don_hang_cho as $item)
        <?php $stt++;?>
        <tr class="even gradeC" align="center">
            <td>{{$stt}}. <input type="checkbox"  name="checktin" class="check_1_tin"></td>
           
            <td>{{ $item->user_id }}</td>
           
            <td>
                 {{$item->customer_info}}
            </td>
           <td>
                 {{$item->order_info}}
            </td>
            <td>
                 {{$item->payment_info}}
            </td>
            <td>
                {{date("d - m - Y",strtotime($item->created_at))}} | 
                  <?php
                     echo \Carbon\Carbon::createFromTimeStamp(strtoTime($item->created_at))->diffForHumans();
                  ?>
            </td>
           
            <td class="center">
                    <a href="{{ route('duyetdonhang',$item->id)}}"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Thanh Toán</a>
            </td>
           
            <td class="center">
                   <a href="{{ route('huydonhang',$item->id) }}" onclick="return xacnhanxoa('Bạn Có Chắc Muốn Hủy Không ?')"><i class="fa fa-trash" aria-hidden="true"></i> Hủy</a>
            </td>
           
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection

@section('script')
		<script type="text/javascript">
			    //  khi click vào checkbox duyệt tất cả các checkbox ở phía table cũng hiện luôn
			    $(document).ready(function() {

			    	$("#check_all").change(function(){
			    		     
						       $(".check_1_tin").prop('checked', $(this).prop("checked"));
						       
						    //===========giải thích==============
						    /*
						       Change() : xác định khi checkbox có thay đổi trạng thái được check hoặc uncheck  (click cũng được)

							   Prop(): sẽ gán giá trị cho checkbox.
							*/
					   /*
						// hiện tất cả số checkbox ở phía table
						var countCheckedCheckboxes = $(".check_1_tin").filter(':checked').length;
						$('#demcheck').val(countCheckedCheckboxes);
					  */
			    	});


			    	/*
			    	 // Đếm số checbox được check khi thay đổi ở bảng table
			    	  var $checkboxes = $(".check_1_tin");
			    	  // đếm số checkbox được checked
							$checkboxes.click(function(){
						        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
						       // $('.check_1_tin').text(countCheckedCheckboxes);
						        
						        $('#demcheck').val(countCheckedCheckboxes);
						    });
					*/
			    });
		</script>
@endsection