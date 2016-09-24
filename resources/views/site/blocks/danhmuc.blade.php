<div class="block-content">
                                <p class="block-subtitle">Shopping Options</p>
                                <div id="narrow-by-list">
                                    <div class="layered layered-Category">
                                        <h2 style="color:black;font-weight:bold">Danh Mục</h2>
                                        <div class="content-shopby">
                                            <ol>
                                              <?php

                                                $cate_left=App\Category::select('id','name','slug','parent_id')->get();
                                            
                                            ?>
                                              @foreach($cate_left as $item)
                                                @if($item->parent_id==0)
                                                    <li><a href="{{url('danh-muc/'.$item['slug'])}}.html"><span style="color:black;">Sách {{$item["name"]}}</span>(<span style="color:#CCC">{{count( Sach_Theo_TheLoai($item->id) )}}</span>) </a>
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