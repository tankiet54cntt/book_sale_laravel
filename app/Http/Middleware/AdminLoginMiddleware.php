<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Group;
class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //xem thử nó đăng nhập chưa
        if(Auth::user()) // nếu có đăng nhập
        {
            // nếu là admin thì mới cho vào trang admin và ngược lại
            $group_id=Auth::user()->group_id;
            $check=Group::where([['id',$group_id],['level',1]])->first();
            if(count($check) !=0)  // nếu là nhóm quản trị
            {
                return $next($request);
            }
            else
            {
                return redirect('/');
            }
            
        }
        else
        {
            return redirect()->route('getDangNhap');
        }
    }
}
