<?php
namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use DB;
use App\Role;
use App\UserConfiguration;
use Exception;
use Illuminate\Http\Request;
use App\Helper\GlobalHelper;
use Illuminate\Support\Facades\Auth;
use Mail;
use Session;
use App\Http\Controllers\Controller;
use Socialite;
use App\UserLog;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => 'required|max:35',
            'lastName' => 'required|max:35',
            'email' => 'required|email|max:35|unique:kc_users',
            'password' => 'required|min:6|max:15',
            'confirmed_password' => 'required|same:password|min:6|max:15',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data,$generate_verification_code)
    {
        return User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'verificationCode'=>$generate_verification_code,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('pages.auth.register');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required|email', 'password' => 'required'
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {

            $logModel = new UserLog();
            $logModel->userId = Auth::id();

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $logModel->userIp = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $logModel->userIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $logModel->userIp = $_SERVER['REMOTE_ADDR'];
            }

            $logModel->browserInfo = json_encode($_SERVER['HTTP_USER_AGENT']);
            $logModel->loginTime = date('Y-m-d H:i:s');
            $logModel->createdAt = date('Y-m-d H:i:s');
            $logModel->save();

            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.

        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $generate_verification_code = md5($request->firstName.$request->firstName+rand(1, 1000));
        $user = $this->create($request->all(),$generate_verification_code);

        $configu_model = new UserConfiguration();
        $role = new Role();
        $configu_model->userId=$user->userId;
        $role->userId = $user->userId;
        $role->roleType = '1';
        $role->save();
        $configu_model->save();

        Mail::send('template.emailVerification', ['user' =>$user], function ($m) use ($user){
            $m->to($user->email, $user->firstname." ".$user->lastname)->subject('Activate Your Arka-Anaya Account');
        });
        Mail::send('template.adminNewRegister', ['user' =>$user], function ($m) use ($user){
          $m->to(ENV('MAIL_TO'),ENV('MAIL_NAME'))->subject('Portalic - New User Registered');
        });
        return redirect('/signup')->with('success-message', 'You are registered successful, please check email for verification');
    }

    public function getVerifiedAccount($code)
    {
        if (Auth::user()) {
            return redirect('/'.Auth::user()->getUserRole().'/dashboard');
        } else {
            $isActive = User::where('verificationCode', $code)->first();

            if (isset($isActive) && !empty($isActive)) {
                //if is already verified account then display message already verified please sign in
                if (empty($isActive->verificationCode) && !isset($isActive->verificationCode)) {
                    if ($isActive->status == 1) {
                        $alreadyactive = 'You have already activate your account please click to';
                        return view('Auth.userVerification',compact('alreadyactive'));
                        //verified and redirect to html page
                    } else {
                        $alreadyactive = 'You are recently blocked.';
                        return view('Auth.userVerification', compact('alreadyactive')); //user block
                    }
                } else {
                    $isActive = User::where('verificationCode', $code)->first();
                    $obj = User::find($isActive->userId);
                    $obj->verificationCode = '';
                    $obj->status = '1';
                    if($obj->save()){
                        return view('Auth.userVerification'); //verified and redirect to html page
                    }
                }
            } else {
                $alreadyactive = 'You have already activate your account please click to';
                return view('Auth.userVerification', compact('alreadyactive'));
            }
        }
    }

    public function authenticated(Request $request, User $user)
    {
        if(Auth::user()->getUserRole() == 'user')
            $user_role = "/login";
        else
            //$user_role = Auth::user()->getUserRole().'/login';
            $user_role = "/login";

        if (!empty($user->verificationCode)) {
            Auth::logout();
            return redirect($user_role)->with('errormessage', 'Please verify your account from your email.');
        } else if($user->status=='0' || $user->status=='-1') {
            Auth::logout();
            return redirect($user_role)->with('errormessage', 'Your account has been not activated by Admin. Please contact to the admin.');
        } else {
            if (Session::has('redirect_path')) {
                return redirect(Session::get("redirect_path"));
            }
            return redirect()->intended($this->redirectPath());
        }
    }

    public function redirectToProvider()
    {

        if (\Auth::check()) {

            if (Auth::user()->getUserRole() == 'admin') {
            return redirect('admin/dashboard');
            } else {
                return redirect('/');
            }
        } else {

        }
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (Auth::user()->getUserRole() == 'admin') {
            return "/admin/dashboard";
        } else {
            return "/";
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */

    public function getLogout()
    {
        $path = "";
        if (Auth::check()) {
            if (Auth::user()->getUserRole() == 'admin') {
                $path = '/admin/login';
            } else {
                $path = '/login';
            }
        }

        Auth::logout();
        Session::flush();
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : $path);
    }
}
