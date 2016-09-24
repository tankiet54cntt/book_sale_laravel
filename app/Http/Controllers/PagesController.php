<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;
use App\Book;
use Request;
// thêm thư viện cart cho giỏ hàng
use Cart;
use App\Coupon;
use App\Order;
use App\Writer;
use App\Book_Writer;
use Auth;
use App\User;
use App\Comment;
use Hash; // để mã hóa mật khẩu khoảng 64bit
use Session;
use Mail;// sủ dụng mail
class PagesController extends Controller
{
	public function __construct()
	{
		$category=Category::orderby('id','DESC')->get();  // chủ yếu sử dụng cho file top_category
		view()->share('category',$category);  // khi gọi view share thì các view sẽ nhận được biến $category (lưu ý ở các hàm khác tránh đặt trùng tên nhé)
		//Top Categories
		$top_category=Category::where('parent_id',0)->orderby('id','DESC')->get();
		view()->share('top_category',$top_category);

		$sach_moi=Book::where('published',1)->orderby('created_at','DESC')->paginate(20);
		view()->share('sach_moi',$sach_moi);
	    // tạo ra để active li cái được chọn
        $tool=NULL;
        View()->share('tool',$tool);

        // quy định sách giảm giá : có giá sale_price < price
       $sachgiamgia=Book::whereColumn('sale_price','<','price')->where([['published',1],['hot_banchay',1]])->orderby('created_at','DESC')->inRandomOrder()->paginate(20);
       View()->share('sachgiamgia',$sachgiamgia);
	}
    // TRANG CHỦ
    public function Home()
    {  
        $tool="trangchu";
        /*gọi 2 biến này để nó cập nhật lại giỏ hàng của chúng ta khi thêm*/
        $content=Cart::content(); 
        $total=Cart::total();
        $sachbanchay=Book::where([['hot_banchay',1],['published',1]])->inRandomOrder()->paginate(20); //inRandomOrder() : random ngẫy nhiên : in ra những cuốn sách thỏa 2 đk 1 trang 20 cuốn
        $sachhot=Book::where([['hot_banchay',1],['published',1]])->orderby('created_at','DESC')->inRandomOrder()->take(3)->get(); //inRandomOrder() : random ngẫy nhiên : in ra những cuốn sách thỏa 2 đk 1 trang 20 cuốn
        // 8 cuốn ngẫu nhiên
        $sachngaunhien=Book::where('published',1)->inRandomOrder()->take(3)->get();
        return View('site.pages.index',compact('tool','content','total','sachbanchay','sachngaunhien','sachhot'));
    }
    // LIÊN HỆ
    public function getLienHe()
    {
        $tool="lienhe";
        /*gọi 2 biến này để nó cập nhật lại giỏ hàng của chúng ta khi thêm*/
        $content=Cart::content(); 
        $total=Cart::total();
        return View('site.pages.contact',compact('content','total','tool'));
    }
    public function postLienHe()
    {
         $this->validate(Request::instance(),
               [
                    'name_contact'=>'required',
                    'email_contact'=>'required|email',
                    'noidung_lienhe'=>'required',
               ],
               [
                    'name_contact.required'=>'Họ tên không được bỏ trống',
                    'email_contact.required'=>'Email không được bỏ trống',
                    'email_contact.email'=>'Chưa đúng định dạng email',
                    'noidung_lienhe.required'=>'Nội dung không bỏ trống'
               ]);
          // bắt đầu send Mail
          // thông tin gửi mail  Input::get('email') hoặc $request->name hoặc $request->input('name') nhưng mailsend chỉ sử dụng được Input::get('name')
            $data=['hoten'=>Request::Input('name_contact'),'email'=>Request::Input('email_contact'),'tinnhan'=>Request::Input('noidung_lienhe')];
            Mail::send('site.mails.blank',$data,function($messages){
                    $messages->from('duyensoditimtinhyeu@gmail.com',Request::Input('noidung_lienhe'));
                    $messages->to('phptestfree@gmail.com','Tấn Kiệt')->subject('Mail đến từ trang Bán Sách');
            });
    
            echo "<script>
                alert('Cám ơn bạn đã góp ý, chúng tôi sẽ liên hệ bạn trong thời gian sớm nhất !');
                window.location='".url('/')."';
            </script>";
    }
	// HIỂN THỊ SÁCH MỚI
	public function SachMoi()
	{
		/*gọi 2 biến này để nó cập nhật lại giỏ hàng của chúng ta khi thêm*/
    	$content=Cart::content(); 
        $total=Cart::total();
        $tool="sachmoi";
		return View('site.pages.sachmoi',compact('content','total','tool'));
	}
    // HIỂN THỊ CÁC SẢN PHẨM SAU KHI SẮP XẾP
    public function SapXep($luachon)
    {
        if (Request::ajax()) {
            $tool="sachmoi";
            $content=Cart::content(); 
            $total=Cart::total();
            if($luachon=="Name"){
                $sach_moi=Book::where("published",1)->orderby("title","ASC")->paginate(20);

                return View('site.pages.sachmoi',compact('content','total','tool','sach_moi'));
            }
            else
            if($luachon=="Price")
                {
                    $sach_moi=Book::where("published",1)->orderby("sale_price","ASC")->paginate(20);

                    return View('site.pages.sachmoi',compact('content','total','tool','sach_moi'));
                }
            else
                {
                    return View('site.pages.sachmoi',compact('content','total','tool'));
                }
            
        }
    }
   // HIỂN THỊ SÁCH BÁN CHẠY
    public function SachBanChay()
    {
        /*gọi 2 biến này để nó cập nhật lại giỏ hàng của chúng ta khi thêm*/
        $content=Cart::content(); 
        $total=Cart::total();
        $tool="sachbanchay";
        $sachbanchay=Book::where([['hot_banchay',1],['published',1]])->orderby('created_at','DESC')->paginate(20);
        return View('site.pages.sachbanchay',compact('content','total','tool','sachbanchay'));
    }
  // HIỂN THỊ SÁCH GIẢM GIÁ
    public function SachGiamGia()
    {
        /*gọi 2 biến này để nó cập nhật lại giỏ hàng của chúng ta khi thêm*/
        $content=Cart::content(); 
        $total=Cart::total();
        $tool="sachgiamgia";
        return View('site.pages.sachgiamgia',compact('content','total','tool'));
    }
   // DANH MỤC SÁCH
    public function Cate($slug)
    {
    	if(strlen($slug)>5)
        {
    		$slug=substr($slug,0,strlen($slug)-5);  // ta muốn slug lúc này ko phải là .html nữa ta xóa 5 ký tự đó đi(ngĩa là xóa .html)
        }
        $cate=Category::where('slug',$slug)->first();
        if(count($cate)==0) // nếu tào lao trỏ tới trang chủ lại
    		return redirect('/');
    	else
    	{
    	 /*gọi 2 biến này để nó cập nhật lại giỏ hàng của chúng ta khi thêm*/
	    	$content=Cart::content(); 
	        $total=Cart::total();
    	 $id_parent=tim_id_parent($cate); // để hiện category ở phía trái của trang(tìm cate cha gốc đó)
    	 $danh_muc_sach=Sach_Theo_TheLoai($cate->id);
    	 return View('site.pages.cate_book',compact('cate','danh_muc_sach','id_parent','content','total'));
    	}
    }
   // CHI TIẾT SÁCH
    public function Detail($slug)
    {
      if(strlen($slug)>5)
        {
    		$slug=substr($slug,0,strlen($slug)-5);  // ta muốn slug lúc này ko phải là .html nữa ta xóa 5 ký tự đó đi(ngĩa là xóa .html)
        }

       $book_detail=Book::where('slug',$slug)->first();
    	if(count($book_detail)==0) // nếu tào lao trỏ tới trang chủ lại
    		return redirect('/');
    	else
    	{
    	 /*gọi 2 biến này để nó cập nhật lại giỏ hàng của chúng ta khi thêm*/
    	$content=Cart::content(); 
        $total=Cart::total();
        $comment=Comment::Where('book_id',$book_detail->id)->orderby('created_at','DESC')->paginate(10);
    	 $sach_cung_danh_muc=Book::where([['category_id',$book_detail->category_id],['id','<>',$book_detail->id]])->get();
    	 return View('site.pages.book_detail',compact('book_detail','sach_cung_danh_muc','content','total','comment'));
    	}
    }
  // TIM KIẾM SÁCH LIÊN QUAN TIÊU ĐỀ VÀ TÓM TẮT
    public function getSearch($tukhoa)
    {
        /*gọi 2 biến này để nó cập nhật lại giỏ hàng của chúng ta khi thêm*/
        $content=Cart::content(); 
        $total=Cart::total();
        if($tukhoa=='')
            return redirect('/');
        else
        {
            $books=Book::where([['title','like',"%$tukhoa%"],['published','=',1]])->orwhere([['info','like',"%$tukhoa%"],['published','=',1]])->orwhere([['content','like',"%$tukhoa%"],['published','=',1]])->orderby('created_at','DESC')->paginate(20);
            if(count($books)==0)  // khi không tìm thấy
            {
                $books=Book::where('published',1)->orderby('created_at','DESC')->paginate(20);
            }
            
            return View('site.pages.search',compact('content','total','books','tukhoa'));
        }
    }
    public function postSearch()
    {
        $tukhoa=Request::Input('q');
          if($tukhoa=='')  // nếu không nhập gì mà enter trong thanh tìm kiếm cho nó quay lại trang trước
          {
             return redirect()->back();  // quay về trang trước (nghĩa là trang hiện tại nó đang đứng)
          }
          // còn có nhập thì tới get tìm kiếm với giá trị từ khóa nhập vào
          return redirect()->route('gettimkiem',$tukhoa);
    }
  // TÌM KIẾM THEO DANH MỤC
    public function timtheodanhmuc($tendanhmuc)
    { // do ta giở lên "http://localhost:8080/laravel-sach/tim-kiem-theo-danh-muc/tukhoa="+slug,
      // nên lúc này nó đã hiểu tendanhmuc là slug rồi nên ta ko cần gán tendanhmuc bằng slug nữa
        $cate=Category::where('slug',$tendanhmuc)->first();
        if(count($cate)==0) // nếu tào lao trỏ tới trang chủ lại
            return redirect('/');
        else
        {
         /*gọi 2 biến này để nó cập nhật lại giỏ hàng của chúng ta khi thêm*/
            $content=Cart::content(); 
            $total=Cart::total();
         $id_parent=tim_id_parent($cate); // để hiện category ở phía trái của trang(tìm cate cha gốc đó)
         $danh_muc_sach=Sach_Theo_TheLoai($cate->id);
         return View('site.pages.search_danhmuc',compact('cate','danh_muc_sach','id_parent','content','total'));
        }

    }
   //======================	THAO TÁC VỚI GIỎ HÀNG ====================================
   //========================XÂY DỰNG GIỎ HÀNG===========================
  /*
    public function MuaHang($id)  // KHI CLICK VÀO GIỎ HÀNG
    {
            $book_buy=Book::where('id',$id)->first();
            // THÊM VÀO GIỎ HÀNG
            // 'qty' là biến số lượng ta quy định khi click vào thì luôn luôn là 1 được đưa vào giỏ hàng
           Cart::add(array('id'=>$book_buy->id,'name'=>$book_buy->title,'qty'=>1,'price'=>$book_buy->sale_price,'options'=>array('img'=>$book_buy->image))); // giá tiền là giá bìa nha chứ ko phải giá gốc  
            $content=cart::content(); //nó có chưa rowid được dùng để xóa và sửa giỏ hàng
            // hàm này nó sẽ cho ta một mảng giá trị : rowid (tự có), id, name ,qty (bắt buộc cart phải có,price), price : là của cart tự có .... ta muốn định nghĩa các giá trị khác thì tạo 'option'.... 
            
            return redirect()->route('giohang')->with(['flash_level'=>'success','flash_message'=>'Complete Success insert cart']);
    }
  */
    public function MuaHang($id,$slug)  // KHI CLICK VÀO GIỎ HÀNG
    {
        if(Request::ajax()){
            $book_buy=Book::where('id',$id)->first();
            Cart::add(array('id'=>$book_buy->id,'name'=>$book_buy->title,'qty'=>1,'price'=>$book_buy->sale_price,'options'=>array('img'=>$book_buy->image))); // giá tiền là giá bìa nha chứ ko phải giá gốc  
            $content=cart::content(); //nó có chưa rowid được dùng để xóa và sửa giỏ hàng
            // hàm này nó sẽ cho ta một mảng giá trị : rowid (tự có), id, name ,qty (bắt buộc cart phải có,price), price : là của cart tự có .... ta muốn định nghĩa các giá trị khác thì tạo 'option'.... 
            return redirect()->route('giohang')->with(['flash_level'=>'success','flash_message'=>'Complete Success insert cart']);
        }
    }
    // GIỎ HÀNG
    public function GioHang()
    {
        $content=Cart::content(); // mảng danh sách các sản phẩm nằm trong giỏ hàng của chúng ta
        $total=Cart::total();
        if(Session::has('payment_coupon'))
        {
        	$tongtien=$total;
        	$tienphaitra=$total-$total*(Session::get('payment_coupon.percent_coupon')/100);  // số tiền còn lại sau khi giảm giá
        	return View('site.pages.cart',compact('content','tienphaitra','total','tongtien'));
        }
        return View('site.pages.cart',compact('content','total'));
    }
    // CẬP NHẬT GIỎ HÀNG
    public function CapNhatGioHang($rowid)
    {
        if(Request::ajax()){ // nếu có sử dụng biến ajax được gọi tới thì thực hiện
        	$rowid=Request::get('rowid');
        	$qty=Request::get('qty');
        	// thực hiện cập nhật lại giỏ hàng;
        	Cart::update($rowid,$qty);  
            return "ok";
        }
    }
    // XÓA GIỎ HÀNG
    public function XoaHang($rowid)
    {
    	if(Request::ajax()){ // nếu có sử dụng biến ajax được gọi tới thì thực hiện
        	$rowid=Request::get('rowid');
        	Cart::remove($rowid); 
            return "ok";
        }
    }
    // XÓA TẤT CẢ SẢN PHẨM TRONG GIỎ
   public function XoaTatCaHang(){
        Cart::destroy();
        return redirect()->route('giohang')->with(['flash_level'=>'success','flash_message'=>'Complete Success delete cart']);
   }
  // THÊM MÃ GIẢM GIÁ KHI THANH TOÁN ĐƠN HÀNG
  public function postGiamGia(Request $request)
  {
 
  		$this->validate(Request::instance(),
  			[
  				'ma_giam_gia'=>'required'
  			],
  			[
  				'ma_giam_gia.required'=>'Bạn chưa nhập mã giảm giá !'
  			]
  		);
  	// khi không có lỗi
  	$code=Request::Input('ma_giam_gia');
    // kiểm tra thử cái mã đó có trong csdl không nếu ko thì báo lỗi 
    $coupon=Coupon::where('code',$code)->first();
    if(count($coupon)>0) // nếu có mã giảm giá
    {
    	// kiểm tra thử mã giảm giá đó còn thời hạn hay không
    	$today=date('Y-m-d H:i:s');
    	if($today>= $coupon->time_start && $today<=$coupon->time_end) // nếu mã thỏa mãn
    	{
    			// lưu lại thông tin giảm giá
    		// tạo ra một mảng chứa các thông tin về giảm giá
    		
    	//	$total=Cart::total();  // tổng tiền hiện tại
    	//	$pay=$total-$total*($coupon->percent/100);  // số tiền còn lại sau khi giảm giá ko lưu nữa vì khi ta thêm giỏ hàng vào lúc này nó cố định ta chỉ lưu mã code với số phần trăm giảm giá thôi
			//===========GỌI MẢNG SESSION CỦA CHÚNG TA
    	//session(['code_coupon'=>$coupon->code,'percent_coupon'=>$coupon->percent]); // lưu các giá trị session riêng lẻ
    	session(array('payment_coupon.code_coupon'=>$coupon->code,'payment_coupon.percent_coupon'=>$coupon->percent)); // lưu các giá trị vào mảng session payment_coupon // khi ra view ta có thể gọi như thê này : {{Session::get('code_coupon')}} hoặc {{Session::get('payment_coupon.percent_coupon')}} đều như nhau nhé
    		return redirect()->route('giohang')->with(['flash_level'=>'success','flash_message'=>'Đã thêm mã giảm giá !']);
    	}
    	
    	else // nếu không thỏa
    	{
    			return redirect()->route('giohang')->with(['flash_level'=>'danger','flash_message'=>'Mã Giả Giá Bạn Nhập vào đã hết hạn sử dụng !']);
    	}

    }
    else
    {
    	return redirect()->route('giohang')->with(['flash_level'=>'danger','flash_message'=>'Mã Giả Giá Bạn Nhập vào Không Hợp Lệ !']);
    }
  }
   // check out
    public function CheckOut()
    {
    	$content=Cart::content(); 
        $total=Cart::total();
    	return View('site.pages.checkout',compact('content','total'));
    }

