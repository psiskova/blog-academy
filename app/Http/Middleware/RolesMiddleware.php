<?php

namespace App\Http\Middleware;

use Closure;

class RolesMiddleware {

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $roles
     * @return mixed
     */
    public function handle($request, Closure $next, $roles) {
        foreach (str_split($roles) as $role) {
            if ($request->user()->hasRole($role)) {

                return $next($request);
            }
        }

        return redirect('/');
    }
}