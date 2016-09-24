@extends('site.master')
@section('title')
--- Trang Chủ
@endsection
@section('css')
<link href="{{asset('public/site/css/nivo-slider.css')}}" rel="stylesheet">
<style type="text/css">
    .sach_moi:hover{
        opacity: 0.6;
    }
</style>
@endsection
@section('content')

<div class="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-md-offset-3">
                        <!-- /.flexslider SLIDER-->
                        @include('site.blocks.slider')
                        <!-- /.flexslider SLDIER-->
                    </div>
                </div>
                <!-- CONTENT  -->
                <div class="row">
                  <!-- CÁC DANH MỤC BÊN TAY TRÁI TRANG WEB -->
                   
                  <!-- CÁC DANH MỤC BÊN TAY TRÁI TRANG WEB -->
                  <!-- CÁC DANH MỤC BÊN TAY PHẢI TRANG WEB -->
                    <div class="col-sm-12">
                      <!-- /.featuredproductslider-container SÁCH MỚI NHẤT-->
                        <div class="featuredproductslider-container"> 
                            <div class="title-group1"><h2><a href="{{route('sachmoi')}}">Sách Mới</a></h2></div>
                            <div id="featured-products" class="owl-container">
                                <div class="owl">
                                <!--hiện ra 4 cuốn sách mới nhất (trong 20 cuốn nếu muốn xem 4 cuốn tiếp theo thì click nút > và ngược lại <)  biến sach_moi lấy ở hàm function trong pagescontroller sử dụng view share-->
                                 @foreach($sach_moi as $sach)
                                    <div class='productslider-item item' style="height:450px;">
                                        <div class="item-inner">
                                            <div class="images-container">
                                                <div class="product_icon">
                                                    <div class='new-icon'><span>new</span></div>
                                                     @if(($sach->sale_price+55000)<=$sach->price)
                                                    <div class="coupons_banchay-icon"><span>-{{round(($sach->price-$sach->sale_price)*100/($sach->price))}}%</span></div>
                                                    @endif
                                                </div>
                                                <a href="{{route('chitietsach',$sach->slug)}}.html" title="{{$sach->title}}" class="product-image">
                                                    <img class="sach_moi" width="100" height="350" src="{{asset('resources/upload/book/'.$sach->image)}}" alt="{{asset('resources/upload/book/'.$sach->image)}}" />
                                                </a>
                                                <div class="box-hover">
                                                    <ul class="add-to-links">
                                                        <li><a href="#" class="link-quickview">Quick View</a></li>
                                                        <li><a href="" class="link-wishlist">Add to Wishlist</a></li>
                                                        <li><a href="#" class="link-compare">Add to Compare</a></li>
                                                      <!--
                                                        <li><a href="{{route('muahang',[$sach->id,$sach->slug])}}.html" class="link-cart">Add to Cart</a></li> -->
                                                        <li><a href="javascript:void(0)" class="link-cart yourcart" data-id="{{$sach->id}}" title="{{$sach->slug}}">Add to Cart</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="des-container">
                                                <h2 class="product-name">
                                                <a href="{{route('chitietsach',$sach->slug)}}.html" title="{{$sach->title}}">
                                                <!-- dùng hàm mb_substr để cắt chuỗi tránh lỗi font tiếng việt-->
                                                    @if(strlen($sach->title)>28)
                                                    {!!mb_substr($sach->title,0,28,'UTF-8')!!}...
                                                    @else
                                                        {{$sach->title}}
                                                    @endif
                                                </a>
                                                </h2>
                                                <div class="price-box" style="text-align:center">
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
                                <!--hiện ra 4 cuốn sách mới nhất -->   
                                </div>
                            </div>
                        </div><!-- /.featuredproductslider-container -->
                      <!-- /.featuredproductslider-container SÁCH MỚI NHẤT-->
                       <div class="newproductslider-container"> 
                            <div class="title-group1"><h2>Sách Giảm Giá</h2></div>
                            <div id="new-products" class="owl-container">
                                <div class="owl">
                                @foreach($sachgiamgia as $sach)
                                    <div class='productslider-item item' style="height:450px;">
                                        <div class="item-inner">
                                            <div class="images-container">
                                                <div class="product_icon">
                                                <div class='new-icon'><span>sale</span></div>
                                                 
                                                    <div class="coupons_banchay-icon"><span>-{{round(($sach->price-$sach->sale_price)*100/($sach->price))}}%</span></div>
                                                
                                                </div>
                                                <a href="{{route('chitietsach',$sach->slug)}}.html" title="{{$sach->title}}" class="product-image">
                                                    <img class="sach_moi" width="100" height="350" src="{{asset('resources/upload/book/'.$sach->image)}}" alt="{{asset('resources/upload/book/'.$sach->image)}}" />
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
                                                <h2 class="product-name"><a href="{{route('chitietsach',$sach->slug)}}.html" title="{{$sach->title}}">
                                                @if(strlen($sach->title)>28)                                                  
                                                    {!!mb_substr($sach->title,0,28,'UTF-8')!!}...
                                                @else
                                                        {{$sach->title}}
                                                @endif
                                                </a></h2>
                                                <div class="price-box" style="text-align:center">
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
                        </div><!-- /.newproductslider-container --> 
                        <div class="newproductslider-container"> 
                            <div class="title-group1"><h2>Sách Bán Chạy</h2></div>
                            <div id="new-products" class="owl-container">
                                <div class="owl">
                                @foreach($sachbanchay as $sach)
                                    <div class='productslider-item item' style="height:450px;">
                                        <div class="item-inner">
                                            <div class="images-container">
                                                <div class="product_icon">
                                                <div class='new-icon'><span>new</span></div>
                                                 @if(($sach->sale_price+15000)<=$sach->price)
                                                    <div class="coupons_banchay-icon"><span>-{{round(($sach->price-$sach->sale_price)*100/($sach->price))}}%</span></div>
                                                 @else
                                                   <div class='sale-icon'><span>sale</span></div>
                                                 @endif
                                                </div>
                                                <a href="{{route('chitietsach',$sach->slug)}}.html" title="{{$sach->title}}" class="product-image">
                                                    <img class="sach_moi" width="100" height="350" src="{{asset('resources/upload/book/'.$sach->image)}}" alt="{{asset('resources/upload/book/'.$sach->image)}}" />
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
                                                <h2 class="product-name" ><a href="{{route('chitietsach',$sach->slug)}}.html" title="{{$sach->title}}">
                                                 
                                                    @if(strlen($sach->title)>28)
                                                      {!!mb_substr($sach->title,0,28,'UTF-8')!!}...
                                                    @else
                                                        {{$sach->title}}
                                                    @endif
                                                
                                                </a></h2>
                                                <div class="price-box" style="text-align:center">
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
                        </div><!-- /.newproductslider-container -->
                        
                        <div class="row">
                          <!-- SÁCH LẤY NGẪU NHIÊN -->
                            <div class="col-sm-4">
                                <div class="title-group"><h2>Random</h2></div>
                                <div class="product-list">
                         <!-- HIỂN THỊ RA 3 SÁCH NGẪU NHIÊN TIẾP THEO TRONG 8 CUỐN NGẪU NHIÊN-->
                                @foreach($sachngaunhien as $key=>$sach_random)
                                    <div class="products-grid">
                                        <div class="images-container">
                                        <div class="product_icon">
                                                    <div class='coupons-icon'><span>-{{round(($sach_random->price-$sach_random->sale_price)*100/($sach_random->price))}}%</span></div>
                                        </div>
                                            <a class="product-image" title="{{$sach_random->title}}" href="{{route('chitietsach',$sach_random->slug)}}.html"><img class="sach_moi" width="70" height="150" alt="{{asset('resources/upload/book/'.$sach_random->image)}}" src="{{asset('resources/upload/book/'.$sach_random->image)}}"></a>
                                        </div>
                                        <div class="des-container">
                                            <h2 class="product-name"><a title="{{$sach_random->title}}" href="{{route('chitietsach',$sach_random->slug)}}.html" style="color:green;font-size:14px">
                                                @if(strlen($sach_random->title)>40)
                                                      {!!mb_substr($sach_random->title,0,40,'UTF-8')!!}...
                                                @else
                                                        {{$sach_random->title}}
                                                @endif
                                            </a></h2>
                                            
                                            <div class="price-box">
                                                <p class="special-price">
                                                    <span class="price">{!! number_format($sach_random->sale_price,0,",",".") !!}.đ</span>
                                                </p>
                                                @if($sach_random->sale_price < $sach_random->price)
                                                <p class="old-price">
                                                    <span class="price">{!! number_format($sach_random->price,0,",",".") !!}.đ</span>
                                                </p>
                                                @endif
                                            </div><br>
                                            
                                            <a href="javascript:void(0)" class="btn-link yourcart" data-id="{{$sach_random->id}}" title="{{$sach_random->slug}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</a>
                                           
                                        </div>
                                    </div>
                                  
                                @endforeach  
                        <!-- HIỂN THỊ RA 3 SÁCH NGẪU NHIÊN TIẾP THEO TRONG 8 CUỐN NGẪU NHIÊN-->
                                </div><!-- /.product-list -->
                            </div>
                          <!-- SÁCH LẤY NGẪU NHIÊN -->
                          <!-- SÁCH BÀNG NHIỀU NHẤT (ĐẶT HÀNG NHIỀU NHất) -->
                            <div class="col-sm-4">
                                <div class="title-group"><h2>BestReduce</h2></div>
                                <div class="product-list">
                                <?php $dem=1;?>
                                @foreach($sachgiamgia as $key=>$sach_gg)
                                  @if(($sach_gg->sale_price+15000)<=$sach_gg->price)
                                   @if($dem<=3)
                                    <div class="products-grid">
                                        <div class="images-container">
                                            <div class="product_icon">
                                                    <div class='coupons-icon'><span>-{{round(($sach_gg->price-$sach_gg->sale_price)*100/($sach_gg->price))}}%</span></div>
                                                </div>
                                            <a class="product-image" title="{{$sach_gg->title}}" href="{{route('chitietsach',$sach_gg->slug)}}.html"><img class="sach_moi" width="70" height="150" alt="{{asset('resources/upload/book/'.$sach_gg->image)}}" src="{{asset('resources/upload/book/'.$sach_gg->image)}}"></a>
                                        </div>
                                        <div class="des-container">
                                            <h2 class="product-name"><a title="{{$sach_gg->title}}" href="{{route('chitietsach',$sach_gg->slug)}}.html" style="color:green;font-size:14px">
                                                @if(strlen($sach_gg->title)>40)
                                                      {!!mb_substr($sach_gg->title,0,40,'UTF-8')!!}...
                                                    @else
                                                        {{$sach_gg->title}}
                                                    @endif
                                            </a></h2>
                                            
                                            <div class="price-box">
                                                <p class="special-price">
                                                    <span class="price">{!! number_format($sach_gg->sale_price,0,",",".") !!}.đ</span>
                                                </p>
                                                @if($sach_gg->sale_price < $sach_gg->price)
                                                <p class="old-price">
                                                    <span class="price">{!! number_format($sach_gg->price,0,",",".") !!}.đ</span>
                                                </p>
                                                @endif
                                            </div>
                                            <br>
                                            
                                            <a href="javascript:void(0)" class="btn-link yourcart" data-id="{{$sach_gg->id}}" title="{{$sach_gg->slug}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</a>
                                           
                                        </div>
                                    </div>
                                    <?php $dem++;?>
                                   @endif
                                  @endif
                                @endforeach  
                                </div><!-- /.product-list -->
                            </div>
                          <!-- SÁCH BÀNG NHIỀU NHẤT (ĐẶT HÀNG NHIỀU NHất) -->
                          <!-- SÁCH HOT SALE -->
                            <div class="col-sm-4">
                                <div class="title-group"><h2>Hot sale</h2></div>
                                <div class="product-list">
                                     
                                 @foreach($sachhot as $key=>$sach_hotsale)
                                    
                                    <div class="products-grid">
                                        <div class="images-container">
                                            <div class="product_icon">
                                                    <div class='coupons-icon'><span>-{{round(($sach_random->price-$sach_random->sale_price)*100/($sach_random->price))}}%</span></div>
                                            </div>
                                            <a class="product-image" title="{{$sach_hotsale->title}}" href="{{route('chitietsach',$sach_hotsale->slug)}}.html"><img class="sach_moi" width="70" height="150" alt="{{asset('resources/upload/book/'.$sach_hotsale->image)}}" src="{{asset('resources/upload/book/'.$sach_hotsale->image)}}"></a>
                                            
                                        </div>
                                        <div class="des-container">
                                            <h2 class="product-name"><a title="{{$sach_hotsale->title}}" href="{{route('chitietsach',$sach_hotsale->slug)}}.html" style="color:green;font-size:14px">
                                                @if(strlen($sach_hotsale->title)>40)
                                                      {!!mb_substr($sach_hotsale->title,0,40,'UTF-8')!!}...
                                                    @else
                                                        {{$sach_hotsale->title}}
                                                    @endif
                                            </a></h2>
                                            
                                            <div class="price-box">
                                                <p class="special-price">
                                                    <span class="price">{!! number_format($sach_hotsale->sale_price,0,",",".") !!}.đ</span>
                                                </p>
                                                @if($sach_hotsale->sale_price < $sach_hotsale->price)
                                                <p class="old-price">
                                                    <span class="price">{!! number_format($sach_hotsale->price,0,",",".") !!}.đ</span>
                                                </p>
                                                @endif
                                            </div>
                                            <br>
                                            
                                            <a href="javascript:void(0)" class="btn-link yourcart" data-id="{{$sach_hotsale->id}}" title="{{$sach_hotsale->slug}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</a>
                                           
                                        </div>
                                    </div>
                               
                                @endforeach  
                    
                                </div><!-- /.product-list -->
                            </div>
                          <!-- SÁCH HOT SALE -->
                        </div>
                    </div><!-- /.col-right -->
                  <!-- CÁC DANH MỤC BÊN TAY PHẢI TRANG WEB -->
                </div>
                <!-- CONTENT -->
                <!-- QUẢNG CÁO -->
                
                <!-- QUẢNG CÁO-->
            </div>
        </div>
