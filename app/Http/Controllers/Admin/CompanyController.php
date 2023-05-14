<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Language;
use App\Models\CompanyLocale;
use Stichoza\GoogleTranslate\GoogleTranslate;

class CompanyController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index(Request $request)
    {
        $allData  =  Company::OrderBy('id','desc')->paginate(30);
        return view('admin.companies.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Companies'));
    }
    public function add()
    {
        $types = Company::types();
    	return view('admin.companies.add')
                ->with('types',$types)
    			->with('title',trans('home.Add Company'))
                ;

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'name'=>'required'
         	]);
        $data =  new Company;
        $data->type =  $request->type;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new CompanyLocale;
        	$locale->locale       = $lang->locale;
        	$locale->company_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/companies')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function ajax_add(Request $request)
    {
        $this->lang =  \App::getLocale();
       
        $data =  new Company;
        $data->type =  $request->company_type;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale               =  new CompanyLocale;
            $locale->locale       = $lang->locale;
            $locale->company_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->company_name,$lang->locale, $this->lang);
            $locale->save();
        }
        $data =  Company::find($data->id);
        $data->name =  $request->company_name;
        return  [
            'item'=> $data,
            'item_name'=>'company_id',
            'state'=>1
        ];
    }
    public function edit($id)
    {
        $data =  Company::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  CompanyLocale::where('company_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
        }
        $types = Company::types();
        return view('admin.companies.edit')
                   ->with('data',$data)
                   ->with('types',$types)
                   ->with('langs',$langs)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {
       
        $data =  Company::find($id);
        $data->type =  $request->type;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $locale =  CompanyLocale::where('company_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale               =  new CompanyLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->company_id = $data->id;
            $locale->name         = $request->$name;
            $locale->save();
        }
        return  redirect('admin/companies')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  Company::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
}
