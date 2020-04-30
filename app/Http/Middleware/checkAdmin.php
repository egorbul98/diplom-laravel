<?php

namespace App\Http\Middleware;

use Closure, Auth;

class checkAdmin
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
        $user = Auth::user();
        if($user->roles()->where("id", 2)->first()!=null){
            return $next($request);
        }else{
            return back()->withErrors(["errors"=>trans('messages.not_enough_rights')]);
        }
    }
}
