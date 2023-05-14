<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Language;
use App\Models\Farm;
use App\Models\FarmLocale;
use Auth;
use App\Models\PlantType;
use App\Models\ProductType;
use App\Models\Area;



class FarmController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function add($value='')
    {
        $plant_types   =  PlantType::items();
        $states        =  Farm::states();
        $product_types =  ProductType::items();
        $types         =  Farm::types();
        $areas         =  Area::items();
    	return view('admin.farms.add')
                ->with('plant_types',$plant_types)
                ->with('states',$states)
                ->with('types',$types)
                ->with('areas',$areas)
                ->with('product_types',$product_types)
    			->with('title',trans('home.Add Farm Area'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $data =  new Farm;
        $data->area_id  =  $request->area_id;
        $data->plant_type_id =  $request->plant_type_id;
        $data->product_type_id =  $request->product_type_id;
        $data->state      =  $request->state;
        $data->seeding_date =  $request->seeding_date;
        $data->harvester_date =  $request->harvester_date;
        $data->save();
        // $langs =  Language::get();
        // foreach ($langs as $lang) {
        // 	$locale               =  new FarmLocale;
        // 	$locale->locale       = $lang->locale;
        // 	$locale->farm_id = $data->id;
        //     $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        // 	$locale->save();
        // }
        return  redirect('admin/farms')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function index()
    {
        $allData  =  Farm::OrderBy('id','desc')->paginate(30);
        return view('admin.farms.index')
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
        $plant_types   =  PlantType::items();
        $states        =  Farm::states();
        $product_types =  ProductType::items();
        $types         =  Farm::types();
        $data          =  Farm::find($id);
        $areas         =  Area::items();
        
    	return view('admin.farms.edit')
                ->with('plant_types',$plant_types)
                ->with('states',$states)
                ->with('data',$data)
                ->with('types',$types)
                ->with('areas',$areas)
                ->with('product_types',$product_types)
    			->with('title',$data->name);

    }
    public function post_edit($id,Request $request)
    {
        $data =  Farm::find($id);
        $data->area_id  =  $request->area_id;
        $data->plant_type_id =  $request->plant_type_id;
        $data->product_type_id =  $request->product_type_id;
        $data->state      =  $request->state;
        $data->seeding_date =  $request->seeding_date;
        $data->harvester_date =  $request->harvester_date;
        $data->save();
        
        return  redirect('admin/farms')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data = Farm::find($id);
        if($data){
            $data->delete();
        }
        return  back()
        			->with('yes',trans('home.Done Successfully'));
    }
}
