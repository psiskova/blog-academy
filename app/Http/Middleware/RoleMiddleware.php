<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware {

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role) {
        $logged = \Auth::check();

        if ($logged && !$request->user()->hasRole($role)) {

            flash()->error('Nemáte oprávnenie na vykonanie akcie');
            return redirect('/');
        }

        return $next($request);
    }
}
