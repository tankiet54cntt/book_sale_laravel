<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class NotLoginMiddleware
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
        if(Auth::check())  // nếu như đã đăng nhập
        {
            return redirect('/'); // cho nó về trang chủ của chúng ta
        }
        else  // ngược lại thì sẽ chạy tới trang mà ta muốn tới
        {
            return $next($request);
        }
    }
}
