@extends('site.master')
@section('title')
---Danh Mục --- {{$cate->name}}
@endsection
@section('css')
<link href="{{asset('public/site/css/jquery-ui.css')}}" rel="stylesheet">
<style type="text/css">
	.mega-menu-category{
		display: none;
	}
    .sach_moi:hover{
        opacity: 0.6;
    }
    .active_cate{
        color:red;
    }
    /*Hiệu ứng khi click load sang trang mới*/
#img_loading{
         /* cho ảnh về đầu */
       /*  position:absolute; /*sử dụng thuộc tính này nó sẽ đề lên ảnh hoặc div hiện tại----firefox bị lỗi nên thôi*/
       /*  z-index: 999;*/
         /* cho ảnh về đầu */
         /*làm mờ ảnh và ko cho hiện background nền*/
           opacity:.85; /*hiệu ứng làm mờ*/
           width: 100%; 
        /*filter: alpha(opacity=85);*/ 
        margin:0 auto; /*do ta muốn nó về chính giữa của div đo*/
        /*padding:10px;*/ 
        /*text-align:left;*/ 
       display: none;
    }
</style>
@endsection
@section('breadcrumbs')
<div class="breadcrumbs">
            <div class="container">
                <ul class="breadcrumb" style="font-size:16px;">
                        <li><a href="{{url('/')}}">Home</a></li>
                    @if($cate->parent_id!=0)
                     <?php $idcha=tim_id_parent($cate);
                           $danhmuc=App\Category::find($idcha);
                     ?>
                        <li><a href="{{route('danhmuc',$danhmuc->slug)}}.html">{{$danhmuc->name}}</a></li>
                    @endif
                        <li class="active">{{$cate->name}}</li>
                </ul>
            </div>
