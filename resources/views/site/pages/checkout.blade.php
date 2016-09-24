@extends('site.master')
@section('css')
<style type="text/css">
	.mega-menu-category{
		display: none;
	}
</style>
@endsection
@section('breadcrumbs')
<div class="breadcrumbs">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                    <li><a href="#">Cart</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
</div>
@endsection
@section('content')
<div class="main">
            <div class="container">
                <div class="checkout">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="checkout-step">
                                <div class="checkout-step-item">
                                    <div class="step-title clearfix" data-toggle="collapse" data-target="#checkout-one">
                                        
                                        <h2>THÔNG TIN MUA HÀNG</h2>
                                    </div>
                                   
                                </div>
                           </div>
                             @include('error')
                                        <form action="{{route('thanhtoan')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                   
                                                    
                                                    <div class="form-group">
                                                        <label class="control-label">Tên *</label>
                                                        <input type="text" name="txtName" class="form-control" value="tấn kiệt">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Email *</label>
                                                        <input type="email" name="txtEmail" class="form-control" value="tankiet@gmail.com">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Địa Chỉ</label>
                                                        <input type="text" name="txtdiachi" class="form-control" value="ninh lâm">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Phone *</label>
                                                        <input type="text" class="form-control" name="txtPhone" value="01686947816">
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-success btn-md btn-login fwb">Thực Thi Thanh Toán</button>
                                                    </div>
                                               
                                        </form>
                            </div>
                        <div class="col-sm-4">
                                <div class="checkout-step">
                                            <div class="checkout-step-item">
                                                <div class="step-title clearfix" data-toggle="collapse" data-target="#checkout-one">
                                                    
                                                    <h2>VẬN CHUYỂN</h2>
                                                </div>
                                               
                                            </div>
                                            
                               </div><br>
                               <div class="form-group" style="margin-top:3px">
                                    
                                                    <select style="width:100%;height:33px;text-align:center">
                                                        <option>Giao Hàng Tận Nơi, đặc biệt khu vực TPHCM</option>
                                                        <option>Gửi Qua đường bưu điện</option>
                                                        <option>Gửi Xe đường</option>
                                                    </select>
                                </div>
                            </div>
                        <div class="col-sm-4">
                            <div class="checkout-step">
                                <div class="checkout-step-item">
                                    <div class="step-title clearfix" data-toggle="collapse" data-target="#checkout-one">
                                        
                                        <h2>ĐƠN HÀNG</h2>
                                    </div>
                                   
                                </div>
                           </div>
                             @include('error')
                                        <form action="{{route('thanhtoan')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                   
                                                @if(Auth::check())
                                                    <div class="form-group">
                                                        <label class="control-label">Tên *</label>
                                                        <input type="text" name="txtName" class="form-control" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Email *</label>
                                                        <input type="email" name="txtEmail" class="form-control" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Địa Chỉ</label>
                                                        <input type="text" name="txtdiachi" class="form-control" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Phone *</label>
                                                        <input type="text" class="form-control" name="txtPhone" value="">
                                                    </div>
                                               
                                                @endif
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-success btn-md btn-login fwb">Thực Thi Thanh Toán</button>
                                                    </div>
                                               
                                        </form>
                            </div>

                     </div>
                 </div>
            </div>
</div><!-- /.main -->
@endsection
@section('javascript')

@endsection