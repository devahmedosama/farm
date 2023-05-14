<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\StockType;
use App\Models\StockLocale;
use App\Models\Language;
use App\Models\StockMove;
use App\Models\Nursery;
use App\Models\Farm;
use App\Models\Equipment;
use App\Models\Unit;
use Stichoza\GoogleTranslate\GoogleTranslate;
use  App\Models\StockItem;
use  App\Models\FertilizationType;
use  App\Models\Company;

class StockController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index(Request $request)
    {
        $allData  =  Stock::OrderBy('id','desc')->where(function($query) use($request){
            if ($request->date_from) {
                $query->whereDate('created_at','>=',$request->date_from);
            }
            if ($request->date_to) {
                $query->whereDate('created_at','<=',$request->date_to);
            }
        })->paginate(30);
        return view('admin.stocks.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Stocks'));
    }
    public function add()
    {
    	$items     =  StockType::items();
    	$suppliers =  Supplier::items();
    	$units     =  Unit::items();
        $stock_items =  Company::all_items();
        $types =  FertilizationType::all_items();
        $comapnies = Company::types();
    	return view('admin.stocks.add')
                 ->with('items',$items)
                ->with('stock_items',$stock_items)
                ->with('types',$types)
                ->with('companies',$comapnies)
    			->with('suppliers',$suppliers)
    			->with('units',$units)
    			->with('title',trans('home.Add Stock'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'name'=>'required'
         	]);
        $data =  new Stock;
        $data->supplier_id =  $request->supplier_id;
        $data->company_id =  $request->company_id;
        $data->fertilization_type_id =  $request->fertilization_type_id;
        $data->stock_item_id =  $request->stock_item_id;
        $data->unit_id =  $request->unit_id;
        $data->unit_weight =  $request->unit_weight;
        $data->stock_type_id =  $request->stock_type_id;
        $amount =  ($request->unit_weight*$request->quantity);
        $unit =  Unit::find($request->unit_id);
        $data->quantity = ($unit->equal_kg >0)?$amount:$request->quantity ;
        $data->available_amount = $data->quantity;
        $data->unit_price =  $request->unit_price;
        $data->total_price =  $request->total_price;
        $data->save();
    
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new StockLocale;
        	$locale->locale       = $lang->locale;
        	$locale->stock_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
            if ($request->text) {
                       $locale->text         = GoogleTranslate::trans($request->text,$lang->locale, $this->lang);
            }
        	$locale->save();
        }
        Stock::wait($data->id);
        return  redirect('admin/stocks')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  Stock::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  StockLocale::where('stock_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
            $lang->locale_text =  ($locale)?$locale->text:' ';
        }
        $items     =  StockType::items();
    	$suppliers =  Supplier::items();
    	$units     =  Unit::items();
        $quantity  =  ($data->unit->equal_kg > 0 && $data->unit_weight > 0)?$data->quantity/$data->unit_weight:$data->quantity;
    	$data->quantity =  $quantity;
        $stock_items =  Company::all_items();
        $types =  FertilizationType::all_items();
        return view('admin.stocks.edit')
                    ->with('items',$items)
                    ->with('stock_items',$stock_items)
                    ->with('types',$types)
	    			->with('suppliers',$suppliers)
	    			->with('units',$units)
                    ->with('data',$data)
                    ->with('langs',$langs)
                    ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {
        $request->validate([
            'image'=>'mimes:jpg,png,jpeg'
            ]);
        $data =  Stock::find($id);
        $data->supplier_id =  $request->supplier_id;
        $data->unit_id =  $request->unit_id;
        $data->stock_type_id =  $request->stock_type_id;
        $data->company_id =  $request->company_id;
        $data->fertilization_type_id =  $request->fertilization_type_id;
        $data->stock_item_id =  $request->stock_item_id;
        $amount =  ($request->unit_weight*$request->quantity);
        $unit =  Unit::find($request->unit_id);
        $data->quantity = ($unit->equal_kg >0)?$amount:$request->quantity ;
        $data->available_amount = $data->quantity;
        $data->unit_price =  $request->unit_price;
        $data->total_price =  $request->total_price;
        $data->unit_weight =  $request->unit_weight;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $locale =  StockLocale::where('stock_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale               =  new StockLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->stock_id = $data->id;
            $locale->name         = $request->$name;
            if ($request->text) {
                $locale->text         = GoogleTranslate::trans($request->text,$lang->locale, $this->lang);
            }
            $locale->save();
        }
        return  redirect('admin/stocks')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  Stock::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
    public function move()
    {
        $stocks      =  Stock::where('available_amount','>',0)->get();
        $nurseries   =  Nursery::items();
        $farms       =  Farm::items();
        $equipments  =  Equipment::items();
        return view('admin.stocks.move')
                ->with('farms',$farms)
                ->with('nurseries',$nurseries)
                ->with('stocks',$stocks)
                ->with('equipments',$equipments)
                ->with('title',trans('home.Stock Move'));
    }
    public function post_move(Request $request)
    {
        $data =  new StockMove;
        $data->nursery_id =  $request->nursery_id;
        $data->farm_id =  $request->farm_id;
        $data->equipment_id =  $request->equipment_id;
        $data->amount     =  $request->amount;
        $data->stock_id   =  $request->stock_id;
        $data->save();
        $stock =  Stock::find($data->stock_id);
        $stock->decrement('available_amount');
        $stock->save();
        return redirect('admin/data-entry')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function stock_moves(Request $request)
    {
        $nurseries   =  Nursery::items();
        $farms       =  Farm::items();
        $equipments  =  Equipment::items();
        $allData     =  StockMove::OrderBy('id','desc')->where(function($query) use($request){
            if ($request->date_from) {
                $query->where('created_at','>=',$request->date_from);
            }
            if ($request->date_to) {
                $query->where('created_at','<=',$request->date_to);
            }
        })->paginate(30);
        return view('admin.stocks.stock_moves')
                ->with('allData',$allData)
                ->with('farms',$farms)
                ->with('nurseries',$nurseries)
                ->with('equipments',$equipments)
                ->with('title',trans('home.Stock Move'));
    }
    public function delete_move($id)
    {
        $data =  StockMove::find($id);
        if ($data) {
            $stock =  Stock::find($data->stock_id);
            $stock->increment('available_amount');
            $stock->save();
            $data->delete();
        }
        return back()
                ->with('yes',trans('home.Done Successfully'));
    }
}