  // THAO TÁC LIÊN QUAN TỚI ĐĂNG KÝ ĐĂNG NHẬP ĐĂNG XUẤT USER
    public function getLogin()
    {
        $content=Cart::content(); 
        $total=Cart::total();
        return View('site.pages.login',compact('content','total'));
    }
    public function postLogin()
    {
        // do ta sử dụng use Request nên ko cần gọi Request trên postLogin nếu chưa có thì thực hiện khác nhan
        $this->validate(Request::instance(),
                [
                    'username'=>'required',
                    'password'=>'required'
                ],
                [
                    'username.required'=>'Username chưa nhập!',
                    'password.required'=>'Mật khẩu chưa nhập!'
                ]
            );

        // thực hiện kiểm tra
        $user_login=[
            'username'=>Request::Input('username'),
            'password'=>Request::Input('password')  // sử dụng Auth:attempt mật khẩu ko cần hash 1 lần nữa
        ];
        // nếu như đăng nhập thành công
        if(Auth::attempt($user_login))
        {
                return redirect()->back(); // vẫn ở trang hiện tại
        }
        else
        {
                return redirect()->route('getlogin')->with(['flash_level'=>'danger','flash_message'=>'Tài khoản hoặc mật khẩu không đúng!']);
        }
    }

    public function getRegister()
    {

        $content=Cart::content(); 
        $total=Cart::total();
        return View('site.pages.register',compact('content','total'));
    }

