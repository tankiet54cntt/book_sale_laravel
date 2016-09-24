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
                    <li class="active">Cấp Lại Mật Khẩu Mới</li>
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
                                        <h2>CẤP LẠI MẬT KHẨU</h2>
                                    </div>
                                    <div id="checkout-one" class="collapse in">
                                        <div class="step-content">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                 
                                                    <label class="control-label text-primary" style="font-size:16px;">Cấp lại mật khẩu mới?</label>
                                                    <div class="radio" style="font-size:14px;">
                                                          <label>
                                                            *Nhập Mật Khẩu mới
                                                          </label>
                                                    </div>
                                                        <div class="radio" style="font-size:14px;">
                                                          <label>
                                                            *Xác Nhận mật khẩu mới
                                                          </label>
                                                        </div>
                                                        <div class="radio" style="font-size:14px;">
                                                          <label>
                                                            *Tiến hành thực hiện click vào Cấp lại Mật Khẩu mới
                                                          </label>
                                                        </div>
                                                    <br>
                                                    
                                                </div>
                                                <div class="col-sm-6">
                                        
                                                    <h4>CẤP LẠI MẬT KHẨU MỚI</h4>
                                                    <div class="line2 mtb20"></div>
                                                <form action="{{route('xacnhan',$code_pass_forget)}}" method="POST">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <div class="form-group" style="font-size:16px;">
                                                        <label class="control-label">Bạn chưa có tài khoản? hãy click <a href="{{route('get_register')}}" class="btn-link">vào đây</a></label>
                                                    </div>
                                       
                                        @if(!empty($errors->first('password')) || !empty($errors->first('repassword'))) <!-- nếu tồn tại một cái biến session nào đó được định nghĩa ở controller  -->
                                                <div class="alert alert-danger !!}"> <!-- hiển thị lớp -->
                                                  <h5 >  {{$errors->first('password')}} <!-- hiển thị giá trị của session đó  -->
                                                  </h5>
                                                  <h5>  {{$errors->first('repassword')}} <!-- hiển thị giá trị của session đó  -->
                                                  </h5>
                                                </div>
                                         @endif
                                         @if(Session::has('flash_message')) <!-- nếu tồn tại một cái biến session nào đó được định nghĩa ở controller  -->
                                        <div class="alert alert-{!! Session::get('flash_level') !!}"> <!-- hiển thị lớp -->
                                          <h5>  {!! Session::get('flash_message')!!} <!-- hiển thị giá trị của session đó  -->
                                          </h5>
                                        </div>
                                        @endif
                                                    <div class="form-group" style="font-size:14px;">
                                                        <label class="control-label">Mật Khẩu Mới<span class="text-primary">*</span></label>
                                                        <input type="password" name="password" class="form-control" placeholder="Nhập Password">
                                                    </div>
                                                    <div class="form-group" style="font-size:14px;">
                                                        <label class="control-label">Mật Khẩu Xác Nhận<span class="text-primary">*</span></label>
                                                        <input type="password" name="repassword" class="form-control" placeholder="Nhập Password confirm">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-danger btn-md fwb">Cấp Lại Mật Khẩu</button>
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