<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeLocale;
use App\Models\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Vacation;
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
        return view('admin.employees.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Employees'));
    }
    public function show()
    {
        $allData  =  Employee::OrderBy('id','desc')->paginate(30);
        $types    =  Vacation::types();
        return view('admin.employees.show')
                ->with('allData',$allData)
                ->with('types',$types)
                ->with('title',trans('home.Employees'));
    }
    public function single($id)
    {
        $data  =  Employee::find($id);
        return view('admin.employees.single')
                ->with('data',$data)
                ->with('title',$data->name);
    }
    public function add($value='')
    {
    	return view('admin.employees.add')
    			->with('title',trans('home.Add Employee'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $data =  new Employee;
        $data->id_no =  $request->id_no;
        $data->passport_no =  $request->passport_no;
        $data->phone =  $request->phone;
        $data->join_date =  $request->join_date;
        $data->passport_expire =  $request->passport_expire;
        $data->birth_date =  $request->birth_date;
        $data->salary =  $request->salary;
        $data->visa_expire_date =  $request->visa_expire_date;
        if ($request->hasFile('image')) {
            $file =  $request->file('image');
            $filename = 'uploads/employees/'.time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/employees',$filename);
            $data->image =  $filename;
        }
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new EmployeeLocale;
        	$locale->locale       = $lang->locale;
        	$locale->employee_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
            $locale->job         = GoogleTranslate::trans($request->job,$lang->locale, $this->lang);
            $locale->text         = GoogleTranslate::trans($request->text,$lang->locale, $this->lang);
        	$locale->nationality         = GoogleTranslate::trans($request->nationality,$lang->locale, $this->lang);
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
            $lang->locale_nationality =  ($locale)?$locale->nationality:' ';
            $lang->locale_job =  ($locale)?$locale->job:' ';
        }
        return view('admin.employees.edit')
                   ->with('data',$data)
                   ->with('langs',$langs)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {
        $data =  Employee::find($id);
        $data->id_no =  $request->id_no;
        $data->passport_no =  $request->passport_no;
        $data->phone =  $request->phone;
        $data->join_date =  $request->join_date;
        $data->salary =  $request->salary;
        $data->visa_expire_date =  $request->visa_expire_date;
        $data->birth_date =  $request->birth_date;
        $data->passport_expire =  $request->passport_expire;
        if ($request->hasFile('image')) {
            $file =  $request->file('image');
            $filename = 'uploads/employees/'.time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/employees',$filename);
            $data->image =  $filename;
        }
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $text =  'text_'.$lang->locale;
            $nationality =  'nationality_'.$lang->locale;
            $job =  'job_'.$lang->locale;
            $locale =  EmployeeLocale::where('employee_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale             =  new EmployeeLocale;
            }
            $locale->locale        = $lang->locale;
            $locale->employee_id   = $data->id;
            $locale->job           = $request->job;
            $locale->name          = $request->$name;
            $locale->text          = $request->$text;
            $locale->nationality   = $request->$nationality;
            $locale->job          = $request->$job;
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
    public function add_vacation(Request $request,$id)
    {
        $data = new Vacation;
        $data->employee_id =   $id;
        $data->date_from   =  $request->date_from;
        $data->date_to     =  $request->date_to;
        $data->type        =  $request->type;
        $data->save();
        return  [
            'item'=> $data,
            'state'=>1
        ];
    }
    public function vacations($id)
    {
        $allData  =  Vacation::OrderBy('id','desc')->where('employee_id',$id)
                                ->paginate(30);
        $data     =  Employee::find($id);
        return view('admin.employees.vacations')
                    ->with('allData',$allData)
                    ->with('data',$data)
                    ->with('title',trans('home.Vacations'));

    }
    public function delete_vacation($id)
    {
        $data =  Vacation::find($id);
        if ($data) {
            $data->delete();
        }
        return back()
                ->with('yes',trans('home.Done Successfully'));
    }
    public function print($id)
    {
        $allData  =  Vacation::OrderBy('id','desc')->where('employee_id',$id)
                                ->paginate(30);
        $employee     =  Employee::find($id);
        $lang  =  \App::getLocale();
        $dir   =  ($lang == 'ar')?'rtl':'ltr';
        $text   =  ($lang == 'ar')?'right':'left';
        $data = [
          'allData' => $allData,
          'dir'=>$dir,
          'data'=>$employee,
          'text'=>$text,
        ];
        $pdf = \PDF::loadView('pdf.vacations', $data);
        return $pdf->download($employee->name.'.pdf');
       
    }
}



















