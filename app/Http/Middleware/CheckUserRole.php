<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use DB,Utility;
use Session;
use Closure;
use Auth;
use Illuminate\Http\Request;

class CheckUserRole
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
    public function handle($request, Closure $next,$role='')
    {
        if(Session::get('id')){
            $user_id = Session::get('id');
        }else{
            $user_id = Auth::user()->id;
        }
        $objUtility = new Utility;

        $roleName = $objUtility->getUserRoleName($user_id);
        if($role==$roleName){
          return $next($request);
        }else {
          // that autometic redirect user to his dashboard or home page as per role.
          return redirect('/');
        }

    }
}
