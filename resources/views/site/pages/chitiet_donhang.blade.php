@extends('site.master')
@section('title')
--- Chi Tiết Đơn Hàng
@endsection
@section('css')
<style type="text/css">
    .mega-menu-category{
        display: none;
    }
   .thongtin{
    color:black;
    font-weight: bold;
   }
   .thongtin_tt{
    color:black;
    font-size: 18px !important;
    font-weight: bold !important;
   }
   .table-cart-detail tbody > tr > td {
    border: 0;
    font-size: 16px;
   }
.table-cart-detail {
    
    margin-bottom: 20px;
  }
</style>
@endsection
@section('breadcrumbs')
<div class="breadcrumbs">
            <div class="container">
                <ul class="breadcrumb" style="font-size:16px;">
                    <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                    <li class="active">Chi Tiết Đơn Hàng</li>
                </ul>
            </div>
</div>
@endsection
@section('content')
    <div class="main">
            <div class="container">
                <div class="cart">
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <table class="table table-cart-detail">
                                <tr>
                                    <td class="thongtin">Họ Tên Người Mua Hàng :</td>
                                    <td >{{json_decode($order['customer_info'])->ten}}</td>
                                </tr>
                                <tr>
                                    <td class="thongtin">Email :</td>
                                    <td >{{json_decode($order['customer_info'])->email}}</td>
                                </tr>
                                <tr>
                                    <td class="thongtin">Số điện toại :</td>
                                    <td >{{json_decode($order['customer_info'])->phone}}</td>
                                </tr>
                                <tr>
                                    <td class="thongtin">Địa Chỉ :</td>
                                    <td >{{json_decode($order['customer_info'])->diachi}}</td>
                                </tr>
                            </table>
                           
                        </div>
                       
                        <div class="col-sm-6">
                            <table class="table table-cart-detail">
                                <tr>
                                    <td class="thongtin">Mã Đơn Hàng :</td>
                                    <td >DHBMH00{{$order->id}}</td> <!--do ta chỉ lấy được id trong order-->
                                </tr>
                              @if(isset(json_decode($order['payment_info'])->total))
                                <tr>
                                    <td class="thongtin">Tổng Cộng Tiền :</td>
                                    <td >{{ number_format(json_decode($order['payment_info'])->total,0,",",".")}} đ</td>
                                </tr>
                                <tr>
                                    <td class="thongtin">Mã Giảm Giá :</td>
                                    <td >{{json_decode($order['payment_info'])->code}} - Giảm {{json_decode($order['payment_info'])->percent}}%</td>
                                </tr>
                             @endif
                                <tr>
                                    <td class="thongtin">Tiền Phải Trả :</td>
                                    <td >{{ number_format(json_decode($order['payment_info'])->tienphaitra,0,",",".")}} đ</td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                   <div class="line2"></div>
                    <div class="thongtin" style="font-size:18px;">Tình Trạng Đơn Hàng : 
                        @if($order->status==0)
                            <span class="btn btn-info">Đang Xử lý </span></div>
                        @elseif($order->status==1)
                            <span class="btn btn-success">Đã Xử lý </span></div>
                        @else
                            <span class="btn btn-default">Đã Hủy</span></div>
                        @endif
                        
                    <div class="line2"></div>
                    <!-- bảng -->
                    <div class="thongtin"><span class="btn btn-primary">Sách Đã Order Và Mua </span></div><br>
                    <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr class="first last" >
                                <th class="thongtin_tt">STT</th>
                                <th class="thongtin_tt">Ảnh</th>
                                <th class="thongtin_tt">Tên sách</th>
                                <th class="thongtin_tt">Số Lượng</th>
                                <th class="thongtin_tt">Giá</th>
                                <th class="thongtin_tt">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $stt=0;?>
                           @foreach($books as $book)
                           <?php $stt++?>
                            <tr>
                                <td class="text-center" style="font-size:16px;">
                                    {{$stt}}
                                </td>
                                <td><a class="product-image" title="{{$book->name}}">
                                    <img width="100" height="200" alt="Primis in faucibus" src="{{asset('resources/upload/book/'.$book->options->img)}}">
                                </a></td>
                                <td class="text-center" style="font-size:16px;">
                                    {{$book->name}}
                                </td>
                              
                                <td class="text-center" style="font-size:16px;">
                                    
                                        {{$book->qty}}
                                   
                                </td>
                                <td class="text-center" style="font-size:16px;">{{number_format($book->price,0,",",".")}}đ</td>
                               <td class="text-center" style="font-size:16px;">
                                 @if(isset($link))
                                   @if($link[$book->id]==NULL)
                                      <span style="color:#CCC">NULL</span>
                                   @else
                                    <a href="{{$link[$book->id]}}" class="btn-link"><i class="fa fa-download" aria-hidden="true" target="_blank"></i>download</a> 
                                   @endif
                                 @else
                                    @if($order->status==0)
                                        <span class="btn btn-info">Đang Xử lý </span></div>
                                    @elseif($order->status==1)
                                        <span class="btn btn-success">Đã Xử lý </span></div>
                                    @else
                                        <span class="btn btn-default">Đã Hủy</span></div>
                                    @endif
                                 @endif
                               </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                    </div>        
                   
                </div>
            </div>
        </div><!-- /.main -->
@endsection
