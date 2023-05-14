<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockItem;
use App\Models\StockItemLocale;
use App\Models\FertilizationType;
use App\Models\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;

class StockItemController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index(Request $request)
    {
        $allData  =  StockItem::OrderBy('id','desc')->where(function($query) use($request){
            if ($request->id) {
                $query->where('fertilization_type_id',$request->id);
            }
        })->paginate(30);
        $item =  FertilizationType::find($request->id);
        $parent_title = trans('home.Fertilization Types');
        $type =  0;
        if ($item) {
           $type =  $item->type;
           $parent_title = ($item->type == 1)?trans('home.Pesticide Types'):trans('home.Fertilization Types');
        }
        $title =  ($item)?$item->name.' '.trans('home.Companies'):' ';
        return view('admin.stock_items.index')
                ->with('type',$type)
                ->with('allData',$allData)
                ->with('parent_title',$parent_title)
                ->with('title',$title)
                			;
    }
    public function add(Request $request)
    {
        $items =  FertilizationType::items();
        $item =  FertilizationType::find($request->id);
        $title =  ($item)?$item->name.' '.trans('home.Companies'):' ';
        $parent_title = trans('home.Fertilization Types');
        $type =  0;
        if ($item) {
           $type =  $item->type;
           $parent_title = ($item->type == 1)?trans('home.Pesticide Types'):trans('home.Fertilization Types');
        }
    	return view('admin.stock_items.add')
                ->with('items',$items)
                ->with('parent_title',$parent_title)
                ->with('type',$type)
    			->with('title',$title);

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'name'=>'required',
         	'fertilization_type_id'=>'required'
         	]);
        $data =  new StockItem;
        $data->fertilization_type_id =  $request->fertilization_type_id;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new StockItemLocale;
        	$locale->locale       = $lang->locale;
        	$locale->stock_item_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/stock-items?id='.$data->fertilization_type_id)
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  StockItem::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  StockItemLocale::where('stock_item_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
        }
        $parent_title = trans('home.Fertilization Types');
        $type =  0;
        if ($data->fertilization_type) {
           $type =  $data->fertilization_type->type;
           $parent_title = ($data->fertilization_type->type == 1)?trans('home.Pesticide Types'):trans('home.Fertilization Types');
        }
        return view('admin.stock_items.edit')
                   ->with('data',$data)
                   ->with('langs',$langs)
                   ->with('parent_title',$parent_title)
                   ->with('type',$type)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {
        
        $data =  StockItem::find($id);
        
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $locale =  StockItemLocale::where('stock_item_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale               =  new StockItemLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->stock_item_id = $data->id;
            $locale->name         = $request->$name;
            $locale->save();
        }
        return  redirect('admin/stock-items?id='.$data->fertilization_type_id)
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  StockItem::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
}