@endsection
@section('javascript')
<script src="{{asset('public/site/js/jquery.nivo.slider.pack.js')}}"></script>
<script type="text/javascript">
            /* Main Slideshow */
            $(window).load(function() {
                $(document).off('mouseenter').on('mouseenter', '.pos-slideshow', function(e){
                    $('.ma-banner7-container .timethai').addClass('pos_hover');
                });
                $(document).off('mouseleave').on('mouseleave', '.pos-slideshow', function(e){
                    $('.ma-banner7-container .timethai').removeClass('pos_hover');
                });
            });
            $(window).load(function() {
                $('#ma-inivoslider-banner7').nivoSlider({
                    effect: 'random',
                    slices: 15,
                    boxCols: 8,
                    boxRows: 4,
                    animSpeed: 1000,
                    pauseTime: 6000,
                    startSlide: 0,
                    controlNav: false,
                    controlNavThumbs: false,
                    pauseOnHover: true,
                    manualAdvance: false,
                    prevText: 'Prev',
                    nextText: 'Next',
                    afterLoad: function(){
                        },     
                    beforeChange: function(){ 
                    }, 
                    afterChange: function(){ 
                    }
                });
            });
            $(document).ready(function(){
                /* timely-owl */
                $("#timely-owl .owl").owlCarousel({
                    autoPlay : true,
                    items : 1,
                    itemsDesktop : [1199,1],
                    itemsDesktopSmall : [991,1],
                    itemsTablet: [767,2],
                    itemsMobile : [480,1],
                    slideSpeed : -5000,
                    paginationSpeed : -5000,
                    rewindSpeed : -5000,
                    navigation : true,
                    stopOnHover : true,
                    pagination : false,
                    scrollPerPage:true,
                });
                /* special-offer slider */
                $("#special-offer .owl").owlCarousel({
                    autoPlay : false,
                    items : 1,
                    itemsDesktop : [1199,1],
                    itemsDesktopSmall : [991,1],
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
                /* latest-news slider */
                $("#latest-news .owl").owlCarousel({
                    autoPlay : false,
                    items : 1,
                    itemsDesktop : [1199,1],
                    itemsDesktopSmall : [991,1],
                    itemsTablet: [767,2],
                    itemsMobile : [480,1],
                    slideSpeed : 1000,
                    paginationSpeed : 1000,
                    rewindSpeed : 1000,
                    navigation : true,
                    stopOnHover : true,
                    pagination : false,
                    scrollPerPage:true,
                });
                /* clients-say slider */
                $("#clients-say .owl").owlCarousel({
                    autoPlay : false,
                    items : 1,
                    itemsDesktop : [1199,1],
                    itemsDesktopSmall : [991,1],
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
                /* featured-products slider */
                // scrpit bên sản hẩm mới
                $("#featured-products .owl").owlCarousel({
                    autoPlay : true,
                    items : 4,
                    itemsDesktop : [1199,3],
                    itemsDesktopSmall : [991,2],
                    itemsTablet: [767,2],
                    itemsMobile : [480,1],
                    /*
                    slideSpeed : 3000,
                    paginationSpeed : 3000,
                    rewindSpeed : 3000,
                    */
                    navigation : true,
                    stopOnHover : true,
                    pagination : false,
                    scrollPerPage:false,
                    

                });
                /* new-products slider */
                $("#new-products .owl").owlCarousel({
                    autoPlay : true,
                    items : 4,
                    itemsDesktop : [1199,3],
                    itemsDesktopSmall : [991,2],
                    itemsTablet: [767,2],
                    itemsMobile : [480,1],
                    /*
                    slideSpeed : 3000,
                    paginationSpeed : 3000,
                    rewindSpeed : 3000,
                    */
                    navigation : true,
                    stopOnHover : true,
                    pagination : false,
                    //scrollPerPage:true,  // nếu có cái này mỗi lần nhảy thì tới 4 cái khác
                    
                });
            });
</script>
        
<!-- Hot Deals Timer 1-->
<script type="text/javascript">
            var dthen1 = new Date("6/9/2016 11:59:00 PM");
            start = "2/9/15 03:02:11 AM";
            start_date = Date.parse(start);
            var dnow1 = new Date(start_date);
            if(CountStepper>0)
                ddiff= new Date((dnow1)-(dthen1));
            else
                ddiff = new Date((dthen1)-(dnow1));
            gsecs1 = Math.floor(ddiff.valueOf()/1000);
            
            var iid1 = "countbox_1";
            CountBack_slider(gsecs1,"countbox_1", 1);
</script>
<!-- Hot Deals Timer 2-->
<script type="text/javascript">
            var dthen2 = new Date("05/21/26 11:59:00 PM");
            start = "08/04/15 03:02:11 AM";
            start_date = Date.parse(start);
            var dnow2 = new Date(start_date);
            if(CountStepper>0)
                ddiff= new Date((dnow2)-(dthen2));
            else
                ddiff = new Date((dthen2)-(dnow2));
            gsecs2 = Math.floor(ddiff.valueOf()/1000);
            
            var iid2 = "countbox_2";
            CountBack_slider(gsecs2,"countbox_2", 2);
</script>
<!-- Hot Deals Timer 3-->
<script type="text/javascript">
            var dthen3 = new Date("05/21/33 11:59:00 PM");
            start = "08/04/15 03:02:11 AM";
            start_date = Date.parse(start);
            var dnow3 = new Date(start_date);
            if(CountStepper>0)
                ddiff= new Date((dnow3)-(dthen3));
            else
                ddiff = new Date((dthen3)-(dnow3));
            gsecs3 = Math.floor(ddiff.valueOf()/1000);
            
            var iid3 = "countbox_3";
            CountBack_slider(gsecs3,"countbox_3", 3);
</script>
@endsection