    public function postRegister(){
         $this->validate(Request::instance(),
                [
                    'username'=>'required|min:5|regex:/^[a-zA-Z0-9-_]+$/|unique:users,username',
                    'password'=>'required|min:5',
                    'repassword'=>'required|same:password',
                    'email'=>'required|email|unique:users,email',
                    'firstname'=>'required|min:3',
                    'lastname'=>'required|min:3',
                    'txtdiachi'=>'required',
                    'txtPhone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:13|unique:users,phone_number'
                ],
                [
                    'username.required'=>'Tên Username chưa nhập!',
                    'username.min'=>'Tên Username không được nhỏ hơn 5 ký tự',
                    'username.regex'=>'Tên Username Chứa những ký tự không hợp lệ!',
                    'username.unique'=>'Tên Usrname đã được sử dụng rồi!',
                    'password.required'=>'Mật khẩu chưa nhập',
                    'password.min'=>'Mật khẩu không được nhỏ hơn 5 ký tự',
                    'repassword.required'=>'Mât khẩu xác nhận không được bỏ trống',
                    'repassword.same'=>'Mật khẩu xác nhận chưa đúng',
                    'email.required'=>'Email chưa nhập',
                    'email.email'=>'Email chưa đúng định dạng',
                    'email.unique'=>'Email đã được sử dụng rồi!',
                    'firstname.required'=>'firstname chưa nhập',
                    'firstname.min'=>'firstname ko được nhỏ hơn 3 ký tự',
                    'lastname.required'=>'Lastname chưa nhập',
                    'lastname.min'=>'Lastname ko được nhỏ hơn 3 ký tự',
                    'txtdiachi.required'=>'Địa chỉ chưa nhập kìa!',
                    'txtPhone.required'=>'Chưa nhập số điện thoại',
                    'txtPhone.regex'=>'chưa đúng định dạng phone number',
                    'txtPhone.min'=>'phone number phải có ít nhất 11 số',
                    'txtPhone.max'=>'phone number chỉ được tối đa 13 số',
                    'txtPhone.unique'=>'phone number đã tồn tại'

                ]
            );
         // khi kiểm tra lỗi xong tiến hành thêm vào csdl
         $user= new User; // tạo ra 1 đối tượng user trong csdl
         // luu vào
         $user->group_id=2; // nhóm người dùng bình thường
         $user->username=Request::Input('username');
         $user->password=Hash::make(Request::Input('password'));
         $user->email=Request::Input('email');
         $user->firstname=Request::Input('firstname');
         $user->lastname=Request::Input('lastname');
         $user->address=Request::Input('txtdiachi');
         $user->address=Request::Input('txtdiachi');
         $user->phone_number=Request::Input('txtPhone');
         $user->remember_token=Request::Input('_token');
         // thực thi csdl
         $user->save();
         // Cách 1 đăng ký thành công xong tự động đăng nhập luôn
        /* 
         $thongtin_login=[
                'username'=>Request::Input('username'),
                'password'=>Request::Input('password')
         ];
         if(Auth::attempt($thongtin_login))
            {
                    return redirect('/');
            }
        */
        
         // Cách 2 thông báo đăng ký thành công
         return redirect()->route('get_register')->with(['flash_level'=>'success','flash_message'=>'Đăng ký thành công! bạn có thể đăng nhập tài khoản vào hệ thống']);
    }

