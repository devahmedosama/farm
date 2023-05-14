<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FertilizationType;
use App\Models\Stock;
use App\Models\Farm;
use App\Models\Nursery;
use App\Models\FertilizationPlan;
use App\Models\FertilizationPlanLocale;
use App\Models\FertilizationItem;
use App\Models\StockItem;
use App\Models\Company;
use App\Models\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Area;

class FertilizationPlanController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function add()
    {
       
    	$types      =  FertilizationType::where('type',0)->get();
    	$stocks     =  Company::items(1);
    	$farms      =  Farm::active_items();
    	$nurseries  =  Nursery::active_items();
        
    	return view('admin.firtilization_plans.add')
                ->with('stocks',$stocks)
    			->with('types',$types)
    			->with('farms',$farms)
    			->with('nurseries',$nurseries)
    			->with('title',trans('home.Fertilization Process'));
    }
   
    public function post_add(Request $request)
    {
        foreach ($request->farm_id as $farm_id) {
            
            $data   =  new FertilizationPlan;
            $data->nursery_id =  $request->nursery_id;
            $data->farm_id  =  $farm_id;
            $data->user_id  =  \Auth::id();
            $data->save();

            foreach ($request->item_id as $key => $item_id) {
                $item =  new FertilizationItem;
                $item->fertilization_plan_id = $data->id;
                $item->company_id =  $item_id;
                $item->date = ( $request->date[$key])?$request->date[$key]:$request->main_date;
                $item->fertilization_type_id =  $request->fertilization_type_id[$key];
                $item->amount =  ($request->quantity[$key]*$data->farm->area->no_drops/1000);
                $item->per_amount =  $request->quantity[$key];
                $item->save();
            }
            Stock::move($data->id);
        }
    	return  redirect('admin/data-entry')
    				->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  FertilizationItem::find($id);
        $types      =  FertilizationType::items(0);
    	$stocks     =  Company::items(1);
        return view('admin.firtilization_plans.edit')
                ->with('stocks',$stocks)
                ->with('types',$types)
                ->with('data',$data)
                ->with('title',$data->ferrilization_plan->farm->name)
                ;
    }
    public function post_edit(Request $request,$id)
    {
        $item   =   FertilizationItem::find($id);
        $item->company_id =  $request->stock_item_id;
        $item->date =  $request->date;
        $item->fertilization_type_id =  $request->fertilization_type_id;
        $item->amount =  $request->quantity;
        $item->save();
        return  redirect('admin/fertilization-plans')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function index(Request $request)
    {
        $first    =  Area::first();
        $id       =  ($request->area_id)?$request->area_id:$first->id; 
    	$allData  =  FertilizationItem::whereHas('ferrilization_plan.farm',function($query) use($id){
                              $query->where('area_id',$id);
                          })->OrderBy('date','asc')->with('ferrilization_plan')->where(function($query) use($request){
					    		if ($request->nursery_id) {
					    			$query->where('nursery_id',$request->nursery_id);
					    		}
                                if ($request->farm_id) {
					    			$query->where('farm_id',$request->farm_id);
					    		}
                                if ($request->area_id) {
                                    $query->whereHas('ferrilization_plan.farm',function($query) use($request){
                                        $query->where('area_id',$request->area_id);
                                    });
                                }
                                if ($request->date_from) {
                                    $query->whereDate('date','>=',$request->date_from);
                                }
                                if ($request->date_to) {
                                    $query->whereDate('date','<=',$request->date_to);
                                }
					    	})->where('state',0)->paginate(30);
        foreach ($allData as $data) {
            $data->amount =  Stock::MRound($data->amount);      
        }
        ///
        $areas      =  Area::get();
    	return view('admin.firtilization_plans.index')
                    ->with('allData',$allData)
                    ->with('areas',$areas)
    				->with('id',$id)
    				->with('title',trans('home.Fertilizations'));
    }
    public function change_state($id)
    {
        $data =  FertilizationItem::find($id);
        $data->state =  1;
        $data->save();
        return back()
                ->with('yes',trans('home.Done Successfully'));
    }
    public function all_items(Request $request)
    {
        $allData  =  FertilizationItem::OrderBy('date','asc')->with('ferrilization_plan')->where(function($query) use($request){
                                if ($request->nursery_id) {
                                    $query->where('nursery_id',$request->nursery_id);
                                }
                                if ($request->farm_id) {
                                    $query->where('farm_id',$request->farm_id);
                                }
                                if ($request->area_id) {
                                    $query->whereHas('ferrilization_plan.farm',function($query) use($request){
                                        $query->where('area_id',$request->area_id);
                                    });
                                }
                                if ($request->date_from) {
                                    $query->whereDate('date','>=',$request->date_from);
                                }
                                if ($request->date_to) {
                                    $query->whereDate('date','<=',$request->date_to);
                                }
                            })->paginate(30);
        $areas      =  Area::get();
        return view('admin.firtilization_plans.plans')
                    ->with('allData',$allData)
                    ->with('areas',$areas)
                    ->with('title',trans('home.Fertilizations'));
    }
    public function delete($id)
    {
        $data =  FertilizationPlan::find($id);
        if ($data) {
            $data->delete();;
        }
        return back()
                ->with('yes',trans('home.Done Successfully'));
    }
}
