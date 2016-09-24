<style type="text/css">
    #xemnhieu:hover
    {
        color: red !important;
    }
</style>
<?php
        if(Session::has('payment_coupon'))
        {
            $tongtien=$total;
            $total=$total-$total*(Session::get('payment_coupon.percent_coupon')/100);  // số tiền còn lại sau khi giảm giá
        }
?>

<div class="top-cart-title">
                            <span id="giohang">
                                    <a href="{{route('giohang')}}" class="dropdown-toggle" data-toggle="dropdown">
                                        Giỏ hàng của bạn
                                        
                                    
                                         <span style="text-align:center" class="price item_cart">
                                            {{number_format($total,0,",",".")}}<span style="text-transform: none;">.đ</span>
                                         </span>
                                       
                                    </a>
                            @if($total>0)
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="cart-listing">
                                        <?php $dem=1;?>
                                        @foreach($content as $key=>$sach)
                                          @if($dem<=8)
                                            <div class="media">
                                                <div class="media-left"><a href=""><img src="{!!asset('resources/upload/book/'.$sach['options']['img'])!!}" alt="{!!asset('resources/upload/book/'.$sach['options']['img'])!!}" class="img-responsive"></a></div>
                                                <div class="media-body">
                                                    
                                                    <h4 style="color:green">
                                                        @if(strlen($sach['name'])>28)                                                     {!!substr($sach['name'],0,28)!!}...
                                                       @else
                                                        {{$sach['name']}}
                                                       @endif
                                                    </h4>
                                                    <div class="mini-cart-qty" style="font-size:12px">số lượng: {{$sach['qty']}}</div>
                                                    <div class="mini-cart-price">{{number_format($sach['price'],0,",",".") }}.đ</div>
                                                </div>
                                            </div>
                                            <?php $dem++;?>
                                          @else
                                            
                                             <div class="media" style="text-align:center;">
                                                <a id="xemnhieu" href="{{route('giohang')}}" style="color:green;font-weight:bold">Xem Nhiều Hơn</a><br>
                                                                    ...
                                             </div>
                                            <?php break; ?>
                                          @endif
                                        @endforeach 
                                        </div>
                                        <div class="mini-cart-subtotal">Shipping: <span class="price" style="color:black">free</span></div>
                                        @if(Session::has('payment_coupon'))
                                        <div class="mini-cart-subtotal">Tổng Tiền : <span class="price" style="color:black">{{number_format($tongtien,0,",",".") }}.đ </span></div>
                                        <div class="mini-cart-subtotal">Đã Giảm : <span class="price" style="color:black">{{Session::get('payment_coupon.percent_coupon')}} %</span></div>
                                        <div class="mini-cart-subtotal">Số Tiền Phải Trả: 
                                            <span class="price" style="width:100px;background-color:#CCC;text-align:center;color:red;">                                              {{number_format($total,0,",",".") }}đ  
                                            </span>
                                           
                                       </div>
                                        @else
                                        <div class="mini-cart-subtotal">Tổng Tiền: 
                                            <span class="price" style="color:red;">                                              {{number_format($total,0,",",".") }}đ  
                                            </span>
                                           
                                       </div>
                                       @endif

                                       @if($dem<=8)
                                        <div class="checkout-btn" style="text-align:center">
                                           
                                            <a href="{{route('giohang')}}" class="btn btn-link fwb"><i style="font-size:18px" class="fa fa-shopping-cart" aria-hidden="true"></i> Xem chi tiết giỏ hàng</a>
                                        </div>
                                       @endif
                                    </div>
                            @endif
                            </span>
                           
</div>
