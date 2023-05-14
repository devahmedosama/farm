<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Language;
use App\Models\Nursery;
use App\Models\NurseryLocale;
use Auth;
use App\Models\ProductType;
use App\Models\Area;

class NurseryController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index()
    {
        $allData  =  Nursery::OrderBy('id','desc')->paginate(30);
        return view('admin.nurseries.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Nurseries'));
    }
    public function add($value='')
    {
        $product_types =  ProductType::items();
        $states         =  Nursery::states();
        $areas  =  Area::items();
    	return view('admin.nurseries.add')
                ->with('product_types',$product_types)
                ->with('areas',$areas)
                ->with('states',$states)
    			->with('title',trans('home.Add Nursery'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'name'=>'required',
         	]);
        $data =  new Nursery;
        $data->product_type_id =  $request->product_type_id;
        $data->area_id      =  $request->area_id;
        $data->no_seeds      =  $request->no_seeds;
        $data->state      =  $request->state;
        $data->seeding_date =  $request->seeding_date;
        $data->transfering_seeds_to_plant_date =  $request->transfering_seeds_to_plant_date;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new NurseryLocale;
        	$locale->locale       = $lang->locale;
        	$locale->nursery_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/nurseries')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  Nursery::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  NurseryLocale::where('nursery_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
        }
        $product_types  =  ProductType::items();
        $states      =  Nursery::states();
        $areas  =  Area::items();
        return view('admin.nurseries.edit')
                   ->with('product_types',$product_types)
                   ->with('data',$data)
                   ->with('areas',$areas)
                   ->with('states',$states)
                   ->with('langs',$langs)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {
        $request->validate([
            'name_en'=>'required'
            ]);
        $data =  Nursery::find($id);
        $data->product_type_id =  $request->product_type_id;
        $data->no_seeds      =  $request->no_seeds;
        $data->area_id      =  $request->area_id;
        $data->state      =  $request->state;
        $data->seeding_date =  $request->seeding_date;
        $data->transfering_seeds_to_plant_date =  $request->transfering_seeds_to_plant_date;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $text =  'text_'.$lang->locale;
            $locale =  NurseryLocale::where('nursery_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale               =  new NurseryLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->nursery_id = $data->id;
            $locale->name         = $request->$name;
            $locale->save();
        }
        return  redirect('admin/nurseries')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  Farm::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
}