</div>
@endsection
@section('content')
<div class="main">
            <div class="container">
                <div class="row">
                <!-- ============CÁC MỤC BÊN TRÁI ================-->
                    <div class="col-sm-3 col-left">
                         <!-- SORT BY -->
                        <div class="block block-layered-nav">
                            <div class="block-title">
                                <strong><span>Sort By</span></strong>
                            </div>
                            <div class="block-content">
                                <p class="block-subtitle">Shopping Options</p>
                                <div id="narrow-by-list">
                                    <div class="layered layered-Category">
                                      
                                        <div class="content-shopby">
                                            <ol>
                                             
                                              <?php

                                                $cate_left=App\Category::select('id','name','slug','parent_id')->get()->toArray();
                                            
                                            ?>
                                              @foreach($cate_left as $item)
                                                @if($item["id"]==$id_parent)
                                                    <li><a href="{{url('danh-muc/'.$item['slug'])}}.html" style="font-size:16px;font-weight:bold">{{$item["name"]}} </a>
                                                        <?php sub_menu_cap_n($cate_left,$item["id"],$cate->id); ?>
                                                    </li>
                                                @endif
                                            @endforeach
                                            </ol>
                                        </div>
                                    </div>
                                
                                    <!-- HIỂN THỊ DANH SÁCH TÁC GIẢ-->
                                    <div class="layered layered-Manufacturer">
                                        <h2>TÁC GIẢ</h2>
                                        <?php $tacgia=App\Writer::Orderby('id','DESC')->inRandomOrder()->get(); ?>
                                        <div class="content-shopby">
                                            <ol>
                                              @foreach($tacgia as $key=>$tg)
                                               @if($key<=15)
                                                <li><a href="#">{{$tg->name}}</a></li>
                                               @else
                                                <li><a href="#" style="color:green;">Xem Tất Cả</a>
                                                </li>
                                                <?php break;?>
                                               @endif
                                              @endforeach 
                                            </ol>
                                        </div>
                                    </div>
                                 <!-- HIỂN THỊ DANH SÁCH TÁC GIẢ-->    
                                </div>
                            </div>
                        </div>
                        <!-- /SORT BY -->
                     @if(count($danh_muc_sach)>=10)   
                        <!-- DANH SÁCH CÁC CUỐN SÁCH ĐƯỢC GIẢM GIÁ -->
                        @include('site.blocks.left_giam-gia')
                        <!-- DANH SÁCH CÁC CUỐN SÁCH ĐƯỢC GIẢM GIÁ -->
                     @endif
                    </div><!-- /.col-left -->
                <!-- ============CÁC MỤC BÊN TRÁI ================-->
                    <div class="col-sm-9 col-right">
                        <div class="page-title">
                            <h1>SÁCH {{ $cate->name}}</h1>
                        </div>
                        <div class="toolbar">
                            <div class="sorter">
                                <p class="view-mode">
                                    <label>View as:</label>
                                    <strong class="grid" title="Grid">Grid</strong>&nbsp;
                                    <a class="list" show="{{count($danh_muc_sach)}}" danhmuc="{{$cate->slug}}.html" title="Hiển thị all Book thuộc danh mục {{ $cate->name}}" href="javascript:void(0)">Hiển thị all Book thuộc danh mục {{ $cate->name}}</a>&nbsp;
                                </p>
                            </div><!-- /.sorter -->
                            <?php
                                $show=isset($_GET["show"]) ? $_GET["show"] : 20;
                                if(count($danh_muc_sach)>20){
                            ?>
                            <div class="pager">
                                
                                <div class="limiter hidden-xs">

                                    <label>Show:</label>
                                    <div class="limiter-inner">
                                      
                                        <select danhmuc="{{$cate->slug}}.html" id="select_paginate" class="form-control input-sm">
                                           <?php $array=array(20,40,60,80,100);sort($array); ?>
                                           @for($i=0;$i<count($array);$i++)
                                            <option @if($array[$i]==$show) selected="selected" @endif>{{$array[$i]}}</option>
                                           @endfor
                                        </select> 
                                    
                                    </div>
                                </div>
                            </div><!--- /.pager -->
                          <?php } ?>
                        </div><!-- /.toolbar -->
                        <div class="row products" id="spmoi">
                         <img id="img_loading" src="{{url('public/site/images/Loading_icon.gif')}}">
                         @foreach($danh_muc_sach as $key=>$sach)
                           @if($key<$show)
                            <div class="col-md-3 col-sm-6" >
                                <div class='productslider-item item'>
                                    <div class="item-inner">
                                        <div class="images-container">
                                          
                                            <div class="product_icon">
                                                <div class='sale-icon'><span>-{{round(($sach['price']-$sach['sale_price'])*100/($sach['price']))}}%</span></div>
                                            </div>
                                          
                                            <a href="{{route('chitietsach',$sach['slug'])}}.html" title="{{$sach['title']}}" class="product-image">
                                                <img class="sach_moi" width="100" height="250" src="{{asset('resources/upload/book/'.$sach['image'])}}" alt="{{asset('resources/upload/book/'.$sach['image'])}}" />
                                            </a>
                                            <div class="box-hover">
                                                <ul class="add-to-links">
                                                    <li><a href="#" class="link-quickview">Quick View</a></li>
                                                    <li><a href="#" class="link-wishlist">Add to Wishlist</a></li>
                                                    <li><a href="#" class="link-compare">Add to Compare</a></li>
                                                    <li><a href="javascript:void(0)" class="link-cart yourcart" data-id="{{$sach['id']}}" title="{{$sach['slug']}}">Add to Cart</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="des-container">
                                            <h2 class="product-name"><a href="{{route('chitietsach',$sach['slug'])}}.html" title="{{$sach['title']}}">
                                                @if(strlen($sach["title"])>20)
                                                     {!!mb_substr($sach["title"],0,20,'UTF-8')!!}...
                                                    @else
                                                        {{$sach["title"]}}
                                                    @endif
                                            </a></h2>
                                            <div class="price-box">
                                                <p class="special-price">
                                                    <span class="price-label">Special Price</span>
                                                    <span class="price">{!! number_format($sach["sale_price"],0,",",".") !!}.đ</span>
                                                </p>
                                                @if($sach["sale_price"] < $sach["price"])
                                                    <p class="old-price">
                                                        <span class="price-label">Regular Price: </span>
                                                        <span class="price">{{number_format($sach["price"],0,",",",")}}.đ</span>
                                                    </p>
                                                @endif
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                           @else
                             <?php $break; ?>
                           @endif
                         @endforeach  
                        </div><!-- /.product -->
                        
                    </div><!-- /.col-right -->
                </div>
            </div>
</div><!-- /.main -->
@endsection
@section('javascript')
<script type="text/javascript">
            $(document).ready(function(){ 
                
                //=========================XỬ LÝ PHÂN TRANG==============
                $("#select_paginate").change(function(){
                      // alert($( "#select_paginate option:selected" ).val()); // lấy ra giá trị 
                      var danhmuc=$(this).attr('danhmuc');
                      var show=parseInt($( "#select_paginate option:selected" ).val());
                     // alert(lay_gia_tri_page_tren_url("show"));
                     var url=base_url+"danh-muc/"+danhmuc;
                     $('#img_loading').fadeIn('fast');  // hiện ảnh xong ẩn
                     $("#spmoi").load(url+"?show="+show+" #spmoi"); // nghĩa là ta chỉ load lại nội dung các sản phẩm ở trang số đó thôi ko load hết cả trang
                  });
               // hiển thị ra tất cả cuốn sách khi click vào list
               //$(".list").click(function(){
                $(document).on('click','.list', function(){
                    var danhmuc=$(this).attr('danhmuc');
                    var show=$(this).attr('show');
                    var url=base_url+"danh-muc/"+danhmuc;
                    $('#img_loading').fadeIn('fast');  // hiện ảnh xong ẩn
                     $("#spmoi").load(url+"?show="+show+" #spmoi");
               });
            });
</script>
@endsection