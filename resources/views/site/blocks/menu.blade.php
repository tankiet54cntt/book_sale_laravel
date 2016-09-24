<div class="col-md-3">
                            <div class="mega-container visible-lg visible-md">
                                <div class="navleft-container">
                                    <div class="mega-menu-title"><h3>Danh Mục Sách</h3></div>
                                    <div class="mega-menu-category">
                                        <ul class="nav">
            <?php
                    $cate_header=App\Category::select('id','name','slug','parent_id')->get()->toArray();
                    $dem=1;
            ?>
            @foreach($cate_header as $key=>$item)
                    @if($item["parent_id"]==0)
                       <?php 
                            // hàm này in ra để đề phòng danh mục sách ko có thư mục con
                            $dem_cate_con=App\Category::where('parent_id',$item["id"])->get();
                       ?>
                      <!-- CHỖ CATE HIỆN TỐI ĐA 8 CÁI DANH MỤC CÓ PARAENT_ID LÀ 0-->
                        @if($dem<=8)
                                            <li>
                                              <!-- hoặc "danh-muc/{{$item['slug']}}" -->
                                                <a href="{{route('danhmuc',$item['slug']) }}.html">{{$item["name"]}}</a>
                          
                          <!-- chỉ in ra danh mục nào có thư mục con còn ko có thì ko in-->
                                    @if(count($dem_cate_con)>0)
                                                <div class="wrap-popup">
                                                    <div class="popup">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <h3>Danh Mục</h3>
                                                                <ul class="nav">
                                                @foreach($cate_header as $cate_con)
                                                        @if($cate_con["parent_id"]==$item["id"])
                                                                        <li><a href="{{route('danhmuc',$cate_con['slug']) }}.html">{{$cate_con["name"]}}</a></li>   
                                                                    @endif        
                                                @endforeach
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3 has-sep">
                                                                <h3>Tác Giả</h3>
                                                                <ul class="nav">
                                                                 <!--
                                                                    <li><a href="#">Duis</a></li>
                                                                    <li><a href="#">autem </a></li>
                                                                    <li><a href="#">vel eum </a></li>
                                                                    <li><a href="#">iriure </a></li>
                                                                    <li><a href="#">dolor </a></li>
                                                                    <li><a href="#">hendrerit </a></li>
                                                                    <li><a href="#">vulputate </a></li>
                                                                -->
                                <?php $tacgia=App\Writer::Orderby('id','DESC')->inRandomOrder()->take(11)->get(); ?>
                                                               @foreach($tacgia as $tg)

                                                                    <li><a href="#">{{$tg->name}}</a></li>
                                                                @endforeach
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6 has-sep">
                                                                <div class="custom-menu-right">
                                <?php $sach_theotheloai=Sach_Theo_TheLoai($item['id']); ?>
                                                 @foreach($sach_theotheloai as $key => $value)
                                                    @if($key<=1)
                                                                    <div class="box-banner media">
                                                                  
                                                                        <div class="media-body">
                                                                          @if($key==0 || $key==1)
                                                                            <a href="{{route('chitietsach',$value['slug'])}}.html"><img width="150" height="200" src="{{asset('resources/upload/book/'.$value['image'])}}" alt=""></a>
                                                                          @endif
                                                                        </div>
                                                                       
                                                                       <div style="margin-left:5px;" class="media-right">
                                                                        
                                                                        <a href="{{route('chitietsach',$value['slug'])}}.html"><img  width="70" height="93" src="{{asset('resources/upload/book/'.$value['image'])}}" alt=""></a>
                                                                        <br><br>
                                                                        
                                                                        <a href="{{route('chitietsach',$value['slug'])}}.html"><img width="70" height="93" src="{{asset('resources/upload/book/'.$value['image'])}}" alt=""></a>
                                                                        
                                                                        </div>
                                                                    
                                                                    </div>

                                                    @else
                                                        <?php break;?>
                                                    @endif
                                                @endforeach 
                                     
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        
                                                    </div>

                                                </div>
                                        @endif <!-- chỉ in ra danh mục nào có thư mục con còn ko có thì ko in-->
                                            </li>
                            <?php $dem++;?>
                        @else <!-- CHỖ CATE NẾU > 8 CÁI DANH MỤC CÓ PARAENT_ID LÀ 0 THÌ HIỆN MORE-->
                               <li class="more-menu">
                                                <a href="{{route('danhmuc',$item['slug']) }}.html">{{$item["name"]}}</a>
                                             @if(count($dem_cate_con)>0)
                                                <div class="wrap-popup">
                                                    <div class="popup">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <h3>Danh Mục</h3>
                                                                <ul class="nav">
                                                @foreach($cate_header as $cate_con)
                                                        @if($cate_con["parent_id"]==$item["id"])
                                                                        <li><a href="{{route('danhmuc',$cate_con['slug']) }}.html">{{$cate_con["name"]}}</a></li>   
                                                                    @endif        
                                                @endforeach
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3 has-sep">
                                                                <h3>Tác Giả</h3>
                                                                <ul class="nav">
                                                                    @foreach($tacgia as $tg)

                                                                     <li><a href="#">{{$tg->name}}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6 has-sep">
                                                                <div class="custom-menu-right">
                                <?php $sach_theotheloai=Sach_Theo_TheLoai($item['id']); ?>
                                                 @foreach($sach_theotheloai as $key => $value)
                                                    @if($key<=1)
                                                                    <div class="box-banner media">
                                                                  
                                                                        <div class="media-body">
                                                                            <a href="{{route('chitietsach',$value['slug'])}}.html"><img width="170" height="200" src="{{asset('resources/upload/book/'.$value['image'])}}" alt=""></a>
                                                                        </div>
                                                             
                                                                        

                                                                     </div>
                                                    @else
                                                        <?php break;?>
                                                    @endif
                                                @endforeach 
                                     
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        
                                                    </div>
                                                </div>
                                            @endif
                               </li>
                            <?php $dem++;?> 
                        @endif
                    @endif

            @endforeach
                                   <!-- ở phía trên là dem=9 rồi do nó tăng lên 1 đơn vị nên để hiện được more thì phải >9-->
                                   @if($dem>9)
                                        <li class="view-more"><a href="#">Xem Thêm</a></li>
                                        </ul>
                                   @endif        
                                    </div>
                                </div>
                            </div>
                        </div>

<!--==================================MENU KHI THU NHỎ MÀN HÌNH==============================-->
<div class="col-md-9">
                        <!-- nếu thằng nào có tool=giatri menu đó thì có thêm class="duoc_chon"-->
                            <ul class="menu clearfix visible-lg visible-md">
                                <li><a href="{{url('/')}}" @if($tool=="trangchu") class="duoc_chon" @endif><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                                <li><a href="#" @if($tool=="gioithieu") class="duoc_chon" @endif>Giới Thiệu</a></li>
                                <li><a href="{{route('lienhe')}}" @if($tool=="lienhe") class="duoc_chon" @endif>Liên Hệ</a></li>
                                <li ><a id="moiphathanh" href="{{route('sachmoi')}}" @if($tool=="sachmoi") class="duoc_chon" @endif>Sách Mới Phát Hành</a></li>
                                <li><a id="sachbanchay" href="{{route('sachbanchay')}}" @if($tool=="sachbanchay") class="duoc_chon" @endif>Sách Bán Chạy</a></li>
                                <li><a href="{{route('sachgiamgia')}}" @if($tool=="sachgiamgia") class="duoc_chon" @endif>Sách Giảm Giá</a></li>
                                
                            </ul>
                        </div>