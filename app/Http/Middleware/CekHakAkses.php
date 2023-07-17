<?php

namespace App\Http\Middleware;

use Closure;

class CekHakAkses
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
        if ($request->input('token')=='12345'){
            return $next($request);
        }
       abort(403,'Gagal Akses Data !');
    }
}
