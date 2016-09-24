<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/','PagesController@Home');  // TRANG CHỦ
Route::get('lien-he','PagesController@getLienHe')->name('getlienhe');  // TRANG LIÊN HỆ
Route::post('lien-he','PagesController@postLienHe')->name('lienhe');
Route::get('sach-moi','PagesController@SachMoi')->name('sachmoi'); // TRANG SÁCH MỚI
Route::get('sach-ban-chay','PagesController@SachBanChay')->name('sachbanchay'); // TRANG SÁCH MỚI
Route::get('danh-muc/{slug}','PagesController@Cate')->name('danhmuc');  // TRANG DANH MỤC SÁCH
Route::get('sach/{slug}','PagesController@Detail')->name('chitietsach');  // XEM CHI TIẾT MỘT CUỐN SÁCH
Route::get('tim-sach/tukhoa={tukhoa}','PagesController@getSearch')->name('gettimkiem');  // TÌM KIẾM SÁCH
Route::post('tim-sach','PagesController@postSearch')->name('timkiem');

Route::get('sach-giam-gia','PagesController@SachGiamGia')->name('sachgiamgia');
// SỬ DỤNG AJAX
Route::get('tim-kiem-theo-danh-muc/tukhoa={tendanhmuc}','PagesController@timtheodanhmuc')->name('timtheodanhmuc');  // TÌM KIẾM SÁCH THEO DANH MỤC
Route::get('sap-xep/{luachon}','PagesController@SapXep');
Route::get('comment/{book_id}','PagesController@UserComment');





Route::get('tac-gia','PagesController@TacGia')->name('tacgia');

Route::get('checkout','PagesController@CheckOut');


Route::get('admin/login/',['as'=>'getDangNhap','uses'=>'UsersController@getDangNhap'])->middleware('notlogin');
Route::post('admin/login/',['as'=>'DangNhap','uses'=>'UsersController@postDangNhap']);
Route::get('admin/logout',['as'=>'dangxuat_admin','uses'=>'UsersController@getDangXuat']);

Route::get('cho-thanh-toan','OrdersController@ChoThanhToan')->name('chothanhtoan');
// duyệt 1 bài
Route::get('duyet-don-hang/{order_id}',['as'=>'duyetdonhang','uses'=>'OrdersController@Duyet1DonHang']);
	   // duyệt tất cả
Route::post('duyet-tat-ca',['as'=>'duyettatca','uses'=>'OrdersController@DuyetTatCaDonHang']);

Route::get('huy-don-hang/{order_id}',['as'=>'huydonhang','uses'=>'OrdersController@HuyDonHangChoDuyet']);
Route::group(['prefix'=>'admin','middleware'=>'adminlogin'],function(){

		Route::get('/',function(){
				return redirect()->route('chothanhtoan');;
		})->name('quangtri');
		Route::resource('categories','CategoriesController');
		Route::resource('writers','WritersController');
		Route::resource('groups','GroupsController');
		Route::resource('users','UsersController');
		Route::resource('books','BooksController');

	});
///====================LIÊN QUAN TỚI MUA HÀNG - THÊM , SỬA XÓA GIỎ HÀNG , XEM CHI TIET ĐƠN HÀNG,LỊCH SỬ MUA HÀNG===========================
		//==================GIỎ HÀNG=========================
// CLICK THÊM VÀO GIỎ (mua hàng)
Route::get('mua-hang/{id}/{slug}','PagesController@MuaHang')->name('muahang');
// THAO TÁC VỚI GIỎ HÀNG
Route::get('gio-hang','PagesController@GioHang')->name('giohang');
Route::get('sua-hang/{rowid}','PagesController@CapNhatGioHang')->name('suahang');
Route::get('xoa-hang/{rowid}','PagesController@XoaHang')->name('xoahang');
Route::get('xoa-all','PagesController@XoaTatCaHang')->name('xoahethang');
// THÊM MÃ GIẢM GIÁ KH THANH TOÁN NẾU CÓ 
Route::post('giam-gia','PagesController@postGiamGia')->name('giamgia');
	//==================== LIÊN QUAN TỚI THANH TOÁN==============================
// MIDDLEWARE ĐỂ KIỂM TRA THỬ NGƯỜI DÙNG ĐĂNG NHẬP HAY CHƯA
Route::post('thanh-toan','OrdersController@postCheckOut')->name('thanhtoan');
// lịch sử mua hàng
Route::get('lich-su-mua-hang','OrdersController@History')->name('lichsumuahang')->middleware('dadangnhap');
// chi tiết đơn hàng
Route::get('chi-tiet-don-hang/{id}','OrdersController@Detail')->name('chitietdonhang')->middleware('dadangnhap');
//====================ĐĂNG NHẬP - ĐĂNG KÝ - ĐĂNG XUẤT - NGƯỜI DÙNG

Route::group(['prefix'=>'user'],function(){
		// ĐĂNG NHẬP
		Route::get('login','PagesController@getLogin')->name('getlogin')->middleware('notlogin');
		Route::post('login','PagesController@postLogin')->name('login');
		// ĐĂNG KÝ
		Route::get('register','PagesController@getRegister')->name('get_register')->middleware('notlogin');
		Route::post('register','PagesController@postRegister')->name('register');
		// Logout
		Route::get('logout','PagesController@Logout')->name('logout');
		// Quên Mật Khẩu
		Route::get('quen-mat-khau','PagesController@getForgetPassword')->name('get_forget_pass')->middleware('notlogin');
		Route::post('quen-mat-khau','PagesController@postForgetPassword')->name('forget_pass');
		// xác thực yêu cầu : khi nhập mã xác nhận
		Route::get('xac-nhan/{code_pass_forget}','PagesController@getConfirm')->name('getxacnhan')->middleware('notlogin');
		Route::post('xac-nhan/{code_pass_forget}','PagesController@postConfirm')->name('xacnhan');
});
