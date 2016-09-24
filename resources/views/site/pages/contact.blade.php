@extends('site.master')
@section('title')
--- Liên Hệ
@endsection
@section('css')
<style type="text/css">
	.mega-menu-category{
		display: none;
	}
  .outerwide{
    width:100%;
    float:left;
    position:relative;
}
.contact-info{
    background:#fbfbfb;
    padding:20px;
}
.contact-info p i{
    font-size:20px;
    margin-right:15px;
    width:20px;
    margin-bottom:20px;
    float:left;
    margin-top:-7px;
}
.mr{
    color:blue;
    font-size: 14px;
    font-family: "Times New Roman", Georgia, Serif;
}

</style>
@endsection
@section('breadcrumbs')
<div class="breadcrumbs">
            <div class="container">
                <ul class="breadcrumb" style="font-size:16px;">
                    <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                    <li class="active">Liên Hệ</li>
                </ul>
            </div>
</div>
@endsection
@section('content')
<div class="main">
            <div class="container">
                <div class="checkout">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="checkout-step">
                                <div class="checkout-step-item">
                                    <div class="step-title clearfix" data-toggle="collapse" data-target="#checkout-one">
                                        
                                        <h2>THÔNG TIN LIÊN HỆ</h2>
                                    </div>
                                   
                                </div>
                           </div>
                           <div class="outerwide">
                            <div class="contact-info">
                                <i class="fa fa-location-arrow" aria-hidden="true"></i><span class="mr"> Địa Chỉ</span>: Bến Xe Vạn Giã Lê Hồng Phong, tt. Vạn Giã, Vạn Ninh, Khánh Hòa, Vietnam.<br>
                                <i class="fa fa-phone" aria-hidden="true"></i><span class="mr"> Phone</span>:  01686 ... ... <i class="fa fa-fax" aria-hidden="true"></i><span class="mr"> Fax</span>:  73 443 11 23.<br>
                                <i class="fa fa-envelope" aria-hidden="true"></i><span class="mr"> Email</span>: <a href="javascript:void(0)">tankiet@gmail.com</a><br>                            
                            </div>
                           </div>
                             @include('error')
                                <form action="{{route('lienhe')}}" method="POST">
                                 <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                           
                                                    <div class="form-group">
                                                        <label class="control-label">Tên *</label>
                                                        <input type="text" name="name_contact" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Email *</label>
                                                        <input type="email" name="email_contact" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="noidung_lienhe">Nội Dung*</label>
                                                      <textarea class="form-control" rows="5" id="noidung_lienhe" name="noidung_lienhe"></textarea>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-success btn-md  fwb">Gủi Phản Hồi</button>
                                                    </div>
                                               
                                </form>
                            </div>
                        
                        <div class="col-sm-6">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3892.1577913641445!2d109.22576851435129!3d12.70312222415065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317018e7690cd749%3A0xe4d823add0605fb4!2zQuG6v24gWGUgVuG6oW4gR2nDow!5e0!3m2!1sen!2s!4v1470984679578" frameborder="0" style="border:0" allowfullscreen id="map_lienhe" width="100%" height="485"></iframe>
                        </div> 
                     </div>
                 </div>
            </div>
</div><!-- /.main -->
@endsection
@section('javascript')

@endsection