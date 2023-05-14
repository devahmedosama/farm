<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FertilizationType;
use App\Models\FertilizationTypeLocale;
use App\Models\Language;
use App\Models\Unit;
use Stichoza\GoogleTranslate\GoogleTranslate;



class FertilizationTypeController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index(Request $request)
    {
        $allData  =  FertilizationType::OrderBy('id','desc')
                        ->where(function($query) use($request){
                            if ($request->type == 1) {
                                $query->where('type',1);
                            }else{
                                $query->where('type',0);
                            }
                        })->paginate(30);
        $title    = ($request->type == 1)?trans('home.Pesticide Types'):trans('home.Fertilization Types');
        return view('admin.fertilization_types.index')
                ->with('allData',$allData)
                ->with('title',$title);
    }
    public function add(Request $request)
    {
        $title    = ($request->type == 1)?trans('home.Pesticide Types'):trans('home.Fertilization Types');
        $units    =  Unit::weight();
    	return view('admin.fertilization_types.add')
                ->with('units',$units)
    			->with('title',$title);

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'name'=>'required',
         	]);
        $data =  new FertilizationType;
        $data->type =   $request->type;
        $data->unit_id =   $request->unit_id;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new FertilizationTypeLocale;
        	$locale->locale       = $lang->locale;
        	$locale->fertilization_type_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/fertilization-types?type='.$data->type)
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  FertilizationType::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  FertilizationTypeLocale::where('fertilization_type_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
        }
        $parent_title = ($data->type == 1)?trans('home.Pesticide Types'):trans('home.Fertilization Types');
        $units =  Unit::weight();
        return view('admin.fertilization_types.edit')
                   ->with('units',$units)
                   ->with('data',$data)
                   ->with('langs',$langs)
                   ->with('title',$data->name)
                   ->with('parent_title',$parent_title)
                ;
    }
    public function post_edit($id,Request $request)
    {
        $request->validate([
            'image'=>'mimes:jpg,png,jpeg'
            ]);
        $data =  FertilizationType::find($id);
        $data->unit_id =  $request->unit_id;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $locale =  FertilizationTypeLocale::where('fertilization_type_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale               =  new FertilizationTypeLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->fertilization_type_id = $data->id;
            $locale->name         = $request->$name;
            $locale->save();
        }
        return  redirect('admin/fertilization-types?type='.$data->type)
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  FertilizationType::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
}
