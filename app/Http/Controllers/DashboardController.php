<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //This method will show dashboard page for user
    public function index(Request $request){
        return view('dashboard');
    }

}
