<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Group;
use Hash;
use Auth;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=User::orderby('id','DESC')->get();
        return View('admin.users.list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group=Group::all();
        return View('admin.users.add',compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
                [
                //
                    'txt_username'=>'required|min:5|regex:/^[a-zA-Z0-9-_]+$/|unique:users,username',
                    'txt_password'=>'required|min:5',
                    'txt_email'=>'required|email|unique:users,email',
                    'txt_firstname'=>'required|min:3',
                    'txt_lastname'=>'required|min:3',
                    'txt_address'=>'required',
                    'txt_phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:13'
                ],
                [
                    'txt_username.required'=>'Tên User name được bỏ trống',
                    'txt_username.min'=>'Tên User name ít nhất 5 ký tự',
                    //'txt_username.alpha'=>'Tên User name Chứa những ký tự không hợp lệ !', // tránh nhập dấu khoảng cách
                    'txt_username.regex'=>'Tên User name Chứa những ký tự không hợp lệ !', // tránh 1 số ký tự đặc biệt và có dấu
                    'txt_username.unique'=>'Tên User name đã tồn tại',
                    'txt_password.required'=>'Password không được bỏ trống',
                    'txt_password.min'=>'Password không được nhỏ hơn 5 ký tự',
                    'txt_email.required'=>'Email không bỏ trống',
                    'txt_email.email'=>'Chưa đúng định dạng Email',
                    'txt_email.unique'=>'Email đã tồn tại',
                    'txt_firstname.required'=>'first name không được bỏ trống',
                    'txt_firstname.min'=>'First name ít nhất 3 ký tự',
                    'txt_lastname.required'=>'last name không được bỏ trống',
                    'txt_lastname.min'=>'last name ít nhất 3 ký tự',
                    'txt_address.required'=>'Địa chỉ không được bỏ trống',
                    'txt_phone.required'=>'Phone không được bỏ trống',
                    'txt_phone.regex'=>'chưa đúng định dạng phone number',
                    'txt_phone.unique'=>'phone number đã tồn tại',
                    'txt_phone.min'=>'phone number phải có 11 số',
                    'txt_phone.max'=>'phone number chỉ được tối đa 13 số',
                ]
            );

        $user= new User;
        $user->group_id=$request->sltParent;
        $user->username=$request->txt_username;
        $user->password=Hash::make($request->txt_password);
        $user->email=$request->txt_email;
        $user->firstname=$request->txt_firstname;
        $user->lastname=$request->txt_lastname;
        $user->address=$request->txt_address;
        $user->phone_number=$request->txt_phone;
        $user->remember_token=$request->_token;
        $user->save();
        // chuyển tới trang list user
        return redirect()->route('users.index')->with(['flash_level'=>'success','flash_message'=>'Thêm Thành Công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group=Group::all();
        $user_edit=User::findOrFail($id);
        return View('admin.users.edit',compact('group','user_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
                [
                //
                    'txt_username'=>'required|min:5|regex:/^[a-zA-Z0-9-_]+$/',
                    'txt_email'=>'required|email',
                    'txt_firstname'=>'required|min:3',
                    'txt_lastname'=>'required|min:3',
                    'txt_address'=>'required',
                    'txt_phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:13|unique:users,phone_number'
                ],
                [
                    'txt_username.required'=>'Tên User name được bỏ trống',
                    'txt_username.min'=>'Tên User name ít nhất 5 ký tự',
                    'txt_username.regex'=>'Tên User name Chứa những ký tự không hợp lệ !', // tránh 1 số ký tự đặc biệt và có dấu
                    'txt_email.required'=>'Email không bỏ trống',
                    'txt_email.email'=>'Chưa đúng định dạng Email',
                    'txt_firstname.required'=>'first name không được bỏ trống',
                    'txt_firstname.min'=>'First name ít nhất 3 ký tự',
                    'txt_lastname.required'=>'last name không được bỏ trống',
                    'txt_lastname.min'=>'last name ít nhất 3 ký tự',
                    'txt_address.required'=>'Địa chỉ không được bỏ trống',
                    'txt_phone.required'=>'Phone không được bỏ trống',
                    'txt_phone.regex'=>'chưa đúng định dạng phone number',
                    'txt_phone.min'=>'phone number phải có 11 số',
                    'txt_phone.max'=>'phone number chỉ được tối đa 13 số',
                    'txt_phone.unique'=>'phone number đã tồn tại'
                ]
            );

        $user=User::findOrFail($id);
        // nếu có dấu checkpassword
        if($request->checkpassword!="")
        {
            $this->validate($request,
                [
                    'txt_password'=>'required|min:5',
                    'txtRePass'=>'required|min:5|same:txt_password'
                ],
                [
                    'txt_password.required'=>'Password không được bỏ trống',
                    'txt_password.min'=>'Password không được nhỏ hơn 5 ký tự',
                    'txtRePass.required'=>'Mật Khẩu xác nhận không bỏ trống',
                    'txtRePass.min'=>'Password Xác nhận không được nhỏ hơn 5 ký tự',
                    'txtRePass.same'=>'Two Password don\'t Match'
                ]
            );

            $user->password=Hash::make($request->txt_password);
        }

        $user->group_id=$request->sltParent;
        $user->username=$request->txt_username;
        $user->email=$request->txt_email;
        $user->firstname=$request->txt_firstname;
        $user->lastname=$request->txt_lastname;
        $user->address=$request->txt_address;
        $user->phone_number=$request->txt_phone;
        $user->remember_token=$request->_token;
        $user->save();

        // chuyển tới trang list user
        return redirect()->route('users.index')->with(['flash_level'=>'success','flash_message'=>'Sửa Thành Công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        // chuyển tới trang list user
        return redirect()->route('users.index')->with(['flash_level'=>'success','flash_message'=>'Xóa Thành Công']);
    }

    //===============XỬ LÝ ĐĂNG NHẬP USER ADMIN
   // get
    public function getDangNhap()
    {
        return View('admin.login');
    }
  // post
    public function postDangNhap(Request $request)
    {
        $this->validate($request,
                [
                    'username'=>'required',
                    'password'=>'required'
                ],
                [
                    'username.required'=>'Chưa nhập UserName',
                    'password.required'=>'Chưa nhập Password'
                ]
            );
        // thực hiện kiểm tra
        $user_login=[
            'username'=>$request->username,
            'password'=>$request->password
        ];
        // nếu như đăng nhập thành công
        if(Auth::attempt($user_login))
        {
                // do quyền ta quy định ở group nên ta kiểm tra đăng nhập thành công quyền gì
                // nếu quản trị thì vào admin và ngược lại về trang chủ
            $group_id=Auth::user()->group_id;
            $check=Group::where([['id',$group_id],['level',1]])->first();
            if(count($check) !=0)  // nếu là nhóm quản trị
            {
                return redirect('admin/');
            }
            else
            {
                return redirect('/');
            }
        }
        else  // đăng nhập chưa đúng
        {
            
            return redirect()->route('getDangNhap')->with(['flash_message'=>'Tài Khoản hoặc mật khẩu không đúng']);
        }
    }
  // Đăng Xuất
    public function getDangXuat()
    {
        Auth::logout();
        return redirect()->route('getDangNhap');
    }
}
