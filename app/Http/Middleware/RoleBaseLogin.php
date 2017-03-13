<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Utility;

class RoleBaseLogin
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
        $user_id = Auth::user()->id;
        $objUtility = new Utility;
        $roleName = $objUtility->getUserRoleName($user_id);
        if($roleName == 'JOB_POSTER'){
             return redirect('jobposter/home');
        }else if($roleName == 'JOB_SEEKER'){
             return redirect('jobseeker/home');
        }else if($roleName == 'sAdmin'){
             return redirect('admin/dashboard');
        }else{
           return redirect('login');
        }
        return $next($request);
    }
}
