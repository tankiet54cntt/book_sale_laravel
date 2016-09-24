@extends('site.master')
@section('title')
--- Giỏ hàng
@endsection
@section('css')
<style type="text/css">
	.mega-menu-category{
		display: none;
	}
    .sach_moi:hover{
        opacity: 0.6;
    }
    .img_update{
        opacity: 0.5;
    }
    .img_update:hover{
       opacity: 10;
    }
</style>
@endsection
@section('breadcrumbs')
<div class="breadcrumbs">
            <div class="container">
                <ul class="breadcrumb" style="font-size:16px;">
                    <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ul>
            </div>
</div>
@endsection
@section('content')

<div class="main">
            <div class="container">
            <!-- Cart-->
        @if(Session::has('flash_message')) <!-- nếu tồn tại một cái biến session nào đó được định nghĩa ở controller  -->
                            <div class="alert alert-{!! Session::get('flash_level') !!}"> <!-- hiển thị lớp -->
                              <h5>  {!! Session::get('flash_message')!!} <!-- hiển thị giá trị của session đó  -->
                              </h5>
                            </div>
        @endif
                <div class="cart">
                    
                    <div class="table-responsive">
                    <table class="table custom-table" style="border:0;border-top:1px solid #CCC">
                        <thead>
                            <tr class="first last">

                                <th>Xóa</th>
                                <th>Ảnh</th>
                                <th>Tên Sách</th>
                                <th>Cập nhật</th>
                                <th>Số Lượng</th>
                                <th>Subtotal</th>
                                <th>Grandtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($content as $item)
                            <tr>
                                <td class="text-center"><a class="btn-remove" style="cursor:pointer" rowid={{$item["rowid"]}}><span class="fa fa-trash-o"></span></a></td>
                                <td><a class="product-image" title="{{$item['name']}}" href="">
                                    <img class="sach_moi" alt="{!!asset('resources/upload/book/'.$item['options']['img'])!!}" width="100" height="200" src="{!!asset('resources/upload/book/'.$item['options']['img'])!!}">
                                </a></td>
                                <td class="text-center">
                                    <span style="font-size:16px;">{{$item->name}}</span>
                                 
                                </td>
                                <td class="text-center"><a style="cursor:pointer" class="updatecart" rowid={{$item["rowid"]}} soluongbandau={{$item['qty']}}><img class="img_update" data-original-title="Update" src="{{ url('public/site/images/update.png') }}" alt="{{ url('public/site/images/update.png') }}"></a></td>
                                <td class="qty">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sub" type="button">-</button>
                                        </span>
                                        <input type="text" class="form-control soluong" value="{{$item['qty']}}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-add" type="button">+</button>
                                        </span>
                                    </div><!-- /input-group -->
                                </td>
                                <td class="subtotal">{{number_format($item['price'],0,",",".")}}đ</td>
                                <td class="grandtotal">{{number_format($item['price']*$item['qty'],0,",",".") }}đ</td>
                            </tr>
                            @endforeach
                           @if($total > 0)
                             @if(Session::has('payment_coupon'))
                               <tr >
                                    <td colspan="3" style="border:0"></td>
                                    <td colspan="2" class="subtotal" style="border:0"><span style="font-size:24px;font-weight:bold">Tổng Tiền</span></td>
                                     <td colspan="2" class="grandtotal" style="border:0">
                                         <span style="font-size:22px;font-weight:bold;color:#CCC">
                                        
                                                {{ number_format($total,0,",",".") }}đ
                                        
                                         </span>
                                     </td>
                                </tr>
                                <tr >
                                    <td colspan="3" style="border:0"></td>
                                    <td colspan="2" class="subtotal" style="border:0"><span style="font-size:24px;font-weight:bold">Đã Giảm</span></td>
                                     <td colspan="2" class="grandtotal" style="border:0">
                                         <span style="font-size:22px;font-weight:bold;color:red">
                                         {{Session::get('payment_coupon.percent_coupon')}} %
                                         </span>
                                     </td>
                                </tr>
                             @endif
                            <tr>
                                <td colspan="3" style="border:0;"></td>
                                <td colspan="2" class="subtotal" style="border:0"><span style="font-size:24px;font-weight:bold"> @if(Session::has('payment_coupon')) Tiền Phải Trả @else Tổng Tiền @endif</span></td>
                                 <td colspan="2" class="grandtotal" style="border:0">
                                     <span style="font-size:22px;font-weight:bold;color:green">
                                    @if(Session::has('payment_coupon'))
                                            {{ number_format($tienphaitra,0,",",".") }}đ
                                    @else
                                            {{ number_format($total,0,",",".") }}đ
                                    @endif
                                     </span>
                                 </td>
                            </tr>
                            
                           @else
                            <tr>
                                <td class="text-center" colspan="7" style="border:0"><span style="font-size:22px;font-weight:bold;color:green">Chưa có sản phẩm nào nằm trong giỏ hàng của bạn !</span></td>
                            </tr>
                           @endif
                        </tbody>
                    </table>
                    </div>

                    <div class="text-right">
                        <a href="{{route('sachmoi')}}" class="btn btn-info btn-md"><i class="fa fa-cart-plus" aria-hidden="true"></i> Tiếp Tục Mua sắm</a>
                        
                        <a onclick="return confirm('Bạn có chắc muốn xóa Hết Tất Cả?');" href="{{route('xoahethang')}}" class="btn btn-danger btn-md" id="delele_cart_all"><i class="fa fa-trash" aria-hidden="true"></i> Làm Rỗng Giỏ Hàng</a>
                       
                    </div>
                    
                    <div class="line2"></div>
                    @if(!empty($errors->first('ma_giam_gia')))
                    <div class="alert alert-danger" style="text-align:center"> <!-- hiển thị lớp -->
                                  <h5>   {{$errors->first('ma_giam_gia')}}<!-- hiển thị giá trị của session đó  -->
                                  </h5>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>ESTIMATE SHIPPING AND TAX</h4>
                            <p class="text-muted">Enter your destination to get shipping &amp; tax</p>
                            <div class="form-group">
                                <label class="control-label">Country <em>*</em></label>
                                <select class="form-control">
                                    <option>-- Select options  --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">State/Province <em>*</em></label>
                                <select class="form-control">
                                    <option>-- Select options  --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Zip/Postal Code</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-default btn-md">GET A QUOTE</button>
                            </div>
                        </div>
                       
                     
                        <div class="col-sm-4">
                          @if(!Session::has('payment_coupon'))
                            <h4>DISCOUNT CODE ( MÃ GIẢM GIÁ)</h4>
                            <p class="text-muted">            
                                Enter your coupon code if you have one
                            </p>
                            <form action="{{route('giamgia')}}" method="POST">
                              <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">

                                    <label class="control-label">&nbsp;</label>
                                    <input type="text" name="ma_giam_gia" class="form-control" placeholder="Nhập mã giảm giá ở đây !">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-md" value="Submit Code">
                                </div>
                           </form>
                          @else
                                <h4>DISCOUNT CODE (<span style="color:green"> Đã Giảm Giá </span>)</h4>
                                <p class="text-muted">            
                                    Bạn đã Nhập mã giảm giá : <span style="color:red;">{{Session::get('payment_coupon.code_coupon')}}</span> <br>
                                    Và được giảm : <span style="color:red">{{Session::get('payment_coupon.percent_coupon')}}%</span> khi mua hàng
                                </p>
                          @endif
                        </div>
                   
                       <div class="col-sm-4">
                        
                                        @include('error')
                                        <form action="{{route('thanhtoan')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                 @if(Auth::user())
                                                    <h4>Thông Tin Thanh Toán</h4>
                                                    <div class="line2 mtb20"></div>
                                                   
                                                    <div class="form-group">
                                                        <label class="control-label">firstname *</label>
                                                 <input type="text" name="txtFirstname" class="form-control" value="{{Auth::user()->firstname}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">lastname *</label>
                                                        <input type="text" name="txtLastname" class="form-control" value="{{Auth::user()->lastname}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Email *</label>
                                                        <input type="email" name="txtEmail" class="form-control" value="{{Auth::user()->email}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Địa Chỉ</label>
                                                        <input type="text" name="txtdiachi" class="form-control" value="{{Auth::user()->address}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Phone *</label>
                                                        <input type="text" class="form-control" name="txtPhone" value="{{Auth::user()->phone_number}}">
                                                    </div>
                                                
                                                @endif
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-success btn-md btn-login fwb">Thực Thi Thanh Toán</button>
                                                    </div>
                                               
                                        </form>
                             
                           
                        </div>
                  
                    </div>
                   
                </div>
            </div>
