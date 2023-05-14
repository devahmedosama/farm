<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FertilizationType;
use App\Models\Stock;
use App\Models\Fertilization;
use App\Models\Language;

class FertilizationController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function add()
    {
    	$types  =  FertilizationType::items();
    	$stocks =  Stock::items(2);
    	return view('admin.fertilizations.add')
    			->with('types',$types)
    			->with('stocks',$stocks)
    			->with('title',trans('home.Fertilization Process'));
    }
    public function edit($id)
    {
        $types  =  FertilizationType::items();
        $stocks =  Stock::items(1);
        $data   =  Fertilization::find($id);

        return view('admin.fertilizations.edit')
                ->with('types',$types)
                ->with('stocks',$stocks)
                ->with('data',$data)
                ->with('title',trans('home.Fertilization Process'));
    }
    public function post_add(Request $request)
    {
    	$data                          =  new Fertilization;
    	$data->nursery_id              =  $request->nursery_id;
    	$data->farm_id              =  $request->farm_id;
    	$data->fertilization_type_id   =  $request->fertilization_type_id;
    	$data->quantity_per_100_letter =  $request->quantity_per_100_letter;
    	$data->stock_id                =  $request->stock_id;
        $data->amount                =  $request->amount;
        $data->date                =  $request->date;
    	$data->save();
    	$stock                   =  Stock::find($request->stock_id);
    	$stock->available_amount =  $stock->available_amount - $request->amount;
    	$stock->save();
    	return  redirect('admin/fertilization?nursery_id='.$data->nursery_id.'&farm_id='.$data->farm_id)
    				->with('yes',trans('home.Done Successfully'));
    }
    public function post_edit(Request $request,$id)
    {
        $data                          =  Fertilization::find($id);
        $data->fertilization_type_id   =  $request->fertilization_type_id;
        $data->quantity_per_100_letter =  $request->quantity_per_100_letter;
        $data->stock_id                =  $request->stock_id;
        $data->date                =  $request->date;
        $data->save();
        
        return  redirect('admin/fertilization?nursery_id='.$data->nursery_id.'&farm_id='.$data->farm_id)
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function index(Request $request)
    {
    	$allData  =  Fertilization::OrderBy('id','desc')->where(function($query) use($request){
					    		if ($request->nursery_id) {
					    			$query->where('nursery_id',$request->nursery_id);
					    		}
                                if ($request->farm_id) {
					    			$query->where('farm_id',$request->farm_id);
					    		}
                                if ($request->date_from) {
                                    $query->whereDate('date','>=',$request->date_from);
                                }
                                if ($request->date_to) {
                                    $query->whereDate('date','<=',$request->date_to);
                                }
					    	})->paginate(30);
    	return view('admin.fertilizations.index')
    				->with('allData',$allData)
    				->with('title',trans('home.Fertilizations'));
    }
}
