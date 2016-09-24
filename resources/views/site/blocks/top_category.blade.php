<div class="catlist">
            <div class="container">
                <div class="title-group1">
                    <h2>Danh mục nổi bật </h2>
                    <span style="color:blue" id="more_top_cate"></span>
                </div> 
                <div class="row">
                <?php  $dem=1; // do ta muốn hiển thị 4 top category mới nhất?>
                 @foreach($top_category as $top_cate)
                      <?php $sach_theotheloai=Sach_Theo_TheLoai($top_cate['id']);
                      ?>
                      @if(count($sach_theotheloai)>0) <!-- CHỈ HIỆN TOP CATEGORY CÓ SÁCH >0-->
                        @if($dem<=8)    <!-- CHỈ MUỐN HIỆN 4 CATE MỚI NHẤT-->             
                        <div class="col-md-3 col-sm-6 bandau">
                            <div class="row">
                              @foreach($sach_theotheloai as $key => $value)
                               @if($key<1)
                                    <div class="col-xs-6">
                                        <div class="image-cat">
                                            <a href="{{route('danhmuc',$top_cate['slug'])}}.html"><img class="sach_moi" width="137" height="150" alt="Electronic" src="{{asset('resources/upload/book/'.$value['image'])}}"></a>
                                        </div>
                                    </div>
                                @else
                                    <?php break; ?>
                                @endif
                              @endforeach
                                <div class="col-xs-6">
                                    <div class="name-cat"><a href="{{route('danhmuc',$top_cate['slug'])}}.html"><h3 style="font-size:14px">{{$top_cate->name}}</h3></a></div>
                                    <a class="view-more" href="{{route('danhmuc',$top_cate['slug'])}}.html">view more</a>
                                </div>
                            </div>
                               
                            <div class="list-cat">
                              
                            </div>
                            
                        </div>
                        <?php $dem++;?>
                        @else
                           <div style="display:none;" class="col-md-3 col-sm-6 top_more">
                                <div class="row">
                                  @foreach($sach_theotheloai as $key => $value)
                                   @if($key<1)
                                        <div class="col-xs-6">
                                            <div class="image-cat">
                                                <a href="{{route('danhmuc',$top_cate['slug'])}}.html"><img class="sach_moi" width="137" height="150" alt="Electronic" src="{{asset('resources/upload/book/'.$value['image'])}}"></a>
                                            </div>
                                        </div>
                                    @else
                                        <?php break; ?>
                                    @endif
                                  @endforeach
                                    <div class="col-xs-6">
                                        <div class="name-cat"><a href="{{route('danhmuc',$top_cate['slug'])}}.html"><h3 style="font-size:14px">{{$top_cate->name}}</h3></div>
                                        <a class="view-more" href="{{route('danhmuc',$top_cate['slug'])}}.html">view more</a>
                                    </div>
                                </div>
                                <div class="list-cat">
                                  
                                </div>
                           </div>
                           <?php $dem++;?>
                        @endif           
                      @endif

                 @endforeach 
               
                </div>
            </div>
        @if($dem>9) <!-- nếu như đếm >9 thì hiện thì nút xem nhiều-->
             <span id="co_more"></span>
        @endif  
</div>

 