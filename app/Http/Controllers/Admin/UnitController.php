<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\UnitLocale;
use App\Models\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;

class UnitController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index(Request $request)
    {
        $allData  =  Unit::OrderBy('id','desc')->paginate(30);
        return view('admin.units.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Units'));
    }
    public function add()
    {
    	return view('admin.units.add')
    			->with('title',trans('home.Add Unit'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'name'=>'required',
            'image'=>'mimes:jpg,png,jpeg'
         	]);
        $data =  new Unit;
        $data->equal_kg =  $request->equal_kg;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new UnitLocale;
        	$locale->locale       = $lang->locale;
        	$locale->unit_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/units')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  Unit::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  UnitLocale::where('unit_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
        }
        return view('admin.units.edit')
                   ->with('data',$data)
                   ->with('langs',$langs)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {
        $request->validate([
            'image'=>'mimes:jpg,png,jpeg'
            ]);
        $data =  Unit::find($id);
        $data->equal_kg =  $request->equal_kg;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $locale =  UnitLocale::where('unit_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale               =  new UnitLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->unit_id = $data->id;
            $locale->name         = $request->$name;
            $locale->save();
        }
        return  redirect('admin/units')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  Unit::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
}
