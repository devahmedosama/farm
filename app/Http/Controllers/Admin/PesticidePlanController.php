<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PesticidePlan;
use App\Models\FertilizationType;
use App\Models\Stock;
use App\Models\Farm;
use App\Models\Company;
use App\Models\Nursery;
use App\Models\PesticideItem;
use App\Models\PesticidePlanLocale;
use App\Models\Language;
use App\Models\StockItem;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Area;


class PesticidePlanController extends Controller
{
   
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function add()
    {
    	$types      =  FertilizationType::where('type',1)->get();
    	//$stocks     =  Stock::items(4);
    	$farms      =  Farm::active_items();
    	$nurseries  =  Nursery::active_items();
        $stocks     =  Company::items(2);
    	return view('admin.pesticide_plans.add')
    			->with('stocks',$stocks)
                ->with('farms',$farms)
    			->with('types',$types)
    			->with('nurseries',$nurseries)
    			->with('title',trans('home.Add Pesticides'));
    }
    public function post_add(Request $request)
    {
        foreach ($request->farm_id as $farm_id) {
            $data   =  new PesticidePlan;
            $data->nursery_id =  $request->nursery_id;
            $data->farm_id  =  $farm_id;
            $data->user_id  =  \Auth::id();
            $data->save();
            foreach ($request->item_id as $key => $item_id) {
                $item =  new PesticideItem;
                $item->pesticide_plan_id = $data->id;
                $item->company_id =  $item_id;
                 $item->date = ( $request->date[$key])?$request->date[$key]:$request->main_date;
                $item->fertilization_type_id =  $request->fertilization_type_id[$key];
                $item->amount =  $request->quantity[$key];
                $item->save();
            }
            Stock::pesticide($data->id);
        }
    	
    	return  redirect('admin/data-entry')
    				->with('yes',trans('home.Done Successfully'));
    }
    public function index(Request $request)
    {
        $first    =  Area::first();
        $id       =  ($request->area_id)?$request->area_id:$first->id;  
        $allData  =  PesticideItem::OrderBy('date','asc')->whereHas('ferrilization_plan.farm',function($query) use($id){
                              $query->where('area_id',$id);
                          })->where(function($query) use($request){
                                if ($request->nursery_id) {
                                    $query->where('nursery_id',$request->nursery_id);
                                }
                                if ($request->farm_id) {
                                    $query->where('farm_id',$request->farm_id);
                                }
                                if ($request->date_from) {
                                    $query->whereDate('date','>=',$request->date_from);
                                }
                                if ($request->area_id) {
                                    $query->whereHas('ferrilization_plan.farm',function($query) use($request){
                                        $query->where('area_id',$request->area_id);
                                    });
                                }
                                if ($request->date_to) {
                                    $query->whereDate('date','<=',$request->date_to);
                                }
                            })->where('state',0)->paginate(30);
        $areas      =  Area::get();
        return view('admin.pesticide_plans.index')
                    ->with('id',$id)
                    ->with('allData',$allData)
                    ->with('areas',$areas)
                    ->with('title',trans('home.Pesticides'));
    }
    public function change_state($id)
    {
        $data =  PesticideItem::find($id);
        $data->state =  1;
        $data->save();
        return back()
                ->with('yes',trans('home.Done Successfully'));
    }
    public function all_items(Request $request)
    {
        $allData  =  PesticideItem::OrderBy('id','desc') ->where(function($query) use($request){
                                if ($request->date_from) {
                                    $query->whereDate('date','>=',$request->date_from);
                                }
                                if ($request->date_to) {
                                    $query->whereDate('date','<=',$request->date_to);
                                }
                                if ($request->area_id) {
                                    $query->whereHas('ferrilization_plan.farm',function($query) use($request){
                                        $query->where('area_id',$request->area_id);
                                    });
                                }
                            })->paginate(30);
        $areas      =  Area::get();
        return view('admin.pesticide_plans.plans')
                    ->with('allData',$allData)
                    ->with('areas',$areas)
                    ->with('title',trans('home.Pesticides'));
    }
    public function delete($id)
    {
        $data =  PesticideItem::find($id);
        if ($data) {
            $data->delete();;
        }
        return back()
                ->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  PesticideItem::find($id);
        
        $types      =  FertilizationType::items(1);
        $stocks     =  Company::items(2);
        $farms      =  Farm::active_items();
        $nurseries  =  Nursery::active_items();
        return view('admin.pesticide_plans.edit')
                ->with('stocks',$stocks)
                ->with('farms',$farms)
                ->with('data',$data)
                ->with('types',$types)
                ->with('title',$data->name)
                ;
    }
    public function post_edit(Request $request,$id)
    {
        
        $item =   PesticideItem::find($id);
        $item->company_id =  $request->stock_item_id;
        $item->date =  $request->date;
        $item->fertilization_type_id =  $request->fertilization_type_id;
        $item->amount =  $request->quantity;
        $item->save();

        return  redirect('admin/pesticide-plans')
                    ->with('yes',trans('home.Done Successfully'));
    }
}
