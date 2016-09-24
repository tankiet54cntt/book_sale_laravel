<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{asset('public/logo.png') }}">

    <title>Web Bán Sách @yield('title')</title>
    <link href="{{asset('public/site/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <link href="{{asset('public/site/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/site/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('public/site/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/site/css/responsive.css')}}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Xử lý khi click vào giỏ hang-->
    <script src="{{asset('public/site/js/jquery-1.11.0.min.js')}}"></script>
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        
    </style>
  </head>
  <body>
  <?php $tool=NULL;?>
      <!--======== HEADER ========= -->
        <div class="header">
                <!-- topbar -->
                <div class="topbar">
                    <div class="container">
                        <div class="topbar-left">
                            <ul class="topbar-nav clearfix">
                                <li><span class="phone">01686947816</span></li>
                                <li><span class="email">phptestfree@gmail.com</span></li>
                            </ul>
                        </div>
                        <div class="topbar-right">
                            <ul class="topbar-nav clearfix">
                               @if(Auth::check()) <!-- nếu như đã đăng nhập-->
                                
                                <li class="dropdown">
                                    <a href="#" class="account dropdown-toggle" data-toggle="dropdown">{{Auth::user()->username}}</a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a title="My Account" href="account.html">My Account</a></li>
                                        @if(Auth::user()->group_id==1) <!-- nếu nhóm user là 1 : (admin)-->
                                        <li><a title="My Account" href="{{route('quangtri')}}">Trang Quảng Trị</a></li>
                                        @endif
                                        <li><a title="Lịch sử mua hàng" href="{{route('lichsumuahang')}}">Lịch sử mua hàng</a></li>
                                        <li><a title="My Wishlist" href="wishlist.html">My Wishlist</a></li>
                                        <li><a title="My Cart" href="{{route('giohang')}}">My Cart</a></li>
                                        <li><a title="Checkout" href="">Checkout</a></li>
                                        
                                        <li><a title="Đăng Xuất" href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                                    </ul>
                                </li>
                                @else
                                    <li><a href="{{route('login')}}" style="font-size:12px"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                                    <li><a href="{{route('get_register')}}" style="font-size:12px"><i class="fa fa-key" aria-hidden="true"></i> Register</a></li>
                                @endif
                                <li class="dropdown">
                                    <a href="#" class="currency dropdown-toggle" data-toggle="dropdown">USD</a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#">Euro</a></li>
                                        <li><a href="#">US Dollar</a></li>
                                        <li><a href="#">VN</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="language dropdown-toggle" data-toggle="dropdown"><img src="{{asset('public/site/images/flag-us.png')}}" alt=""> English</a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#"><img src="{{asset('public/site/images/flag-us.png')}}" alt=""> &nbsp;English</a></li>
                                        <li><a href="#"><img width="16" height="11" src="{{asset('public/site/images/vietnam.jpg')}}" alt=""> &nbsp;Việt Nam</a></li>
                                        <li><a href="#"><img width="16" height="11" src="{{asset('public/site/images/flag-spain.png')}}" alt=""> &nbsp;Spain</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.container -->
                </div>
               <!-- /.topbar -->
                <!-- header-bottom -->
            <div class="header-bottom">
                <div class="container">
                    <div class="row">
                       <!-- ẢNH LOGO -->
                        <div class="col-md-3">
                            <a href="{{url('/')}}" class="logo"><img height="100" width="166"  src="{{asset('public/site/images/logo.gif')}}" alt=""></a>
                        </div>
                       <!-- ẢNH LOGO -->
                        <div class="col-md-9">
                            <div class="support-client">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="box-container time">
                                            <div class="box-inner">
                                                <h2>working time</h2>
                                                <p>Mon- Sta : 8.00 - 21.00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="box-container free-shipping">
                                            <div class="box-inner">
                                                <h2>Free shipping</h2>
                                                <p>On order over $199</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="box-container money-back">
                                            <div class="box-inner">
                                                <h2>Money back 100%</h2>
                                                <p>Within 30 Days after delivery</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.support-client -->
                            <form class="form-search" action="{{route('timkiem')}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="text" class="input-text" name="q" id="search" placeholder="Search Books..." @if(isset($tukhoa)) value="{{$tukhoa}}" @endif>
                                <div class="dropdown">
                                    <button type="button" class="btn" data-toggle="dropdown">All category <span class="fa fa-angle-down"></span></button>
                                    
                                </div>
                                <button type="submit" class="btn btn-danger"><span class="fa fa-search"></span></button>
                            </form>
                            
                        </div>
                    </div>
                   <div>
                        <div class="col-md-3">
                            <div class="mega-container visible-lg visible-md">
                                <div class="navleft-container">
                                    <div class="mega-menu-title"><h3>Danh Mục Sách</h3></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                        <!-- nếu thằng nào có tool=giatri menu đó thì có thêm class="duoc_chon"-->
                            <ul class="menu clearfix visible-lg visible-md">
                                <li><a href="{{url('/')}}" @if($tool=="trangchu") class="duoc_chon" @endif><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                                <li><a href="#" @if($tool=="gioithieu") class="duoc_chon" @endif>Giới Thiệu</a></li>
                                <li><a href="{{route('lienhe')}}" @if($tool=="lienhe") class="duoc_chon" @endif>Liên Hệ</a></li>
                                <li ><a id="moiphathanh" href="{{route('sachmoi')}}" @if($tool=="sachmoi") class="duoc_chon" @endif>Sách Mới Phát Hành</a></li>
                                <li><a id="sachbanchay" href="{{route('sachbanchay')}}" @if($tool=="sachbanchay") class="duoc_chon" @endif>Sách Bán Chạy</a></li>
                                <li><a href="{{route('sachgiamgia')}}" @if($tool=="sachgiamgia") class="duoc_chon" @endif>Sách Giảm Giá</a></li>
                                
                            </ul>
                        </div>
                   </div>
                </div>
        </div>
        <div class="breadcrumbs">
            <div class="container">
                <ul class="breadcrumb" style="font-size:16px;">
                    <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                    <li class="active">404</li>
                </ul>
            </div>
       </div>
       <!--========= /.HEADER=========== --> 
       <!--======== MAIN (sử dung tempate là thay thế hết cái này luôn)========= -->
       <div class="main">
         <div class="row">
            <div class="col-sm-12">
                <div class="wrapper_404page">
                    <div class="col-sm-7" style="text-align:center">
                        <div class="content-404page" >
                            <p class="img-404"><img class="img-responsive" src="{{asset('public/site/images/404-img-text.png')}}" alt=""></p>
                            <p class="bottom-text">Trang này không tồn tại hoặc đã xảy ra một lỗi nào đó. Hãy nhân vào nút trở về trang chủ</p>
                            <div class="button-404">
                                <a href="{{url('/')}}" class="btn btn-link" title="BACK TO HOMEPAGE">Trở về trang chủ</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="img-right-404">
                            <img class="img-responsive" src="{{asset('public/site/images/404-image.png')}}" alt="">
                        </div>
                    </div>
                    <div style="clear:both; height:0px">&nbsp;</div>
                </div>
            </div>
          </div>
        </div>
       <!--======== MAIN ========= -->
        
        <!-- back to top-->
        <a id="yt-totop" href="#" title="Go to Top" style="display:block"></a>
        <!--======== FOOTER ========= -->
          @include('site.blocks.footer')
        <!--======== FOOTER ========= -->
        
        <script src="{{asset('public/site/js/bootstrap.min.js')}}"></script>
        
        <script src="{{asset('public/site/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('public/site/js/main.js')}}"></script>
        <script src="{{asset('public/site/js/tim_theo_danh_muc.js')}}"></script>
        <script src="{{asset('public/site/js/notify.js')}}"></script> 

        @yield('javascript')
        <script type="text/javascript">
        // sử dụng cho file top-category.blade.php khi click vào more category thì hiện ra các li con
        $(".xem-nhieu").click(function(){
               $(".nhieu-menu").slideToggle();
        });
        
        // bên header khi thu nhỏ màn hình lại
        
          $("#view_more_cate_mobile").click(function(){
                 $(".cate_more_mobi").slideToggle();
              // nếu có chuỗi More Category thì đổi tên
                if($("#view_more_cate_mobile").html()=='<i class="fa fa-chevron-circle-down" aria-hidden="true"></i> More Category'){
                 $("#view_more_cate_mobile").html('<i class="fa fa-chevron-circle-up" aria-hidden="true"></i> Close Category');
                }
               // nếu có ko chuỗi More Category thì đổi tên
                else
                {
                  $("#view_more_cate_mobile").html('<i class="fa fa-chevron-circle-down" aria-hidden="true"></i> More Category');
                }
          });
        
        
                 
        
      //========================giải quyết xung quang top-category=============
        if($("#co_more").length) // nếu có id co_more thì mới hiện More top cate
        {
          $("#more_top_cate").append('<a style="text-shadow:1px 1px 1px blue;font-weight:bold" id="view_more_top_cate" href="javascript:void(0)"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i> View More</a>');
        }
        // khi click vào id thì
        $("#view_more_top_cate").click(function(){
               $(".top_more").slideToggle();
            //   alert($("#view_more_top_cate").text());  // ra chữ view more
            //alert($("#view_more_top_cate").html()); // ra nội dung của thẻ a có thẻ i ...

               if($("#view_more_top_cate").html()=='<i class="fa fa-chevron-circle-down" aria-hidden="true"></i> View More')
               {
                 //alert("ok");
                  $("#view_more_top_cate").html('<i class="fa fa-chevron-circle-up" aria-hidden="true"></i> Close Category');
                  $(".bandau").slideToggle();
               }
              
               else
               {
                
                  $("#view_more_top_cate").html('<i class="fa fa-chevron-circle-down" aria-hidden="true"></i> View More');
                  $(".bandau").slideToggle();
                  $(".top_more").hide();
               }
              
        });
      //========================back to top=============
      // fade in #back-top
          jQuery(document).ready(function($){  
            $("#yt-totop").hide();
            $(function () {
                var wh = $(window).height();
                var whtml =  $(document).height();
                $(window).scroll(function () {
                    if ($(this).scrollTop() > whtml/10) {
                        $('#yt-totop').fadeIn();
                    } else {
                        $('#yt-totop').fadeOut();
                    }
                });
                $('#yt-totop').click(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });
            });
        });
</script>
   
  </body>
</html>
