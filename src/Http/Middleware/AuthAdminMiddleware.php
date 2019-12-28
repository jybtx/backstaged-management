<?php
namespace Jybtx\Backstaged\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdminMiddleware
{
	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	public function handle($request, Closure $next, $guard = null)
	{
          if ( !auth()->guard(config('backstaged.auth.guard'))->check() ) {
               if ($request->ajax() || $request->wantsJson()) {
                    return response('Unauthorized.', 401);
               } else {
                    return redirect()->guest(config('backstaged.route.prefix').DIRECTORY_SEPARATOR.'login');
               }
          }
		return $next($request);
	}
}