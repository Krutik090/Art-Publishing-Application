<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    // This method will show login page for Admin
    public function index(){
        return view('Login');
    }

    // This method will authenticate Admin
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'sometimes|boolean',
        ]);
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        if($validator->passes()){

            if (Auth::attempt($credentials, $remember)) {

                if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->user_type == 'admin'){
                    return redirect()->route('admin.dashboard');
                }

                return redirect()->route('account.dashboard');
            }else{
                return redirect()->route('account.login')->withErrors('Email or Password incorrect');
            }

        }else{
            return redirect()->route('account.login')
            ->withInput()
            ->withErrors($validator);
        }

    }
 // This method will show register page to user
    public function register(){

        return view('register');
    }

    public function processRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'name' => 'required',
            'password_confirmation' => 'required',

        ]);
        //$credentials = $request->only('email', 'password');
        if($validator->passes()){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->user_type = 'user';
            $user->save();
            return redirect()->route('account.login')->with('success','You have registered successfully');

        }else{
            return redirect()->route('account.register')
            ->withInput()
            ->withErrors($validator);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');

    }

    public function passwordRequest(){
        return view('forgetpassword');
    }

}
