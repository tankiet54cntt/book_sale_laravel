<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cart;
use Session;
use App\Order;
use App\Category;
use App\Book;
use Auth;
class OrdersController extends Controller
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
         $tool=NULL;
        View()->share('tool',$tool);
	 // tổng tiền trong giỏ hàng

	}
    public function postCheckOut(Request $request)
    {
      if(Auth::check()){
    	$this->validate($request,[
    			'txtFirstname'=>'required|min:3',
                'txtLastname'=>'required|min:3',
    			'txtEmail'=>'required|email',
                'txtdiachi'=>'required',
    			'txtPhone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:13'
    		],
    		[
    			'txtFirstname.required'=>'Phải có Firstname',
    			'txtFirstname.min'=>'Tên Firstname Phải > 3 ký tự',
                'txtLastname.required'=>'Phải có Lastname',
                'txtLastname.min'=>'Tên Lastname Phải > 3 ký tự',
    			'txtEmail.required'=>'Email chưa nhập kìa !',
    			'txtEmail.email'=>'Email Không hợp lệ',
                'txtdiachi.required'=>'Địa Chỉ không được bỏ trống',
    			'txtPhone.required'=>'Chưa nhập số điện thoại',
    			'txtPhone.regex'=>'chưa đúng định dạng số điện thoại',
    			'txtPhone.min'=>'phone number phải có ít nhất 11 số',
    			'txtPhone.max'=>'phone number phải có tối đa 13 số'
    		]);
    	
    	$content=Cart::content();
    	$total=Cart::total();
  if(count($content) > 0){  // nếu như trong giỏ có sách thì mới thực hiện check out
    // tạo ra đối tượng order
    	 $order= new Order;
        //print_r(json_encode($content));
    	// tạo ra một đối tượng mảng để lưu cho trường customer_info (do nó ở dang text nên ta dùng json_endcode($customer_info)) khi gọi lại ta dùng json_decode($customer_infor->ten hoặc email)
        $customer_info=array(
    			'ten'=>$request->txtName,
    			'email'=>$request->txtEmail,
    			'diachi'=>$request->txtdiachi,
    			'phone'=>$request->txtPhone
    		);
    //	echo json_encode($customer_info);
    	if(Session::has('payment_coupon'))
        {
        	$tongtien=$total;
        	$total=$total-$total*(Session::get('payment_coupon.percent_coupon')/100);
        	$payment_info=array(
        			'total'=>$tongtien,
        			'tienphaitra'=>$total,
        			'code'=>Session::get('payment_coupon.code_coupon'),
        			'percent'=>Session::get('payment_coupon.percent_coupon')
        		);
        	$order->payment_info=json_encode($payment_info);
        }
        else
        {
        	$payment_info=array(
        			'tienphaitra'=>$total);
        	$order->payment_info=json_encode($payment_info);
        }
       
        $order->user_id=Auth::user()->id;
        $order->customer_info=json_encode($customer_info); // do dữ liệu customer_infor ta lưu dưới dạng text nên ta ép nó về kiểu json dạng text // khi gọi nó là thì decode thôi
        $order->order_info=json_encode($content);
        $order->status=0; // 0 : đang xử lý 1 : đã xử lý  2 : hủy
      //  echo $order->payment_info;
        Session()->forget('payment_coupon');  // xóa session mã code giảm giá;
   	    $order->save();
   	    Cart::destroy(); // xóa hết tất cả các sản phẩm trong giỏ
   	    return redirect()->route('lichsumuahang')->with(['flash_level'=>'success','flash_message'=>'Đã thực hiện thanh toán đang chờ xử lý !']);
       }
    else
        {
            return redirect()->route('giohang')->with(['flash_level'=>'danger','flash_message'=>'Trong giỏ không có sản phẩm nào, Không thực thi thanh toán được']);
        }
    }
    else
    {
        return redirect()->route('getlogin');
    }
  }
    public function History()
    {
    	$content=Cart::content();
    	$total=Cart::total();
    	$orders=Order::where('user_id',Auth::user()->id)->orderby('created_at','DESC')->get(); // mảng đối tượng
    //	$string = '{"ten":"t\u1ea5n ki\u1ec7t","email":"tankiet@gmail.com","diachi":"ninh l\u00e2m","phone":"01686947816"}'; $mang=json_decode($tring,true); echo $mang['email']
      /*
        foreach ($orders as $key => $item) {
           echo json_decode($item['customer_info'])->email."<br>";
        }
       die;
      */
    	return View('site.pages.history_shopping',compact('content','total','orders'));
    }

    public function Detail($id)
    {
        $content=Cart::content();
        $total=Cart::total();
        $order=Order::find($id);
        if(count($order)>0)  // nếu như có đơn hàng
        {
            // nếu như đơn hàng của người mình đang đăng nhập 
            if(Auth::user()->id==$order->user_id)
            {
                    $books=json_decode($order->order_info); // ;lưu vào một mảng sách được chuyển thành json_decode từ order_info của đơn hàng
                    //print_r($books);
                    // nếu như trang trái bằng 1 thì mới hiện linkdownload
                    if($order->status==1)
                    {
                        foreach ($books as $key => $book) 
                        {
                            $result=Book::find($book->id);
                            $link[$book->id]=$result->link_download;    
                        }
                    }
            }

            return View('site.pages.chitiet_donhang',compact('order','link','books','content','total'));
        }
        else  // khi người dùng nhập vào đơn hàng khác của họ thì quay lại trang lịch sử mua hàng của người đó
        {
            return redirect()->route('lichsumuahang');
        }
    }


    public function ChoThanhToan(){
            $don_hang_cho=Order::where('status',0)->orderby('created_at','ASC')->get();
        return View('admin.layout.home',compact('don_hang_cho'));
    }

    public function Duyet1DonHang($order_id)
    {
        $hang_duyet=Order::find($order_id);

        $hang_duyet->status=1;
        $hang_duyet->save();
        // chuyển hướng về index
        return redirect()->route('chothanhtoan')->with(['flash_level'=>'success','flash_message'=>'Đơn hàng đã được Thanh Toán']);
    }

    public function DuyetTatCaDonHang(Request $request)
    {
        $this->validate($request,[
                'checktin'=>'required'
            ],
            [
                'checktin.required'=>'chưa click chọn tất cả nên không thực hiện được'
            ]);
        // duyệt tất cả đồng nghĩa với việt những tin nào có trang thái =2 thì duyệt
        $hang_duyet=Order::where('status',0)->get();
        foreach($hang_duyet as $tt)
        {
            $tt->status=1;
            $tt->save();
        }
        // chuyển hướng về index
        return redirect()->route('chothanhtoan')->with(['flash_level'=>'success','flash_message'=>'Tất Cả Đơn Hàng đã được thanh toán']);
    }


    public function HuyDonHangChoDuyet($order_id)
    {
        $hang_cho_duyet=Order::find($order_id);
        // xóa ảnh đại diện
        $hang_cho_duyet->status=2;
        $hang_cho_duyet->save();
        // chuyển hướng về index
        return redirect()->route('chothanhtoan')->with(['flash_level'=>'success','flash_message'=>'Đơn hàng đã được Hủy']);
    }
}
