<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermistionController extends Controller
{
     protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index()
    {
        $allData  =  PlantType::OrderBy('id','desc')->paginate(30);
        return view('admin.plant_types.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Plant Types'));
    }
    public function add($value='')
    {
    	return view('admin.plant_types.add')
    			->with('title',trans('home.Add Plant Type'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'name'=>'required'
         	]);
        $data =  new PlantType;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new PlantTypeLocale;
        	$locale->locale       = $lang->locale;
        	$locale->plant_type_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/plant-types')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  PlantType::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  PlantTypeLocale::where('plant_type_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
        }
        return view('admin.plant_types.edit')
                   ->with('data',$data)
                   ->with('langs',$langs)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {

        $data =  PlantTypeLocale::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $locale =  PlantTypeLocale::where('plant_type_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale               =  new PlantTypeLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->plant_type_id = $data->id;
            $locale->name         = $request->$name;
            $locale->save();
        }
        return  redirect('admin/plant-types')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  PlantType::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
}
