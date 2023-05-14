<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sell;
use App\Models\Client;
use App\Models\Farm;
use App\Models\Unit;
use App\Models\Language;
use App\Models\SellLocale;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\SellItem;
use App\Models\Stock;


class SellController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function add()
    {
    	$clients    =  Client::items();
        $farms      =  Farm::get();
    	$packages      =  Stock::packages();
        //return $packages;
    	return view('admin.sells.add')
                ->with('clients',$clients)
                ->with('farms',$farms)
    			->with('packages',$packages)
    			->with('title',trans('home.New Sell'));
    }
    public function edit($id)
    {
        $data       =  Sell::find($id);
        $clients    =  Client::get();
        $client_ite    =  Client::items();
        $farms      =  Farm::get();
        $items      =  Farm::items();
        $packages   =  Stock::packages();
        return view('admin.sells.edit')
                ->with('clients',$clients)
                ->with('packages',$packages)
                ->with('farms',$farms)
                ->with('items',$items)
                ->with('client_ite',$client_ite)
                ->with('data',$data)
                ->with('title',trans('home.Sells'));
    }
    public function post_add(Request $request)
    {
        $request->validate([
            'farm_id'=>'required'
            ],[
            'farm_id.required'=>trans('home.The Bill Is Empty')
            ]);
    	$this->lang =  \App::getLocale();
        $data              =  new Sell;
        $data->date        =  $request->date;
    	$data->save();
       
        foreach ($request->farm_id as $key => $farm_id) {
            $item              =  new SellItem;
            $item->sell_id     =  $data->id;
            $item->farm_id     =  $farm_id;
            $item->stock_id    = $request->stock_id[$key];
            $item->client_id   = $request->client_id[$key];
            $item->quantity    = $request->quantity[$key];
            // $item->discount    = $request->discount[$key];
            $item->unit_weight =  $request->unit_weight[$key];
            // $item->unit_price  =  $request->unit_price[$key];
            // $item->total_price = $request->total_price[$key];
            $item->save();
            $stock =  Stock::find($item->stock_id);
            if ($stock) {
                $stock->decrement('available_amount',$item->quantity);
                $stock->save();
            }
        }
    	return  redirect('admin/sells')
    				->with('yes',trans('home.Done Successfully'));
    }
    public function post_edit(Request $request,$id)
    {
        $data              =  Sell::find($id);
        $data->date        =  $request->date;
        $data->save();
        $ids = ($request->item_id)?$request->item_id:[];
        SellItem::where('sell_id',$id)->whereNotIn('id',$ids)->delete();
        foreach ($ids as $key => $item_id) {
              $item               =  SellItem::find($item_id);
              $item->farm_id      =  $request->old_farm_id[$key];
              $item->quantity     =  $request->old_quantity[$key];
              $item->stock_id     =  $request->old_stock_id[$key];
              $item->client_id    =  $request->old_client_id[$key];
              $item->unit_weight  =  $request->old_unit_weight[$key];
            //  $item->unit_price   =  $request->old_unit_price[$key];
            //  $item->total_price  =  $request->old_total_price[$key];
              $item->save();
        }
        if ($request->farm_id) {
            foreach ($request->farm_id as $key => $farm_id) {
                $item              =  new SellItem;
                $item->sell_id     =  $data->id;
                $item->farm_id     =  $farm_id;
                $item->quantity    = $request->quantity[$key];
                $item->stock_id    = $request->stock_id[$key];
                $item->client_id   = $request->client_id[$key];
                $item->unit_weight =  $request->unit_weight[$key];
                //$item->unit_price  =  $request->unit_price[$key];
               // $item->total_price = $request->total_price[$key];
                $item->save();
            }
        }
        
        return  redirect('admin/sells')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function index(Request $request)
    {
    	$allData  =  Sell::OrderBy('id','desc')->where(function($query) use($request){
                            if ($request->date_from) {
                                $query->whereDate('date','>=',$request->date_from);
                            }
                            if ($request->date_to) {
                                $query->whereDate('date','<=',$request->date_to);
                            }
                        })->paginate(30);

    	return view('admin.sells.index')
    				->with('allData',$allData)
    				->with('title',trans('home.Sells'));
    }
    public function delete($id)
    {
        $data = Sell::find($id);
        if ($data) {
            $data->delete();
        }
        return back()
                ->with('yes',trans('home.Done Successfully'));
    }
}