    // ĐĂNG XUẤT
    public function Logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // ===================QUÊN MẬT KHẨU
    public function getForgetPassword(){

        $content=Cart::content(); 
        $total=Cart::total();
        return View('site.pages.quen_matkhau',compact('content','total'));
    }

    public function postForgetPassword()
    {
         $this->validate(Request::instance(),
            [
                'email'=>'required|email',
            ],
            [
                'email.required'=>'Email chưa nhập',
                'email.email'=>'Email chưa đúng định dạng'
            ]
            );
        $user=User::where('email',Request::Input('email'))->first();
        if(count($user))   // nếu như nhập được email đã đăng ký trên hệ thống thì
        {
                // gửi 1 link xác nhận
            $code=generate_code();
                // tạo ra 1 link xác thực
            $link_confirm="http://localhost:8080/laravel-sach/user/xac-nhan/".$code;  // trong csdl ta thực hiện lưu một mã xác nhận trong bảng user vì thế ta tao ra 1 trường nữa trong user
            // lưu mã code này vào csdl với id=user->id
            $user->code_forget_pass=$code;
            // lưu lại
            $user->save();  // cách làm này giống như cạp nhật lại trường code_forget_pass với id=user->id
            return redirect()->route('get_forget_pass')->with(['flash_level'=>'success','flash_message'=>'Vui lòng kiểm tra hộp thư để xác nhận yêu cầu - hoặc click'.'<a href="'.$link_confirm.'"><span class="btn-link"> Xác Nhận </span> </a> để thực hiện thay đổi mật khẩu mới']);  // do ta dùng localhost nên để xác nhận ta hiện lên luôn (nếu trên host thì ta gửi mail tới email rồi vào email click vào xác nhận)
        }
        else
        {
            return redirect()->route('get_forget_pass')->with(['flash_level'=>'danger','flash_message'=>'Email này chưa được đăng ký!']);
        }
    }
    // xác nhận yêu cầu khi quên mật khẩu
    public function getConfirm($code_pass_forget)
    {
        $content=Cart::content();
        $total=Cart::total();
        $user=User::where('code_forget_pass',$code_pass_forget)->first();
        if(count($user))  // nếu mã xác nhận đúng chuyển tới view xác nhận
        {
            return View('site.pages.confirm',compact('content','total','code_pass_forget'));
        }
        else
        {
            return redirect('/');
        }
    }
    public function postConfirm($code_pass_forget)
    {
        $this->validate(Request::instance(),
                [
                    'password'=>'required|min:5',
                    'repassword'=>'required|same:password'
                ],
                [
                    
                    'password.required'=>'Mật khẩu chưa nhập',
                    'password.min'=>'Mật khẩu không được nhỏ hơn 5 ký tự',
                    'repassword.required'=>'Mật khẩu xác nhận không được bỏ trống',
                    'repassword.same'=>'Mật khẩu xác nhận chưa đúng'
                ]
            );
        // không có lỗi gì thì thực hiện đổi lại mật khẩu cho người dùng với email được nhập vào
        $user=User::where('code_forget_pass',$code_pass_forget)->first();
        $user->password=Hash::make(Request::Input('password'));
        // thực hiện xóa mã code có trong csdl khi thay đổi mật khẩu thành công
        $user->code_forget_pass=NULL;
        $user->save(); // cập nhật lại csdl
        // chuyển tới trang login
        return redirect()->route('login')->with(['flash_level'=>'success','flash_message'=>'Cấp Mật khẩu thành công ! bạn có thể đăng nhập bằng mật khẩu vừa được cấp!']);
    }

    //======================= =========================
    public function UserComment($book_id)
    {
        if(Request::ajax()){
            $user_id=$_GET["user_id"];
          
            $content=$_GET["content"];
            // thêm vào csdl
            $comment=new Comment;
            $comment->user_id=$user_id;
            $comment->book_id=$book_id;
            $comment->content=$content;
            $comment->save();
            $id=$comment->id;
            // lấy ra comment của thằng vừa được thêm
            $comment_insert=Comment::where('book_id',$book_id)->orderby('created_at','DESC')->first();
            $user=User::find($user_id);
            echo '<div class="comment-item">';
            echo '<div class="media">
                    <div class="media-left"><a href="#"><img src="http://localhost:8080/laravel-sach/public/site/images/avatar.png"></a></div>
                            <div class="media-body">
                                <div class="comment-title">'.$user->firstname." ".$user->lastname.'</div>
            <div class="comment-date">'.date("d-m-Y H:i:s",strtoTime($comment_insert->created_at)).'</div>'.$comment_insert->content.'</div>
                                </div>';
           echo '</div>';
        }
    }
}
