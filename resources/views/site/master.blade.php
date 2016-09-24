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
    <script type="text/javascript"> var base_url = "http://book-sale.esy.es/";</script>
    <script src="{{asset('public/site/js/cart.js')}}"></script> 
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('css')
  </head>
  <body>
      <!--======== HEADER ========= -->
        @include('site.blocks.header')
        @yield('breadcrumbs')  <!-- dành cho cate,detail,.. trừ index-->
       <!--========= /.HEADER=========== --> 
       <!--======== MAIN (sử dung tempate là thay thế hết cái này luôn)========= -->
        @yield('content')
       <!--======== MAIN ========= -->
       <!-- /.========TOP CATEGORIES======== -->
         @include('site.blocks.top_category')
        <!-- ========/.TOP CATEGORIES ========-->
        <!-- back to top-->
        <a id="yt-totop" href="#" title="Go to Top" style="display:block"></a>
        <!--======== FOOTER ========= -->
          @include('site.blocks.footer')
        <!--======== FOOTER ========= -->
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <script src="{{asset('public/site/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('public/site/js/main.js')}}"></script>
        <script src="{{asset('public/site/js/tim_theo_danh_muc.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script> 

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
