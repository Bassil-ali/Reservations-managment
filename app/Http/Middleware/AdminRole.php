<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminRole {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $role) {
		if(Auth::guard('client')->check()){
            return $next($request);
		}elseif(!admin()->user()->role($role)) {
			return redirect(aurl('need/permission'));
		}
		return $next($request);
	}
}
