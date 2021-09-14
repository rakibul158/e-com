<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function settings()
    {
        $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        //dd($adminDetails);
        return view('admin.settings.index')
            ->with('adminDetails',$adminDetails);
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

    public  function checkCurrentPwd(Request $request)
    {
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        //echo "<pre>"; print_r(Auth::guard('admin')->user()->password); die;
        if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
            echo "True";
        } else {
            echo "False";
        }
    }

    public function updateCurrentPwd(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
           // dd($data);
            if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
                if ($data['new_pwd'] == $data['confirm_pwd']){
                    Admin::where('id', Auth::guard('admin')->user()->id)
                        ->update([
                            'password' =>bcrypt($data['new_pwd'])
                        ]);
                    Session::flash('success_message','Password has been Updated Successfully!');
                } else {
                    Session::flash('error_message','New Password and Confirm Password Must Be Same!');
                }
            } else {
                Session::flash('error_message','Current Password is Incorrect!');
            }
            return redirect()->back();
        }
    }

    public function updateDetails(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required',
            ];
            $customMessage = [
                'name.required' => 'Name is required.',
                'mobile.required' => 'Mobile is required.'
            ];
            $this->validate($request, $rules, $customMessage);

            if ($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid())
                {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'images/admin/admin_upload_profile_images/'.$imageName;
                    Image::make($image_tmp)->save($imagePath);
                } else if(!empty($data['current_img'])){
                    $imageName = $data['current_img'];
                } else{
                    $imageName = '';
                }
            }

            Admin::where('email', Auth::guard('admin')->user()->email)
                ->update([
                    'name'=> $data['name'],
                    'mobile'=> $data['mobile'],
                    'image'=> $imageName
                ]);
            Session::flash('success_message','Admin Details Updated Successfully!');
            return redirect()->back();

        }
        return view('admin.settings.update_details');
    }


}
