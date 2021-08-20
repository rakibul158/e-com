<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            $rule = [
                'email' => 'required|email|max:255',
                'password' => 'required'
            ];

            $customMessage = [
                'email.required' => 'Email is Required',
                'email.email' => 'Valid Email is Required',
                'password.required' => 'Password is Required',
            ];

            $this->validate($request, $rule, $customMessage);

            /*$validated = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);*/

            if(Auth::guard('admin')->attempt(['email'=> $data['email'],'password'=> $data['password']]))
            {
                return Redirect::route('dashboard');
                // return redirect('admin/dashboard');
            } else{
                Session::flash('error_message','Invalid Email or Password');
                return redirect()->back();
            }
        }
        return view('admin.auth.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
