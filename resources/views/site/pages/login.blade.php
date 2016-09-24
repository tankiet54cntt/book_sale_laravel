@extends('site.master')
@section('title')
--- Đăng Nhập
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
                    <li class="active">Login</li>
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
                                        <h2>THÔNG TIN ĐĂNG NHẬP</h2>
                                    </div>
                                    <div id="checkout-one" class="collapse in">
                                        <div class="step-content">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h4 style="color:black;font-weight:bold">Đăng Nhập vào hệ thống để làm gì?</h4>
                                                    <div class="line2 mtb20"></div>
                                                    <div class="form-group" ;">
                                                        <label class="control-label text-primary" style="font-size:16px;">*Thực hiện thanh toán sách có trong giỏ hàng</label>
                                                        <div class="radio" style="font-size:14px;">
                                                          <label>
                                                           + Xem lại lịch sử mua hàng của bạn
                                                          </label>
                                                        </div>
                                                        <div class="radio" style="font-size:14px;">
                                                          <label>
                                                           + Xem chi tiết của từng đơn hàng mà bạn đã từng mua
                                                          </label>
                                                        </div>
                                                    </div>
                                                    <p class="text-primary" style="font-size:16px;">*Tham gia thảo luận và đóng góp ý kiến của bạn cho chúng tôi!</p>
                                                    <p class="text-primary" style="font-size:16px;">*Sửa đổi thông tin cá nhân</p>
                                                    <label class="control-label text-primary" style="font-size:16px;">*Vào thời điểm nhất định nào đó?</label>
                                                    <div class="radio" style="font-size:14px;">
                                                          <label>
                                                            + Tham gia sự kiện với chúng tôi
                                                          </label>
                                                        </div>
                                                        <div class="radio" style="font-size:14px;">
                                                          <label>
                                                            + Có thể nhận được những mã code để được giảm gi khi mua
                                                          </label>
                                                        </div>
                                                        <div class="radio" style="font-size:14px;">
                                                          <label>
                                                            + Và còn nhiều ưu đãi khác nữa...
                                                          </label>
                                                        </div>
                                                    <br>
                                                    
                                                </div>
                                                <div class="col-sm-6">
                                        
                                                    <h4>ĐĂNG NHẬP</h4>
                                                    <div class="line2 mtb20"></div>
                                                <form action="{{route('login')}}" method="POST">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <div class="form-group">
                                                        <label class="control-label" style="font-size:14px;">Bạn chưa có tài khoản? hãy click <a href="{{route('get_register')}}" class="btn-link">vào đây</a></label>
                                                    </div>
                                       
                                        @if(!empty($errors->first('username')) || !empty($errors->first('password'))) <!-- nếu tồn tại một cái biến session nào đó được định nghĩa ở controller  -->
                                                <div class="alert alert-danger !!}"> <!-- hiển thị lớp -->
                                                  <h5 >  {{$errors->first('username')}} <!-- hiển thị giá trị của session đó  -->
                                                  </h5>
                                                  <h5>  {{$errors->first('password')}} <!-- hiển thị giá trị của session đó  -->
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
                                                        <label class="control-label" style="font-size:14px;">Username <span class="text-primary">*</span></label>
                                                        <input type="text" name="username" class="form-control" placeholder="Nhập Username">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" style="font-size:14px;">Password <span class="text-primary">*</span></label>
                                                        <input type="password" name="password" class="form-control" placeholder="Nhập Password">
                                                    </div>
                                                    <p><a href="{{route('get_forget_pass')}}" class="btn-link">Forgot your password?</a></p>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-danger btn-md btn-login fwb">LOGIN</button>
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
@section('javascript')
<script type="text/javascript">
    $("div.alert").delay(10000).slideUp(); // cái này nó hiện ra sau 10 giây và tự động tắt
</script>
@endsection