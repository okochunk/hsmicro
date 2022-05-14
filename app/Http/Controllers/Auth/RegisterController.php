<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
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
            'name' => 'required|max:255',
            'company' => 'required|max:255',
            'phone' => 'required|digits_between:4,15|integer',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'company' => $data['company'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'is_active' => 0,
            'password' => bcrypt($data['password']),
        ]);

        $user->roles()->attach(Role::where('name', 'customer')->first());

        return $user;
    }

    protected function redirectTo()
    {

        Auth::logout();
        Session::flush();
        return '/notactive';

//        $role = Auth::user()->roles[0]->name;
//
//        switch($role) {
//            case 'admin':
//                return 'admin/dashboard';
//                break;
//            case 'customer':
//                return 'customer/home';
//                break;
//            default:
//                return 'login';
//                break;
//        }
    }

    public function notActive()
    {
        return view('auth.notactive');
    }
}
