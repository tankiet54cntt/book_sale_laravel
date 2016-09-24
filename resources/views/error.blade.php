@if( $errors->all())
    <div class="alert alert-danger">
		Lỗi !
        <ul>
            @foreach($errors->all() as $error)
            <li class="error_li">{!! $error !!}</li>  <!-- tạo class chỉ hỗ trợ css cho bên đăng nhập thôi các bên còn lại ko lq-->
            @endforeach
        </ul>
    </div>
@endif