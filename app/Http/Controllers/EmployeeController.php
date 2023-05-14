<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeLocale;
use App\Models\Language;


class EmployeeController extends Controller
{
    
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    
    public function index()
    {
    	// GoogleTranslate::trans('Hello again', 'fr', 'en');
        $allData  =  Employee::OrderBy('id','desc')->paginate(30);
        return view('admin..employees..index')
                ->with('allData',$allData)
                ->with('title',trans('home..employees.'));
    }
    public function add($value='')
    {
    	return view('admin.employees.add')
    			->with('title',trans('home.Add Employee'));

    }
    public function post_add(Request $request)
    {
        $request->validate([
         	'machine_no'=>'required'
         	]);
        $data =  new Employee;
        $data->machine_no =  $request->machine_no;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new EmployeeLocale;
        	$locale->locale       = $lang->locale;
        	$locale->employee_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->text         = GoogleTranslate::trans($request->text,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/employees')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  Employee::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  EmployeeLocale::where('employee_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
            $lang->locale_text =  ($locale)?$locale->text:' ';
            $lang->locale_job =  ($locale)?$locale->job:' ';
            $lang->locale_nationality =  ($locale)?$locale->nationality:' ';
        }
        return view('admin.employees.edit')
                   ->with('data',$data)
                   ->with('langs',$langs)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {
        $request->validate([
            'machine_no'=>'required'
            ]);
        $data =  Employee::find($id);
        $data->machine_no =  $request->machine_no;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $text =  'text_'.$lang->locale;
            $nationality =  'nationality_'.$lang->locale;
            $job =  'job_'.$lang->locale;
            $text =  'text_'.$lang->locale;
            $locale =  EmployeeLocale::where('employee_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale            =  new EmployeeLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->employee_id  = $data->id;
            $locale->name         = $request->$name;
            $locale->nationality  = $request->$nationality;
            $locale->job          = $request->$job;
            $locale->text         = $request->$text;
            $locale->save();
        }
        return  redirect('admin/employees')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  Employee::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
}
