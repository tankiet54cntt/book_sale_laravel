<!--
    ADMIN THÌ CÓ TẤT CẢ CÁC QUYỀN
    MEMBER THÌ VÀO TRANG VIẾT BÀI
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="Vu Quoc Tuan">
    <link rel="shortcut icon" href="{{asset('public/logo.png') }}">
    <title>Trang Quản Trị - Admin @yield('title')</title>
     <!-- tạo chữ chạy cho thanh title -->
     <!--
     <script>
            var txt="Chào mừng bạn đến Web Quảng trị tin tức 24h ";
            var espera=200;
            var refresco=null;
            function rotulo_title() {
            document.title=txt;
            txt=txt.substring(1,txt.length)+txt.charAt(0);
            refresco=setTimeout("rotulo_title()",espera);
            }
            rotulo_title();
    </script>
    -->
    <!-- tạo chữ chạy cho thanh title -->
    <!-- Bootstrap Core CSS -->
    <link href="{{ url('public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ url('public/admin/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('public/admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('public/admin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="{{ url('public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ url('public/admin/bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
    <!-- script xác nhận xóa-->
    <script type="text/javascript">
        function xacnhanxoa(msg) {
            if (window.confirm(msg)) {
                return true;
            }
            return false;
        }
    </script>
    <!-- vì nhúng ckeditor nên bỏ ở trong thẻ head nếu bỏ ở dưới thì nó ko chạy-->
    <script src="{{ url('public/admin/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('public/admin/js/ckfinder/ckfinder.js') }}"></script>
    <script type="text/javascript">
            var baseURL="{!! url('/') !!}";
    </script>
    <script src="{{ url('public/admin/js/func_ckfinder.js') }}"></script>
    <!-- vì nhúng ckeditor nên bỏ ở trong thẻ head nếu bỏ ở dưới thì nó ko chạy-->
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('admin') }}">Admin Area - Tấn Kiệt</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <!--
                @if(isset($user_login))
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                     
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>{{$user_login->name}} <!--biến user_login ta định nghĩa trong Controller rồi do ta sử dụng view()->share nên nó sử dụng được /// lưu ý cái nào ko có controller định nghĩa thì quy định là chưa đăng nhập (cách làm này thấy ko có hay)
                        Auth::user()->name //sử dụng cái này cũng được </a>
                        </li>
                        <li><a href="{{ route('admin.user.edit',$user_login->id) }}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ route('dangxuat_admin')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                     
                    </ul>
                </li>
            @endif
                -->
            @if(Auth::user())  <!-- nếu như đã đăng nhập -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> {{Auth::user()->lastname}} <i class="fa fa-caret-down"></i> 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                     
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>{{ Auth::user()->username}}</a>
                        </li>
                        <li><a href="{{ route('users.edit',Auth::user()->id)}}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ route('dangxuat_admin')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                     
                    </ul>
                </li>
            @endif
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{ url('/')}}" target="_blank" ><i class="fa fa-home" aria-hidden="true"></i> Trang Chủ Web bán sách</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-spinner" aria-hidden="true"></i> Thông Tin Sản Phẩm</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Danh Mục<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('categories.index') }}">List Danh Mục</a>
                                </li>
                                <li>
                                    <a href="{{route('categories.create') }}">Add Danh Mục</a> <!-- sử dụng url hoặc route đều như nhau-->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Tác Giả<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('writers.index') }}">List Tác Giả</a>
                                </li>
                                <li>
                                    <a href="{{route('writers.create') }}">Add Tác Giả</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-book" aria-hidden="true"></i> Nhóm User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('groups.index')}}">List Nhóm</a>
                                </li>
                                <li>
                                    <a href="{{ route('groups.create')}}">Add Nhóm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-book" aria-hidden="true"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('users.index')}}">List User</a>
                                </li>
                                <li>
                                    <a href="{{ route('users.create')}}">Add User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sliders" aria-hidden="true"></i> Sách<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('books.index')}}">List Sách</a>
                                </li>
                                <li>
                                    <a href="{{ route('books.create')}}">Add Sách</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-comments" aria-hidden="true"></i> Comment<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">List Comment</a>
                                </li>
                                <li>
                                    <a href="#">Add Comment</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">List User</a>
                                </li>
                                <li>
                                    <a href="#">Add User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">@yield('name_table')
                            <small>@yield('method')</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <!-- tạo thông báo nhỏ khi thêm thành công or sửa or xóa (thành công hoặc thất bại)-->
                    <div class="col-lg-12">
                        @if(Session::has('flash_message')) <!-- nếu tồn tại một cái biến session nào đó được định nghĩa ở controller  -->
                            <div class="alert alert-{!! Session::get('flash_level') !!}"> <!-- hiển thị lớp -->
                                {!! Session::get('flash_message')!!} <!-- hiển thị giá trị của session đó  -->
                            </div>
                        @endif
                    </div>
                   <!-- Đây là nơi chứa nội dung-->
                        @yield('content')
                    <!-- Đây là nơi chứa nội dung-->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{ url('public/admin/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ url('public/admin/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ url('public/admin/dist/js/sb-admin-2.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{ url('public/admin/bower_components/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <!-- tự tạo 1 file javascript-->
    <script src="{{ url('public/admin/js/myscript_define.js') }}"></script>
    <!-- Tạo 1 file javascript tự định nghĩa-->
            @yield('script')
</body>

</html>
