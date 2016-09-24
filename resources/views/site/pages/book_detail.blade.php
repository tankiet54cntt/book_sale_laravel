@extends('site.master')
@section('title')
---{{$book_detail->title}}
@endsection
@section('css')
<link href="{{asset('public/site/css/jquery.bxslider.css')}}" rel="stylesheet">
<link href="{{asset('public/site/css/cloud-zoom.css')}}" rel="stylesheet">
<style type="text/css">
	.mega-menu-category{
		display: none;
	}
    .sach_moi:hover{
        opacity: 0.6;
    }
</style>
@endsection
@section('breadcrumbs')
<div class="breadcrumbs">
            <div class="container">
                <ul class="breadcrumb" style="font-size:16px;">
                    <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                    <?php 
                           $danhmuccha=App\Category::find($book_detail->category_id);
                     ?>
                     <li><a href="{{route('danhmuc',$danhmuccha->slug)}}.html">{{$danhmuccha->name}}</a></li>
                   
                    @if($danhmuccha->parent_id!=0)
                      <?php
                           $idcha=tim_id_parent($danhmuccha);
                           $danhmuccon=App\Category::find($idcha);
                       ?>
                        <li><a href="{{route('danhmuc',$danhmuccon->slug)}}.html">{{$danhmuccon->name}}</a></li>
                    @endif
                    <li class="active">{{$book_detail->title}}</li>
                </ul>
            </div>
