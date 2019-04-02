<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class MustBeAppUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // TODO: Bruno está desenvolvendo este módulo
        //
        //        if (!Gate::allows('appUser')) {
        //            abort(403, 'Você não está autorizado a usar este sistema');
        //        }

        return $next($request);
    }
}
