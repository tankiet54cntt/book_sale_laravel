@extends('site.master')
@section('title')
--- Lịch sử mua hàng
@endsection
@section('css')
<style type="text/css">
    .mega-menu-category{
        display: none;
    }
   
    #muangay:hover,#xemchitiet:hover{
        color:red !important;
    }
    
</style>
@endsection
@section('breadcrumbs')
<div class="breadcrumbs">
            <div class="container" style="font-size:16px;">
                <ul class="breadcrumb">
                    <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                    <li class="active">Lịch sử mua hàng</li>
                </ul>
            </div>
</div>
@endsection
@section('content')
<div class="main">
            <div class="container">
             @if(Session::has('flash_message')) <!-- nếu tồn tại một cái biến session nào đó được định nghĩa ở controller  -->
                            <div class="alert alert-{!! Session::get('flash_level') !!}"> <!-- hiển thị lớp -->
                              <h5>  {!! Session::get('flash_message')!!} <!-- hiển thị giá trị của session đó  -->
                              </h5>
                            </div>
            @endif
                <div class="cart">
                   
                    <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr class="first last">
                                <th>STT</th>
                                <th>Thời gian</th>
                                <th>Email</th>
                                <th>Tiền Thanh Toán</th>
                                <th>Tình Trạng</th>
                                <th>Chi Tiết</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($orders)>0)
                          <?php $stt=0; ?>
                          @foreach($orders as $order)
                            <?php $stt++; ?>
                            <tr>
                                <td class="text-center">{{$stt}}</td>
                                <td class="text-center">
                                    {{ date("d-m-Y H:i:s",strtoTime($order->created_at)) }}
                                </td>
                                <td>
                                    <?php echo json_decode($order['customer_info'])->email;?>
                                </td>
                                <td class="text-center">{{ number_format(json_decode($order['payment_info'])->tienphaitra,0,",",".")}} đ</td>
                                <td class="text-center">
                                    @if($order->status==0)
                                        <span style="color:blue;">Đang xử lý</span>
                                    @elseif($order->status==1)
                                        <span style="color:green;">Đã Xử lý</span>
                                    @else
                                        <span style="color:red;">Hủy</span>
                                    @endif
                                </td>
                                <td class="text-center"><a id="xemchitiet" style="color:green" href="{{route('chitietdonhang',$order['id'])}}">Xem</a></td>
                               
                            </tr>
                          @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="7" style="border:0"><span style="font-size:22px;font-weight:bold;color:green">Bạn Chưa Mua Hàng bao giờ ! <a id="muangay" style="color:blue" href="{{route('sachmoi')}}">Mua Ngay</a></span> </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    </div>
                    
                   
                </div>
            </div>
        </div><!-- /.main -->
@endsection
@section('javascript')
  <script type="text/javascript">
  $(document).ready(function(){

        
  });
 </script>
@endsection