<?php

namespace App\Http\Middleware;

use Closure;
use Flash;

class CheckForBanUser {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $response = $next($request);

        if (\Auth::check()) {
            $user = \Auth::user();
            if ($user->isBanned()) {
                \Auth::logout();
                if ($request->ajax()) {

                    return response('Unauthorized.', 401);
                } else {
                    flash()->error('Ban');

                    return redirect('/');
                }
            }
        }

        return $response;
    }
}