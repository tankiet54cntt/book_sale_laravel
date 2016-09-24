@if($errors->first('username')!="" || $errors->first('password')!="")
        <script type="text/javascript">$(document).ready(function(){
                    $(".show_login").show();
            });
        </script>
@endif
<div class="notifyjs-corner show_login" style="top: 0%; left: 40%;display:none;">
   
                                            @if(!Auth::user())
                                                <div style="background-color:#CCC" class="col-sm-12">
                                        
                                                    <h4>ĐĂNG NHẬP <a id="dong_login" href="javascript:void(0)" style="margin-left:150px;color:red"><i class="fa fa-times" aria-hidden="true"></i></a></h4>
                                                    <div class="line2 mtb20"></div>
                                                <form action="{{route('login')}}" method="POST">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <div class="form-group">
                                                        <label class="control-label" style="font-size:14px;">Bạn chưa có tài khoản? hãy click <a href="{{route('get_register')}}" class="btn-link">vào đây</a></label>
                                                    </div>
                                       
                                        
                                                    <div class="form-group">
                                                        <label class="control-label" style="font-size:14px;">Username <span class="text-primary">*</span> <span style="color:red">{{$errors->first('username')}}</span></label>
                                                        <input type="text" name="username" class="form-control" placeholder="Nhập Username">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" style="font-size:14px;">Password <span class="text-primary">* <span style="color:red">{{$errors->first('password')}}</span></span></label>
                                                        <input type="password" name="password" class="form-control" placeholder="Nhập Password">
                                                    </div>
                                                    <p><a href="{{route('get_forget_pass')}}" class="btn-link">Forgot your password?</a></p>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-danger btn-md btn-login fwb">LOGIN</button>
                                                    </div>
                                                </form>
                                                </div>
                                            @endif
                                       
                                  
</div>
<div class="col-sm-9">
                    <div class="blog-detail blog-list">
                    <div class="title-group3">
                             
                               <h3>Comments (<span id="dem_comment">{{count($comment)}}</span>)</h3>
                                        
                            </div>
                            <div class="comment-list">
                                @foreach($comment as $cm)
                                <div class="comment-item">
                                    <div class="media">
                                        <div class="media-left"><a href="#"><img src="{{asset('public/site/images/avatar.png')}}" alt="{{asset('public/site/images/avatar.png')}}"></a></div>
                                        <div class="media-body">
                                           <div class="comment-title">{{$cm->user->firstname}} {{$cm->user->lastname}}</div>
                                            <div class="comment-date">{{date("d-m-Y H:i:s",strtoTime($cm->created_at))}}</div>
                                            
                                             {!! $cm->content !!}
                                        </div>
                                    </div>
                                  <!-- reply : làm sau
                                    <div class="comment-reply">
                                        <div class="media">
                                            <div class="media-left"><a href="#"><img src="{{asset('public/site/images/avatar.png')}}" alt="{{asset('public/site/images/avatar.png')}}"></a></div>
                                            <div class="media-body">
                                                <div class="comment-date">12.5/2104</div>
                                                <div class="comment-title">1914 translation by H. Rackham</div>
                                                Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. 
                                            </div>
                                        </div>
                                    </div>
                                   -->
                                </div><!-- /.commnent-item -->
                                @endforeach
                            </div>
                            <hr>
                            <div class="title-group3">
                                <h3>Leave a reply</h3>
                            </div>      
                            <div class="row">

                    <input type="hidden" name="ten_an" id="ten_an" type="text" @if(Auth::check()) value="{{Auth::user()->id}}" @endif>
                                <div class="col-sm-12">
                                    <span id="error_noidung_comment" style="color:red;margin-bottom:5px;font-weight:bold"><span id="error_comment"></span></span>
                                    <div class="form-group">
                                        
                                        <textarea class="form-control" placeholder="Your comment" rows="5" name="txtComment" id="txtComment"></textarea>
                                    </div>
                                </div>
                            </div>
                <button type="submit" class="btn btn-default btn-lg btn_comment" bookid="{{$book_detail->id}}">Gửi Comment</button>
                            </form>
                        </div>
                 </div>