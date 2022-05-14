<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = 'customer/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function redirectTo()
    {
        $role = Auth::user()->roles[0]->name;

        switch($role) {
            case 'admin':
                return 'admin/dashboard';
                break;
            case 'customer':
                return 'customer/order';
                break;
            default:
                return 'login';
                break;
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect('login');
    }

//    public function showLoginForm()
//    {
//        return view('user.login');
//    }

    protected function credentials(Request $request)
    {
        return ['email' => $request->{$this->username()}, 'password' => $request->password, 'is_active' => 1];
    }
}