</div><!-- /.main -->
@endsection
@section('javascript')
  <script type="text/javascript">
  $(document).ready(function(){

        $("div.alert").delay(10000).slideUp(); // cái này nó hiện ra sau 10 giây và tự động tắt đi (khi thực hiện thêm)
        $(document).on('click','.updatecart', function(){  // xử dụng cái này khi thực hiện hàm load của jquery (lưu ý : khi sử dụng load thì element sẽ bị hủy dẫn đến ta tiếp tục thực hiện thì nó sẽ ko nhận sự kiện đó vì thế ta sử dụng $(document).on để listen lại sự kiện ban đầu thay vì $('.updatecart').click(function(){}))
            var rowid=$(this).attr("rowid");
            var qty=$(this).parent().parent().find('.soluong').val(); // lấy ra giá trị của qyt
            var soluong_bandau=parseInt($(this).attr("soluongbandau"));
            // kiểm tra giá trị qty nhập vào nếu ko phải số thì báo lỗi và ko cho thực hiện tiếp
            if(isNaN(qty)==true)
            {
                alert("số lượng phải là con số nhé !");
                $(this).parent().parent().find('.soluong').val(soluong_bandau);
                return ;
            }
            if(qty<=0)
            {
                alert("số lượng phải > 0 !");
                $(this).parent().parent().find('.soluong').val(soluong_bandau);
                return ;
            }    
            // thực hiện ajax
            $.ajax({
                url: "sua-hang/"+rowid,
                type: "GET",
                cache:false,
                data:{"rowid":rowid,"qty":qty},
                success:function(ketqua){
                    if(ketqua=="ok")
                    {
                        var loadtrang="gio-hang";
                        alert("update success");

                     
                        $("#giohang").load(loadtrang+" #giohang"); // cập nhật giỏ hàng trên header
                        $(".cart").load(loadtrang+" .cart");   // cập nhật ở danh sách các hàng trong giỏ
                       //window.location=loadtrang;  // chuyển redirect tới trang

                    }
                }

            });
        });
        //=========xóa 1 sản phẩm trong giỏ hàng
        $(document).on('click','.btn-remove', function(){
            var c = confirm('Bạn có chắc muốn xóa sản phẩm này ra khỏi giỏ hàng?');
            if(c) {
                var rowid=$(this).attr("rowid");
                // thực hiện ajax
                $.ajax({
                    url: "xoa-hang/"+rowid,
                    type: "GET",
                    cache:false,
                    data:{"rowid":rowid},
                    success:function(ketqua){
                        if(ketqua=="ok")
                        {
                            var loadtrang="gio-hang";
                            alert("delete success");
                            $("#giohang").load(loadtrang+" #giohang"); // cập nhật giỏ hàng trên header
                             $(".cart").load(loadtrang+" .cart");   // cập nhật ở danh sách các hàng 
                        }
                    }

                });
            }
        });

        /// tạo hộp số 
        // giảm
        $(document).on('click','.btn-sub', function(){
       // $(".btn-sub").click(function(){
                var inputgiatri=$(this).parent().parent().find("input[type=text]");
                var giatri_hientai=parseInt(inputgiatri.val());
              //  alert(giatri_hientai);
            
                if(!isNaN(giatri_hientai))
                { 
                    if(giatri_hientai>1)
                    {
                        inputgiatri.val(giatri_hientai-1).change();
                    }
                }
                
        });
        $(document).on('click','.btn-add', function(){
                var inputgiatri=$(this).parent().parent().find("input[type=text]");
                var giatri_hientai=parseInt(inputgiatri.val());
                if(!isNaN(giatri_hientai))
                { 
                    if(giatri_hientai<=9999999999999)
                    {
                        inputgiatri.val(giatri_hientai+1).change();
                    }
                }
        });
  });
 </script>
@endsection