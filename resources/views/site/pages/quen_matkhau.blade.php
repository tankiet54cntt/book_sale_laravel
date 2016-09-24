@extends('site.master')
@section('title')
--- Quên Mật Khẩu
@endsection
@section('css')
<style type="text/css">
    .mega-menu-category{
        display: none;
    }
   .catlist{
    display: none;
   }
</style>
@endsection
@section('breadcrumbs')
<div class="breadcrumbs">
            <div class="container">
                <ul class="breadcrumb" style="font-size:16px;">
                    <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                    <li class="active">Quên Mật Khẩu</li>
                </ul>
            </div>
</div>
@endsection
@section('content')
<div class="main">
            <div class="container">
                <div class="checkout">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="checkout-step">
                                <div class="checkout-step-item">

                                    <div class="step-title clearfix" data-toggle="collapse" data-target="#checkout-one">
                                        <span class="number"></span>
                                        <h2>THÔNG TIN Quên Mật Khẩu</h2>
                                    </div>
                                    <div id="checkout-one" class="collapse in">
                                        <div class="step-content">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h4 style="color:black;font-weight:bold">Bạn đã quên mật khẩu của mình?</h4>
                                                    <div class="line2 mtb20"></div>
                                                    <div class="form-group" >
                                                        <label class="control-label text-primary" style="font-size:16px;">*Thực hiện các bước sau đây để cấp lại mật khẩu</label>
                                                        <div class="radio">
                                                          <label style="font-size:14px;">
                                                            + Nhập email của tài khoản mà bạn đã sử dụng
                                                          </label>
                                                        </div>
                                                        <div class="radio" style="font-size:14px;">
                                                          <label>
                                                            + Thực hiện click cấp lại mật khẩu
                                                          </label>
                                                        </div>
                                                    </div>
                                                    
                                                    <label class="control-label text-primary" style="font-size:16px;">*Nếu Email là của bạn</label>
                                                    <div class="radio">
                                                          <label style="font-size:14px;">
                                                            + Hệ thống sẽ trả về email bạn đã nhập một mã xác nhận
                                                          </label>
                                                        </div>
                                                        <div class="radio" style="font-size:14px;"">
                                                          <label>
                                                            + Vào email để kiểm tra có mã xác nhận không 
                                                          </label>
                                                        </div>
                                                        <div class="radio" style="font-size:14px;">
                                                          <label>
                                                            + Lấy mã xác nhận và điền vào form trên màn hình
                                                          </label>
                                                        </div>
                                                        <div class="radio" style="font-size:14px;">
                                                          <label>
                                                            + Hệ thống sẽ yêu cầu bạn nhập mật khẩu mới
                                                          </label>
                                                        </div>
                                                        <div class="radio" style="font-size:16px;"> 
                                                          <label style="color:green">
                                                           + Hoàn tất
                                                          </label>
                                                        </div>
                                                    <br>
                                                    
                                                </div>
                                                <div class="col-sm-6">
                                        
                                                    <h4>QUÊN MẬT KHẨU</h4>
                                                    <div class="line2 mtb20"></div>
                                                <form action="{{route('forget_pass')}}" method="POST">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    @if(!empty($errors->first('email'))) <!-- nếu tồn tại một cái biến session nào đó được định nghĩa ở controller  -->
                                                <div class="alert alert-danger !!}"> <!-- hiển thị lớp -->
                                                  <h5 >  {{$errors->first('email')}} <!-- hiển thị giá trị của session đó  -->
                                                  </h5>
                                                 
                                                </div>
                                               @endif
                                               @if(Session::has('flash_message')) <!-- nếu tồn tại một cái biến session nào đó được định nghĩa ở controller  -->
                                                <div class="alert alert-{!! Session::get('flash_level') !!}"> <!-- hiển thị lớp -->
                                                  <h5>  {!! Session::get('flash_message')!!} <!-- hiển thị giá trị của session đó  -->
                                                  </h5>
                                                </div>
                                                @endif
                                                    <div class="form-group">
                                                        <label class="control-label" style="font-size:16px;">Nhập Email Lấy Lại Mật Khẩu<span class="text-primary">*</span></label>
                                                        <input type="email" name="email" class="form-control" placeholder="example : abc@gmail.com" value="{{old('email')}}">
                                                    </div>
                                                   
                                                   
                                                    
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-danger btn-md  fwb">Cấp Lại Mật Khẩu</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
</div><!-- /.main -->
@endsection
