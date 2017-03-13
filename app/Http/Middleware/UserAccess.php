<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use DB;
use Closure,Utility;
use Illuminate\Http\Request;

class UserAccess
{
    protected $auth;
    protected $request;
    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     */
    public function __construct(Guard $auth,Request $req)
    {
        $this->request = $req;
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // here we are redirect user on their dashboard or front view
        $user_id = $this->auth->user()->id;
        $objUtility = new Utility;
        $roleName = $objUtility->getUserRoleName($user_id);
        // if user is admin then redirect to a dashboard.
        if($roleName=="sAdmin"){
          return redirect('/admin/dashboard');
        }else { // if user is normal then redirect to home page.
          return redirect('/home');
        }
        return $next($request);
    }
}
