<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\StockLocale;
use App\Models\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;
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
    	return view('admin.stocks.add')
    			->with('title',trans('home.Add Stock'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'name'=>'required'
         	]);
        $data =  new Stock;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new StockLocale;
        	$locale->locale       = $lang->locale;
        	$locale->stock_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->save();
        }
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
        }
        return view('admin.stocks.edit')
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
    
}
