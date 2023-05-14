<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\SupplierLocale;
use App\Models\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;
class SupplierController extends Controller
{
     protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index(Request $request)
    {
        $allData  =  Supplier::OrderBy('id','desc')->paginate(30);
        return view('admin.suppliers.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Suppliers'));
    }
    public function add()
    {
    	return view('admin.suppliers.add')
    			->with('title',trans('home.Add Supplier'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'name'=>'required'
         	]);
        $data =  new Supplier;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new SupplierLocale;
        	$locale->locale       = $lang->locale;
        	$locale->supplier_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/suppliers')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function ajax_add(Request $request)
    {
        $this->lang =  \App::getLocale();
       
        $data =  new Supplier;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale               =  new SupplierLocale;
            $locale->locale       = $lang->locale;
            $locale->supplier_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->supplier_name,$lang->locale, $this->lang);
            $locale->save();
        }
        $data =  Supplier::find($data->id);
         return  [
            'item'=> $data,
            'item_name'=>'supplier_id',
            'state'=>1
        ];
    }
    public function edit($id)
    {
        $data =  Supplier::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  SupplierLocale::where('supplier_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
        }
        return view('admin.suppliers.edit')
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
        $data =  Supplier::find($id);
        
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $locale =  SupplierLocale::where('supplier_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale               =  new SupplierLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->supplier_id = $data->id;
            $locale->name         = $request->$name;
            $locale->save();
        }
        return  redirect('admin/suppliers')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  Supplier::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
}
