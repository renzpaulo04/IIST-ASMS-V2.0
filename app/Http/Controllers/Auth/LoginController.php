<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

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
    protected $redirectTo = RouteServiceProvider::HOME;
        protected function redirecTo(){
            if( Auth()->user()->role == 'OTHERFACULTY'){
                return route('guest.dashboard');
            }

            elseif( Auth()->user()->role == 'FACULTY'){
                return route('faculty.dashboard');
            }
            elseif( Auth()->user()->role == 'STUDENT'){
                return route('student.dashboard');
            }
        }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $input = $request->all();
        $this->validate($request,[
            'idNumber' => 'required',
            'password' => 'required',

        ]);
       $user = User::where('idNumber', array($input['idNumber']))->count();
        if ( $user != 0){
            $users = User::where('idNumber', array($input['idNumber']))->where('role2','active')->count();
            if($users != 0){
                if ( auth()->attempt(array('idNumber'=>$input['idNumber'],'password'=>$input['password']))){
                    if( auth()->user()->role == 'IISTFACULTY')
                    {
                            return redirect()->route('faculty.dashboard');
                    }
                    elseif( auth()->user()->role == 'OTHERFACULTY'){
                        return redirect()->route('guest.dashboard');
                    }
                    elseif( auth()->user()->role == 'STUDENT'){
                        return redirect()->route('student.dashboard');
                    }


                }else{
                    return redirect()->route('login')->with('error','Password Incorrect');
                }
            }else{
                return redirect()->route('login')->with('error','Your Account is Not active');
            }

        }else{
            return redirect()->route('login')->with('error','Your Id Number Not a member');
        }
    }
}
