<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Language;
use App\Models\StockType;
use App\Models\StockTypeLocale;

class StockTypeController extends Controller
{
    
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index()
    {
        $allData  =  StockType::OrderBy('id','desc')->paginate(30);
        return view('admin.stock_types.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Stock Types'));
    }
    public function add($value='')
    {
    	return view('admin.stock_types.add')
    			->with('title',trans('home.Add Stock Type'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'name'=>'required'
         	]);
        $data =  new StockType;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new StockTypeLocale;
        	$locale->locale       = $lang->locale;
        	$locale->stock_type_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/stock-types')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  StockType::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  StockTypeLocale::where('stock_type_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
        }
        return view('admin.stock_types.edit')
                   ->with('data',$data)
                   ->with('langs',$langs)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {

        $data =  StockTypeLocale::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $locale =  StockTypeLocale::where('stock_type_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale               =  new StockTypeLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->stock_type_id = $data->id;
            $locale->name         = $request->$name;
            $locale->save();
        }
        return  redirect('admin/stock-types')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  StockType::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
    
}
