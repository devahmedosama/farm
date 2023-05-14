<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Permission;
use App\Models\UserPermission;
class UserController extends Controller
{
    public function post_login(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('admin')
                    ->with('yes',trans('home.Loged In Successfully'));
        }else{
            return back()
                    ->with('no',trans('home.error in email or password'));
        }
    }
    public function index()
    {
       
        $allData = User::paginate(30);
        return view('admin.users.index')
                ->with('allData',$allData)
                ->with('title',trans('home.All Users'));
    }
    public function edit($id)
    {
        $data = User::find($id);
        $langs =  \App\Models\Language::items();
        $permissions =  Permission::get();
        foreach ($permissions as $permission) {
            $user_per =  UserPermission::where('user_id',$id)->where('permission_id',$permission->id)->first();
            $permission->is_checked = ($user_per)?1:0;
        }
        return view('admin.users.edit')
                ->with('data',$data)
                ->with('langs',$langs)
                ->with('permissions',$permissions)
                ->with('title',trans('home.Edit User'));
    }
    public function post_edit($id,Request $request)
    {
        $data  = User::find($id);
        $data->phone =  $request->phone;
        $data->email =  $request->email;
        $data->username =  $request->username;
        $data->locale =  $request->locale;
        if ($request->password) {
            $data->password = \Hash::make($request->password) ;
        }
        $data->save();
        $ids =  ($request->permissions)?$request->permissions:[];
        UserPermission::where('user_id',$id)->whereNotIn('permission_id',$ids)->delete();
        foreach ($request->permissions as $prermission_id) {
            $permission =  UserPermission::where('user_id',$id)->where('permission_id',$prermission_id)->first();
            if (empty($permission)) {
                $permission =  new UserPermission;
                $permission->user_id =  $id;
                $permission->permission_id  = $prermission_id;
                $permission->save();
            }
        }
        return redirect('admin/users')
                ->with('yes',trans('home.Done Successfully'));
        
    }
    public function add($value='')
    {
        $langs =  \App\Models\Language::items();
        return  view('admin.users.add')
                ->with('langs',$langs)
                ->with('title',trans('home.Add User'));
    }
    public function post_add(Request $request)
    {
        $request->validate([
            'phone'=>'required|unique:users',
            'email'=>'required|unique:users',
            'password'=>'required|same:confirm_password'
            ],[
              'phone.unique'=>trans('home.this phone already used'),
              'email.unique'=>trans('home.this E-mail already used'),
            ]);
        $data  = new User;
        $data->phone =  $request->phone;
        $data->username =  $request->username;
        $data->locale =  $request->locale;
        $data->email =  $request->email;
        $data->password = \Hash::make($request->password) ;
        $data->save();
        return redirect('admin/users')
                ->with('yes',trans('home.Done Successfully'));

    }
    public function delete($id)
    {
        $data  = User::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                    ->with('yes',trans('home.Done Successfully'));
    }
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
        return redirect('admin/users')
                ->with('yes',trans('home.Done Successfully'));
    }
}
