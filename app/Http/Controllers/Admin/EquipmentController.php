<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Language;
use App\Models\Equipment;
use App\Models\EquipmentLocale;
use Auth;
use voku\helper\HtmlDomParser;
use App\Models\Company;
class EquipmentController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    
    public function index()
    {
    	// GoogleTranslate::trans('Hello again', 'fr', 'en');
        $allData  =  Equipment::OrderBy('id','desc')->paginate(30);
        return view('admin.equipments.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Equipments'));
    }
    public function add($value='')
    {
        $this->lang =  \App::getLocale();
    	return view('admin.equipments.add')
    			->with('title',trans('home.Add Equipment'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'machine_no'=>'required'
         	]);
        $data =  new Equipment;
        $data->machine_no =  $request->machine_no;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new EquipmentLocale;
        	$locale->locale       = $lang->locale;
        	$locale->equipment_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->text         = GoogleTranslate::trans($request->text,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/equipments')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  Equipment::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  EquipmentLocale::where('equipment_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
            $lang->locale_text =  ($locale)?$locale->text:' ';
        }
        return view('admin.equipments.edit')
                   ->with('data',$data)
                   ->with('langs',$langs)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
            'machine_no'=>'required'
            ]);
        $data =  Equipment::find($id);
        $data->machine_no =  $request->machine_no;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $text =  'text_'.$lang->locale;
            $locale =  EquipmentLocale::where('equipment_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale               =  new EquipmentLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->equipment_id = $data->id;
            $locale->name         = $request->$name;
            $locale->text         = $request->$text;
            $locale->save();
        }
        return  redirect('admin/equipments')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  Equipment::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
}
