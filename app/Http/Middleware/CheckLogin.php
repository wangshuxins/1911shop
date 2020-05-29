<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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

		$admin = session('admin');
        //$admin = session(null);
        

		if(!$admin){
			$cookie_admin = Request()->cookie('admin');
			//dd($cookie_admin);
			if($cookie_admin){
			//echo 'cookie';
            session(['admin'=>unserialize($cookie_admin)]);
			
			}else{
			
			return redirect('/login');
			
			}
		   
		}
        return $next($request);
    }
}
