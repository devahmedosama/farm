<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Area;
use App\Models\Sell;
use App\Models\Client;
use App\Models\Stock;
use App\Models\ProductType;
use App\Models\StockType;
use App\Models\StockMove;
use App\Models\Company;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
    	return view('admin.reports.index')
    			->with('title',trans('home.Reports'));
    }
    public function farms(Request $request)
    {   
    	if ($request->export) {
    		$areas    =  Area::items();
	    	$products =  ProductType::items();
	    	$allData  =  Farm::OrderBy('id','desc')->where(function($query) use($request){
					    		if ($request->date_from) {
					    			$query->whereDate('seeding_date','>=',$request->date_from);
					    		}
					    		if ($request->date_to) {
					    			$query->whereDate('seeding_date','<=',$request->date_to);
					    		}
					    		if ($request->area_id) {
					    			$query->where('area_id',$request->area_id);	
					    		}
					    		if ($request->product_type_id) {
					    			$query->where('product_type_id',$request->product_type_id);
					    		}
					    	})->get();
	    	$lang  =  \App::getLocale();
	    	$dir   =  ($lang == 'ar')?'rtl':'ltr';
	    	$text   =  ($lang == 'ar')?'right':'left';
	    	$data = [
		      'allData' => $allData,
		      'dir'=>$dir,
		      'text'=>$text,
		    ];
		    $pdf = PDF::loadView('pdf.farm', $data);
		    return $pdf->download('report.pdf');
    	}else{
    		$areas    =  Area::items();
	    	$products =  ProductType::items();
	    	$allData  =  Farm::OrderBy('id','desc')->where(function($query) use($request){
					    		if ($request->date_from) {
					    			$query->whereDate('seeding_date','>=',$request->date_from);
					    		}
					    		if ($request->date_to) {
					    			$query->whereDate('seeding_date','<=',$request->date_to);
					    		}
					    		if ($request->area_id) {
					    			$query->where('area_id',$request->area_id);	
					    		}
					    		if ($request->product_type_id) {
					    			$query->where('product_type_id',$request->product_type_id);
					    		}
					    	})->paginate(30);
	    	return view('admin.reports.farm')
	    			->with('areas',$areas)
	    			->with('allData',$allData)
	    			->with('products',$products)
	    			->with('title',trans('home.My Farm'));
    	}
    	
    }
    public function sells(Request $request)
    {
    	if ($request->export) {
    		$allData  =  Sell::OrderBy('id','desc')->where(function($query) use($request){
					    		if ($request->date_from) {
					    			$query->whereDate('date','>=',$request->date_from);
					    		}
					    		if ($request->date_to) {
					    			$query->whereDate('date','<=',$request->date_to);
					    		}
					    		if ($request->area_id) {
					    			$query->whereHas('items.farm',function($query) use($request){
					    				$query->where('area_id',$request->area_id);
					    			});	
					    		}
					    		if (app('request')->input('product_type_id')) {
					    			$query->whereHas('items.farm',function($query){
					    				$query->where('product_type_id',app('request')->input('product_type_id'));
					    			});	
					    		}
					    		if ($request->client_id) {
					    			$query->where('client_id',$request->client_id);
					    		}
								if ($request->area_id) {
									$query->whereHas('items.farm',function($query) use($request){
											$query->where('area_id',$request->area_id);
									});
								}
					    	})->with(['items'=>function($query) use($request){
								if ($request->area_id) {
									$query->whereHas('farm',function($query) use($request){
											$query->where('area_id',$request->area_id);
									});
								}
							}])->get();
    		$lang  =  \App::getLocale();
	    	$dir   =  ($lang == 'ar')?'rtl':'ltr';
	    	$text   =  ($lang == 'ar')?'right':'left';
	    	$data = [
		      'allData' => $allData,
		      'dir'=>$dir,
		      'text'=>$text,
		    ];
		    $pdf = PDF::loadView('pdf.sell', $data);
		    return $pdf->stream('report.pdf');
    	}else{
    		$areas    =  Area::items();
	    	$products =  ProductType::items();
	    	$clients =  Client::items();
	    	$allData  =  Sell::OrderBy('id','desc')->where(function($query) use($request){
					    		if ($request->date_from) {
					    			$query->whereDate('date','>=',$request->date_from);
					    		}
					    		if ($request->date_to) {
					    			$query->whereDate('date','<=',$request->date_to);
					    		}
					    		if ($request->area_id) {
					    			$query->whereHas('items.farm',function($query) use($request){
					    				$query->where('area_id',$request->area_id);
					    			});	
					    		}
					    		if (app('request')->input('product_type_id')) {
					    			$query->whereHas('items.farm',function($query){
					    				$query->where('product_type_id',app('request')->input('product_type_id'));
					    			});	
					    		}
					    		if ($request->client_id) {
					    			$query->where('client_id',$request->client_id);
					    		}
					    	})->paginate(30);
	    	return view('admin.reports.sells')
	    			->with('areas',$areas)
	    			->with('clients',$clients)
	    			->with('allData',$allData)
	    			->with('products',$products)
	    			->with('title',trans('home.My Farm'));
    	}
    	
    }
    public function sell_print($id)
    {
    	$data       =  Sell::find($id);
    	$lang  =  \App::getLocale();
    	$dir   =  ($lang == 'ar')?'rtl':'ltr';
    	$text   =  ($lang == 'ar')?'right':'left';
    	
    	$areas = Area::whereHas('farms',function($query) use($data){
    				$query->whereHas('sell_items',function($query) use($data){
					    		$query->where('sell_id',$data->id);
					    	});
		    	})->get();
    	foreach ($areas as $area) {
    		$weight   =  0;
    		$quantity = 0;
    		$support  = 0 ;
    		$items  =  \App\Models\SellItem::where('sell_id',$data->id)->where(function($query) use($area){
                            $query->whereHas('farm',function($query) use($area){
                                    $query->where('area_id',$area->id);
                            });                        
                    })->get();
		        foreach ($items as $item) {
		            $weight += $item->quantity*$item->unit_weight;
		            $quantity +=  $item->quantity;
		            $support += ($item->quantity*$item->unit_weight*$item->farm->product_type->product->support_amount);
		        }
		    $area->weight   =  $weight;
		    $area->quantity =  $quantity;
		    $area->support  =  $support;
    	}
    	$data = [
		      'data' => $data,
		      'dir'=>$dir,
		      'text'=>$text,
		      'areas'=>$areas,
		    ];
		    $pdf = PDF::loadView('pdf.single_sell', $data);
		    return $pdf->stream('report.pdf');
    }
    public function stocks(Request $request)
    {
    	if ($request->export) {
    		$allData  =  Stock::OrderBy('id','desc')->where(function($query) use($request){
				            if ($request->date_from) {
				                $query->whereDate('created_at','>=',$request->date_from);
				            }
				            if ($request->date_to) {
				                $query->whereDate('created_at','<=',$request->date_to);
				            }
				            if ($request->stock_type_id) {
				                 $query->where('stock_type_id',$request->stock_type_id);
				            }
				            if ($request->company_id) {
				            	$query->where('company_id',$request->company_id);
				            }
				        })->get();
    		$lang  =  \App::getLocale();
	    	$dir   =  ($lang == 'ar')?'rtl':'ltr';
	    	$text   =  ($lang == 'ar')?'right':'left';
	    	$data = [
		      'allData' => $allData,
		      'dir'=>$dir,
		      'text'=>$text,
		    ];
		    $pdf = PDF::loadView('pdf.stock', $data);
		    return $pdf->download('report.pdf');
	    	
    	}else{
    		$allData  =  Stock::OrderBy('id','desc')->where(function($query) use($request){
				            if ($request->date_from) {
				                $query->whereDate('created_at','>=',$request->date_from);
				            }
				            if ($request->date_to) {
				                $query->whereDate('created_at','<=',$request->date_to);
				            }
				            if ($request->stock_type_id) {
				                 $query->where('stock_type_id',$request->stock_type_id);
				            }
				        })->paginate(30);
	    	$stock_types  =  StockType::items();
	    	$stock_items =  Company::all_items();
	        $comapnies = Company::types();
	        return view('admin.reports.stocks')
	        		->with('allData',$allData)
	        		->with('stock_items',$stock_items)
	        		->with('companies',$comapnies)
	        		->with('stock_types',$stock_types)
	           	    ->with('title',trans('home.Stocks'));
    	}
    	
    }
    public function moves(Request $request)
    {
    	$allData =  StockMove::OrderBy('id','desc')->where(function($query) use($request){
				            if ($request->date_from) {
				                $query->whereDate('created_at','>=',$request->date_from);
				            }
				            if ($request->date_to) {
				                $query->whereDate('created_at','<=',$request->date_to);
				            }
				            if ($request->stock_type_id) {
				                 $query->whereHas('stock',function($query) use($request){
				                 	$query->where('stock_type_id',$request->stock_type_id);
				                 });
				            }
				        })->paginate(30);
    	$stock_types  =  StockType::items();
    	 return view('admin.reports.moves')
        		->with('allData',$allData)
        		->with('stock_types',$stock_types)
           	    ->with('title',trans('home.Stock Move'));
    }
}