</div><!-- /.breadcrumbs -->
@endsection
@section('content')
<div class="main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 col-right">
                      <!-- CHI TIẾT MỘT CUỐN SÁCH -->
                        <div class="product-view">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="product-img-box">
                                        <p class="product-image">
                                            <a href="{{route('chitietsach',$book_detail->slug)}}" class="cloud-zoom" id="ma-zoom1">
                                                <img class="sach_moi" width="240" height="500" src="{{asset('resources/upload/book/'.$book_detail->image)}}" alt="{{asset('resources/upload/book/'.$book_detail->image)}}" title="{{$book_detail->title}}" />
                                            </a>
                                        </p>
                                       
                                    </div>
                                </div>
                                <div class="product-shop col-sm-7">
                                    <div class="product-name">
                                        <h1 style="text-shadow:1px 1px 1px blue;font-weight:bold;">{{$book_detail->title}}</h1>
                                    </div>
                                   
                                    <div class="box-container2"> 
                                        <div class="price-box">
                                            <p class="special-price">
                                                <span class="price-label">Special Price</span>
                                            <span id="product-price-1" class="price">{!! number_format($book_detail->sale_price,0,",",".") !!}.đ</span>
                                            </p>
                                            @if($book_detail->sale_price < $book_detail->price)
                                            <p class="old-price">
                                                <span class="price-label">Regular Price:</span>
                                                <span id="old-price-1" class="price">{{number_format($book_detail->price,0,",",",")}}.đ</span>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="short-description">
                                        <div class="std">{{$book_detail->info}}...</div>
                                    </div>
                                    
                                    
                                        
                                       <button type="submit" class="btn btn-danger btn-cart yourcart" data-id="{{$book_detail->id}}" title="{{$book_detail->slug}}">Add to cart</button>
                                        <button type="button" class="btn btn-default btn-wishlist">Add to wishlist</button>
                                        <button type="button" class="btn btn-default btn-compare">Add to compare</button>
                                    
                                </div><!-- /.product-shop -->
                            </div>
                            <div class="product-tab tab-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#product-desc" data-toggle="tab">Giới Thiệu Sách</a></li>
                                    <li><a href="#product-review" data-toggle="tab">Thông Tin Chi Tiết</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="product-desc">
                                        {!! $book_detail->content !!}
                                    </div>
                                    <div class="tab-pane" id="product-review">...</div>
                                    
                                </div>
                            </div><!-- /.product-tab -->
                        </div>
                      <!-- /.CHI TIẾT MỘT CUỐN SÁCH -->
                      <!-- /.SÁCH CÙNG DANH MỤC -->
                       @if(count($sach_cung_danh_muc)>0)
                        <div class="featuredproductslider-container"> 
                            <div class="title-group1"><h2>SÁCH CÙNG DANH MỤC</h2></div>
                            <div id="featured-products" class="owl-container">
                                <div class="owl">
                                @foreach($sach_cung_danh_muc as $sach)
                                    <div class='productslider-item item'>
                                        <div class="item-inner">
                                            <div class="images-container">
                                                <div class="product_icon">
                                                    <div class='new-icon'><span>new</span></div>
                                                </div>
                                                <a href="{{route('chitietsach',$sach->slug)}}.html" title="Nunc facilisis" class="product-image">
                                                    <img width="100" height="250" src="{{asset('resources/upload/book/'.$sach->image) }}" alt="{{asset('resources/upload/book/'.$sach->image) }}" />
                                                </a>
                                                <div class="box-hover">
                                                    <ul class="add-to-links">
                                                        <li><a href="#" class="link-quickview">Quick View</a></li>
                                                        <li><a href="#" class="link-wishlist">Add to Wishlist</a></li>
                                                        <li><a href="#" class="link-compare">Add to Compare</a></li>
                                                        <li><a href="javascript:void(0)" class="link-cart yourcart" data-id="{{$sach->id}}" title="{{$sach->slug}}">Add to Cart</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="des-container">
                                                <h2 class="product-name"><a href="{{route('chitietsach',$sach->slug)}}.html" title="Nunc facilisis">
                                                    @if(strlen($sach->title)>28)
                                                        {!! str_limit($sach->title,28,'...') !!}
                                                    @else
                                                        {{$sach->title}}
                                                    @endif
                                                </a></h2>
                                                <div class="price-box">
                                                    <p class="special-price">
                                                        <span class="price-label">Special Price</span>
                                                        <span class="price">{!! number_format($sach->sale_price,0,",",".") !!}.đ</span>
                                                    </p>
                                                    @if($sach->sale_price < $sach->price)
                                                    <p class="old-price">
                                                        <span class="price-label">Regular Price: </span>
                                                        <span class="price">{{number_format($sach->price,0,",",",")}}.đ</span>
                                                    </p>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div><!-- /.featuredproductslider-container -->
                       
                       @endif
                      <!-- /.SÁCH CÙNG DANH MỤC -->
                    </div><!-- /.col-right -->

                <!--===============SÁCH MỚI BÊN PHẢI=================-->
                    <div class="col-sm-3 col-left">
                        <div class="block">
                            <div class="title-group"><h2><a style="text-shadow:1px 1px 1px green;" href="{{route('sachmoi')}}">Sách mới</a></h2></div>
                            <div id="special-offer" class="owl-container">
                                <div class="owl">
                                  
                                    <div class='sepecialoffer-item item'>
                                    @foreach($sach_moi as $key=>$sach)
                                       @if($key<4)
                                        <div class="item-inner first">
                                            <div class="images-container">
                                                <a href="{{route('chitietsach',$sach->slug)}}.html" title="Primis in faucibus" class="product-image">
                                                    <img class="sach_moi" width="100" height="130" src="{{asset('resources/upload/book/'.$sach->image)}}" alt="{{asset('resources/upload/book/'.$sach->image)}}" />
                                                </a>
                                            </div>
                                            <div class="des-container">
                                                <h2 class="product-name"><a href="{{route('chitietsach',$sach->slug)}}.html" title="{{ $sach->title}}">
                                                    @if(strlen($sach->title)>28)
                                                        {!! substr($sach->title,0,28) !!}...
                                                    @else
                                                        {{$sach->title}}
                                                    @endif
                                                </a></h2>
                                                <div class="price-box">
                                                    <p class="special-price">
                                                        <span class="price">{!! number_format($sach->sale_price,0,",",".") !!}.đ</span>
                                                    </p>
                                                    @if($sach->sale_price < $sach->price)
                                                    <p class="old-price">
                                                        <span class="price">{{number_format($sach->price,0,",",",")}}.đ</span>
                                                    </p>
                                                     @endif
                                                </div>
                                               
                                            </div>
                                        </div>
                                       @else
                                        <?php break;?>
                                       @endif
                                     @endforeach                             
                                    </div>
                                   
                                </div>
                            </div><!-- /.owl-container -->
                        </div><!-- /.block - Special offer -->
                        <div class="block block-list">
                            <div class="block-title">
                                <strong><span>Compare</span></strong>
                            </div>
                            <div class="block-content">
                                <p class="empty">You have no items to compare.</p>
                            </div>
                        </div><!-- /.compare -->
                        <div class="banner-left"><a href="#"><img src="{{asset('public/site/images/ads/ads-01.jpg')}}" alt=""></a>
                            <div class="banner-content">
                                <h1>sale up to</h1>
                                <h2>20% off</h2>
                                <p>on selected products</p>
                                <a href="#">buy now</a>
                            </div>
                        </div><!-- /.banner-left -->
                    </div><!-- /.col-left -->
                <!--===============SÁCH MỚI BÊN PHẢI=================-->
                 <!--===============COMENT======================-->
                        @include('site.blocks.comment')
                 <!--===============COMENT======================-->
                </div>
            </div>
</div><!-- /.main -->
@endsection
@section('javascript')
<script src="{{asset('public/site/js/jquery.bxslider.min.js')}}"></script>
<script src="{{asset('public/site/js/cloud-zoom.js')}}"></script>
<script src="{{asset('public/site/js/comment.js')}}"></script>
<script type="text/javascript">
            $(document).ready(function(){
                
                /* featured-products slider */
                $("#featured-products .owl").owlCarousel({
                    autoPlay : false,
                    items : 4,
                    itemsDesktop : [1199,3],
                    itemsDesktopSmall : [991,2],
                    itemsTablet: [767,2],
                    itemsMobile : [480,1],
                    slideSpeed : 3000,
                    paginationSpeed : 3000,
                    rewindSpeed : 3000,
                    navigation : true,
                    stopOnHover : true,
                    pagination : false,
                    scrollPerPage:true,
                });
                
            });
</script>
@endsection