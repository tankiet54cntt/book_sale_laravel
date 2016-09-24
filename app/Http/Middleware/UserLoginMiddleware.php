<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class UserLoginMiddleware
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

      if(Auth::check())  // nếu như đã đăng nhâp
        return $next($request);
      else
        return redirect('/');// quay về trang đăng nhập
    }
}
