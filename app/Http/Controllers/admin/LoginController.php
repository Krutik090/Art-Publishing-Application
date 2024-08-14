<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\RequiresSetting;



class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    // This method will authenticate user
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        //$remember = $request->has('remember');
        if ($validator->passes()) {

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

                if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->user_type != 'admin') {

                    return redirect()->route('admin.login')->withErrors('error', 'You are not Authorized!!');
                }

                return redirect()->route('admin.dashboard');
            }

             else {
                return redirect()->route('admin.login')->withErrors('error', 'Email or Password incorrect');
            }

        } else {
            return redirect()->route('admin.login')
                ->withInput()
                ->withErrors($validator);
        }

    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    function passwordRequest() {
        return view('admin.forgetpassword');
    }
}
