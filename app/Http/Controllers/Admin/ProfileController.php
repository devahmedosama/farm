<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class ProfileController extends Controller
{
    public function profile()
    {
        $data = Auth::User();
        $langs =  \App\Models\Language::items();
        return view('admin.users.profile')
                ->with('data',$data)
                ->with('langs',$langs)
                ->with('title',trans('home.My Profile'));
    }
    public function post_profile(Request $request)
    {
        $data  = Auth::User();
        $data->phone =  $request->phone;
        $data->email =  $request->email;
        $data->username =  $request->username;
        $data->locale =  $request->locale;
        if ($request->password) {
            $data->password = \Hash::make($request->password) ;
        }
        $data->save();
        return redirect('admin')
                ->with('yes',trans('home.Done Successfully'));
    }
}
