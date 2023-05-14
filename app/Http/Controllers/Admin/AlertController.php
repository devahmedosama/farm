<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Language;
use App\Models\Alert;
use App\Models\AlertLocale;


class AlertController extends Controller
{
     protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index()
    {
        $allData  =  Alert::OrderBy('id','desc')->paginate(30);
        return view('admin.alerts.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Alerts'));
    }
    public function add($value='')
    {
    	return view('admin.alerts.add')
    			->with('title',trans('home.Add Alert'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'name'=>'required'
         	]);
        $data =  new Alert;
        $data->date =  $request->date;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new AlertLocale;
        	$locale->locale       = $lang->locale;
        	$locale->alert_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/alerts')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  Alert::find($id);
     
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  AlertLocale::where('alert_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
        }
        return view('admin.alerts.edit')
                   ->with('data',$data)
                   ->with('langs',$langs)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {

        $data =  Alert::find($id);
        $data->date =  $request->date;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $locale =  AlertLocale::where('alert_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale               =  new AlertLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->alert_id = $data->id;
            $locale->name         = $request->$name;
            $locale->save();
        }
        return  redirect('admin/alerts')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  Alert::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
    public function finish($id)
    {
    	$data =  Alert::find($id);
    	$data->state = 1;
    	$data->save();
    	return back()
    			->with('yes',trans('home.Done Successfully')); 
    }
}
