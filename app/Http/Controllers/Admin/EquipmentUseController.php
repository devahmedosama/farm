<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EquipmentUse;
use App\Models\Equipment;
use App\Models\Employee;



class EquipmentUseController extends Controller
{
     protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    
    public function index()
    {
        $allData  =  EquipmentUse::OrderBy('id','desc')->paginate(30);
        return view('admin.equipmentuses.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Equipment Uses'));
    }
    public function add($value='')
    {
    	$employees = Employee::items();
    	$equipments = Equipment::items();
    	return view('admin.equipmentuses.add')
    	 		->with('employees',$employees)
    	 		->with('equipments',$equipments)
    			->with('title',trans('home.Add Equipment Use'));

    }
    public function post_add(Request $request)
    {
        
        $data =  new EquipmentUse;
        $data->employee_id =  $request->employee_id;
        $data->equipment_id =  $request->equipment_id;
        $data->date =  $request->date;
        $data->return_date =  $request->return_date;
        $data->save();
        return  redirect('admin/equipmentuses')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  Equipment::find($id);
        return view('admin.equipmentuses.edit')
                   ->with('data',$data)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {
       
        $data =  EquipmentUse::find($id);
        $data->employee_id =  $request->employee_id;
        $data->equipment_id =  $request->equipment_id;
        $data->date =  $request->date;
        $data->return_date =  $request->return_date;
        $data->save();        
        return  redirect('admin/equipmentuses')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  EquipmentUse::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
    public function return_back($id)
    {
        $data =  EquipmentUse::find($id);
        if ($data) {
            $data->state = 1;
            $data->save();
        }
        return back()
                ->with('yes',trans('home.Done Successfully'));
    }
}
