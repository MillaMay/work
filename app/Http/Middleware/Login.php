<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Session;

class Login //Этот посредник дает возможность не открывать на каждой странице session_start()
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Session::get('auth');

        if ($user) {
            if ($user['type'] == 'trainer') {
                return $next($request);
            } elseif ($user['type'] == 'member') {
                return $next($request);
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
}
//Не забыть про алияс в Kernel
