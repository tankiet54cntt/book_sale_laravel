<!-- =====ĐỒNG HỒ BẤM GIỜ VS GIÁ TIỀN-->
                        <div class="timely">
                            <div class="title-group"><h2>Hot Random</h2></div>
                            
                            <div id="timely-owl" class="owl-container">

                                <div style="padding-top:20px" class="owl">
                                <?php
                                    $sach_hot_rand=App\Book::where([['published',1],['hot_banchay',1]])->inRandomOrder()->take(7)->get(); 
                                ?>
                                 @foreach($sach_hot_rand as $sach)
                                    <div class='timer-item item'>
                                        <div class="item-inner">
                                            <div class="images-container">
                                                <a href="{{route('chitietsach',$sach->slug)}}.html" title="{{$sach->title}}" class="product-image"><img class="sach_moi" height="250" src="{{asset('resources/upload/book/'.$sach->image)}}" alt="Fusce aliquam" /></a>
                                                <div class="box-hover">
                                                    <ul class="add-to-links">
                                                        <li><a href="#" class="link-quickview">Quick View</a></li>
                                                        <li><a href="#" class="link-wishlist">Add to Wishlist</a></li>
                                                        
                                                        <li><a href="javascript:void(0)" class="link-cart yourcart" data-id="{{$sach->id}}" title="{{$sach->slug}}">Add to Cart</a></li>
                                                    </ul>
                                                </div>
                                                <div class="box-timer">
                                                    <div class="countbox_1 timer-grid"></div>
                                                </div>
                                            </div>
                                            <div class="content-box">
                                                <h2 class="product-name"><a href="{{route('chitietsach',$sach->slug)}}.html" title="Fusce aliquam">
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
                        </div>
                       <!-- =====ĐỒNG HỒ BẤM GIỜ -->
                       <!-- /.block - SÁCH GIẢM GIÁ -->
                        @include('site.blocks.left_giam-gia')
                       <!-- /.block - SÁCH GIẢM GIÁ -->

                       <!-- LASTED BOOK -->
                        <!--
                        <div class="menu-recent block">
                            <div class="title-group"><h2>Latest Books</h2></div>
                            <div id="latest-news" class="owl-container">
                                <div class="owl">
                                    <div>
                                        <div class="item-inner">
                                            <div class="images-container">
                                                <a href="#"> <img alt="" src="{{asset('public/site/images/blog/blog-01.jpg')}}" /> </a>
                                            </div>
                                            <div class="des-container">
                                                <div class="date-comments">
                                                    <div class="time"><span class="date">August 04, 2015</span></div>
                                                </div>
                                                <div class="des">
                                                    <h4><a href="#" class="title-blog"><span>swimwear for women</span></a></h4> 
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using...
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="item-inner">
                                            <div class="images-container">
                                                <a href="#"> <img alt="" src="{{asset('public/site/images/blog/blog-02.jpg')}}" /> </a>
                                            </div>
                                            <div class="des-container">
                                                <div class="date-comments">
                                                    <div class="time"><span class="date">January 05, 2015</span></div>
                                                </div>
                                                <div class="des">
                                                    <h4><a href="#" class="title-blog"><span>Burberry sport for men</span></a></h4>
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using...
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="item-inner">
                                            <div class="images-container">
                                                <a href="#"> <img alt="" src="{{asset('public/site/images/blog/blog-01.jpg')}}" /> </a>
                                            </div>
                                            <div class="des-container">
                                                <div class="date-comments">
                                                    <div class="time"><span class="date">August 04, 2015</span></div>
                                                </div>
                                                <div class="des">
                                                    <h4><a href="#" class="title-blog"><span>swimwear for women</span></a></h4> 
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using...
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->
                        <!-- LASTED BOOK -->