<style type="text/css">
    .coupons-icon {
    display: block;
    width: 45px;
    height: 45px;
    line-height: 45px;
    text-align: center;
    font-size: 14px;
    /*font-family: 'Raleway', sans-serif;*/
    font-family: "Times New Roman", Georgia, Serif;
    font-weight: 700;
    color: #fff;
    text-transform: uppercase;
    background: #d8373e;
    border-radius: 100%;
}
</style>
<div class="block">
                            <div class="title-group"><h2>Sách Giảm Giá</h2></div>
                            <div id="special-offer" class="owl-container">
                                <div class="owl">
                                 
                                    <div class='sepecialoffer-item item'>
                                     @foreach($sachgiamgia as $key=>$sach_gg)
                                      @if($key<=4)
                                        <div class="item-inner">
                                            <div class="images-container">
                                               <div class="product_icon">
                                                    <div class='coupons-icon'><span>-{{round(($sach_gg->price-$sach_gg->sale_price)*100/($sach_gg->price))}}%</span></div>
                                                </div>
                                                <a href="{{route('chitietsach',$sach_gg->slug)}}.html" title="{{$sach_gg->title}}" class="product-image">
                                                    <img class="sach_moi" width="70" height="115" src="{{asset('resources/upload/book/'.$sach_gg->image)}}" alt="{{asset('resources/upload/book/'.$sach_gg->image)}}" title="{{$sach_gg->title}}" />
                                                </a>
                                            </div>
                                            <div class="des-container">
                                            <h2 class="product-name"><a title="{{$sach_gg->title}}" href="{{route('chitietsach',$sach_gg->slug)}}.html" style="color:green;font-size:14px">
                                                @if(strlen($sach_gg->title)>28)
                                                      
                                                        {!!mb_substr($sach_gg->title,0,28,'UTF-8')!!}...
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
                                            </div><br>
                                            
                                            <a href="javascript:void(0)" class="link-cart yourcart" data-id="{{$sach_gg->id}}" title="{{$sach_gg->slug}}">Add to Cart</a>
                                           
                                        </div>
                                            
                                    </div>
                                      @else
                                        <?php break;?>
                                      @endif
                                     @endforeach
                                    </div>
                                  
                                </div>
                            </div><!-- /.owl-container -->
                        </div>