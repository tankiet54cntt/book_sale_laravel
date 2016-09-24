<!-- -->
<style type="text/css">
    .duoc_chon{
        color:blue !important;
        text-shadow: 1px 1px solid black;      
    }
    .duoc_chon:hover{
        color:green !important;       
    }
</style>
<!-- -->
<div class="header">
       <!-- chỉ hiển thị khi click vào thêm giỏ hàng -->
         <div class="notifyjs-corner add_cart" style="top: 0px; right: 0px;display:none;">
            <div class="notifyjs-container">
              <div class="notifyjs-bootstrap-base notifyjs-bootstrap-success">
               <span  class="addtext" data-notify-text="">Sách đã được thêm vào giỏ hàng</span> <!-- khoảng trắng này sẽ hiện thị khi thêm hoặc xóa-->
              </div>
            </div>
          </div>
        <!-- chỉ hiển thị khi click vào thêm giỏ hàng -->
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
                                    <ul class="dropdown-menu dropdown-menu-right">
                                       @foreach($category as $danhmuccha)
                                        @if($danhmuccha->parent_id==0)
                                        <li><a href="javascript:void(0)" class="danh_muc_cha">{{$danhmuccha->name}}</a></li>
                                        @endif
                                       @endforeach
                                    </ul>
                                </div>
                                <button type="submit" class="btn btn-danger"><span class="fa fa-search"></span></button>
                            </form>
                            <div class="mini-cart">
                                @include('site.blocks.gio_hang')
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @include('site.blocks.menu')
                    </div>
                </div>
            <!-- =============XỬ LÝ KHI GIAO DIỆN ĐIỆN THOẠI TOOGLE========= -->
                <nav class="navbar navbar-primary navbar-static-top hidden-lg hidden-md">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <h2 class="navbar-brand visible-xs">Danh Mục Sách</h2>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="{{url('/')}}" @if($tool=="trangchu") class="duoc_chon" @endif><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                                <li><a href="" @if($tool=="gioithieu") class="duoc_chon" @endif>Giới Thiệu</a></li>
                                <li><a href="" @if($tool=="lienhe") class="duoc_chon" @endif>Liên Hệ</a></li>
                                <li ><a id="moiphathanh" href="{{route('sachmoi')}}" @if($tool=="sachmoi") class="duoc_chon" @endif>Sách Mới Phát Hành</a></li>
                                <li><a id="sachbanchay" href="{{route('sachbanchay')}}" @if($tool=="sachbanchay") class="duoc_chon" @endif>Sách Bán Chạy</a></li>
                                <li><a href="{{route('sachgiamgia')}}" @if($tool=="sachgiamgia") class="duoc_chon" @endif>Sách Giảm Giá</a></li>
                                <?php $dem=1;?>
                                  @foreach($category as $cate) <!-- category ở view share-->
                                  
                                   @if($cate->parent_id==0)
                                   <?php 
                                        // hàm này in ra để đề phòng danh mục sách ko có thư mục con
                                            $dem_cate_con=App\Category::where('parent_id',$cate["id"])->get();
                                   ?>
                                    @if($dem<=8)
                                     <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{$cate->name}} @if(count($dem_cate_con)>0)<span class="fa fa-angle-down"></span>@endif</a>
                     
                                        @if(count($dem_cate_con)>0) <!-- chỉ in ra danh mục nào có thư mục con còn ko có thì ko in-->
                                            <ul class="dropdown-menu">
                                              @foreach($dem_cate_con as $cate_con)
                                                <li><a href="#">{{ $cate_con->name }}</a></li>
                                              @endforeach 
                                            </ul>
                                        @endif <!-- chỉ in ra danh mục nào có thư mục con còn ko có thì ko in-->
                                       <?php $dem++;?>
                                     </li>
                                     @else
                                      <li style="display:none;" class="dropdown cate_more_mobi">
                                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{$cate->name}} <span class="fa fa-angle-down"></span></a>
                                       @if(count($dem_cate_con)>0) <!-- chỉ in ra danh mục nào có thư mục con còn ko có thì ko in-->
                                            <ul class="dropdown-menu">
                                               @foreach($dem_cate_con as $cate_con)
                                                <li><a href="#">{{$cate_con->name}}</a></li>
                                               @endforeach 
                                            </ul>
                                        @endif <!-- chỉ in ra danh mục nào có thư mục con còn ko có thì ko in-->
                                       <?php $dem++;?>
                                       </li>
                                     @endif
                                   @endif

                                  @endforeach
                                
                                @if($dem>9)
                                <li><a style="text-shadow:0.8px 5px 5px green" id="view_more_cate_mobile" href="javascript:void(0)"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i> More Category</a></li>
                                @endif
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container -->
                </nav>
            </div>
           <!-- /.header-bottom -->
        </div>
</script>