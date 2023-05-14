<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Area;
use App\Models\AreaLocale;
use App\Models\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;



class AreaController extends Controller
{
    
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function add($value='')
    {
        $types =  Farm::types();
    	return view('admin.areas.add')
                ->with('types',$types)
    			->with('title',trans('home.Add Farmming Area'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $data =  new Area;
        $data->type  =  $request->type;
        $data->no_valves      =  $request->no_valves;
        $data->no_drops      =  $request->no_drops;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new AreaLocale;
        	$locale->locale       = $lang->locale;
        	$locale->area_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/data-entry')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function index()
    {
        $allData  =  Area::OrderBy('id','desc')->paginate(30);
        return view('admin.areas.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Farm Areas'));
    }
    public function my_farm()
    {
         return view('admin.farms.my_farm')
                    ->with('title',trans('home.My Farm'));
    }
    public function edit($id)
    {
        
        $types         =  Farm::types();
        $data          =  Area::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  AreaLocale::where('area_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
        }
    	return view('admin.areas.edit')
                ->with('data',$data)
                ->with('langs',$langs)
                ->with('types',$types)
    			->with('title',$data->name);

    }
    public function post_edit($id,Request $request)
    {
        $data =  Area::find($id);
        $data->type  =  $request->type;
        $data->no_valves      =  $request->no_valves;
        $data->no_drops      =  $request->no_drops;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $locale =  AreaLocale::where('area_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale =  new AreaLocale;
            }
            $locale->locale  = $lang->locale;
            $locale->area_id = $data->id;
            $locale->name    = $request->$name;
            $locale->save();
        }
        return  redirect('admin/areas')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data = Area::find($id);
        if($data){
            $data->delete();
        }
        return  back()
        			->with('yes',trans('home.Done Successfully'));
    }
}
