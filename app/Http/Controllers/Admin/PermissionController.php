<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
class PermissionController extends Controller
{
   protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index()
    {
        $allData  =  Permission::OrderBy('id','desc')->paginate(30);
        return view('admin.permissions.index')
                ->with('allData',$allData)
                ->with('title','الصلاحيات ');
    }
    public function add($value='')
    {
    	return view('admin.permissions.add')
    			->with('title','إضافة صلاحيه ');

    }
    public function post_add(Request $request)
    {
       
        $data =  new Permission;
        $data->name =  $request->name;
        $data->url =  $request->url;
        $data->save();
        return  redirect('admin/permissions')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  Permission::find($id);
        return view('admin.permissions.edit')
                   ->with('data',$data)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {
    	$data       =  Permission::find($id);
        $data->name =  $request->name;
        $data->url  =  $request->url;
        $data->save();
        return  redirect('admin/permissions')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  Permission::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
}
