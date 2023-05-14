<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Medicine;

class MedicineController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function add()
    {
    	$stocks =  Stock::items(2);
    	return view('admin.medicines.add')
    			->with('stocks',$stocks)
    			->with('title',trans('home.Medicine Process'));
    }
    public function edit($id)
    {
        $stocks =  Stock::items(1);
        $data   =  Medicine::find($id);
        return 22;
        return view('admin.medicines.edit')
                ->with('stocks',$stocks)
                ->with('data',$data)
                ->with('title',$data->name);
    }
    public function post_add(Request $request)
    {
    	$data                          =  new Medicine;
    	$data->farm_id              =  $request->farm_id;
    	$data->nursery_id              =  $request->nursery_id;
    	$data->quantity_per_100_letter =  $request->quantity_per_100_letter;
    	$data->stock_id                =  $request->stock_id;
        $data->amount                =  $request->amount;
        $data->date                =  $request->date;
    	$data->save();
    	$stock                   =  Stock::find($request->stock_id);
    	$stock->available_amount =  $stock->available_amount - $request->amount;
    	$stock->save();
    	return  redirect('admin/medicine?nursery_id='.$data->nursery_id.'&farm_id='.$data->farm_id)
    				->with('yes',trans('home.Done Successfully'));
    }
    public function post_edit(Request $request,$id)
    {

        $data                          =  new Medicine;
        $data->quantity_per_100_letter =  $request->quantity_per_100_letter;
        $data->stock_id                =  $request->stock_id;
        $data->amount                =  $request->amount;
        $data->date                =  $request->date;
        $data->save();
       
        return  redirect('admin/medicine?nursery_id='.$data->nursery_id.'&farm_id='.$data->farm_id)
                    ->with('yes',trans('home.Done Successfully'));
        
       
    }
    public function index(Request $request)
    {
    	$allData  =  Medicine::OrderBy('id','desc')->where(function($query) use($request){
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
    	return view('admin.medicines.index')
    				->with('allData',$allData)
    				->with('title',trans('home.Medicine'));
    }
    public function delete($id)
    {
        $data =  Medicine::find($id);
        if ($data) {
            $data->delete();
        }
        return back()
                ->with('yes',trans('home.Done Successfully'));
    }
}
