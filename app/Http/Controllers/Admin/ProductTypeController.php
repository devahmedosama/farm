<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Language;
use App\Models\ProductType;
use App\Models\Product;
use App\Models\ProductTypeLocale;

class ProductTypeController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index(Request $request)
    {
        $allData  =  ProductType::OrderBy('id','desc')->where(function($query) use($request){
            if ($request->product_id) {
                $query->where('product_id',$request->product_id);
            }
        })->paginate(30);
        return view('admin.product_types.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Product Types'));
    }
    public function add()
    {
        $items =  Product::items();
    	return view('admin.product_types.add')
                ->with('items',$items)
    			->with('title',trans('home.Add Product Type'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'name'=>'required',
            'image'=>'mimes:jpg,png,jpeg'
         	]);
        $data =  new ProductType;
        $data->product_id =  $request->product_id;
        if ($request->hasFile('image')) {
            $file        =   $request->file('image'); 
            $filename    =  'uploads/products/'.time().'.jpg';
            $file->move('uploads/products',$filename);
            $data->image =  $filename;
        }
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new ProductTypeLocale;
        	$locale->locale       = $lang->locale;
        	$locale->product_type_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/product-types?product_id='.$data->product_id)
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  ProductType::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  ProductTypeLocale::where('product_type_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
        }
        $items =  Product::items();
        return view('admin.product_types.edit')
                   ->with('items',$items)
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
        $data =  ProductType::find($id);
        $data->product_id =  $request->product_id;
        if ($request->hasFile('image')) {
            $file        =   $request->file('image'); 
            $filename    =  'uploads/products/'.time().'.jpg';
            $file->move('uploads/products',$filename);
            $data->image =  $filename;
        }
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $locale =  ProductTypeLocale::where('product_type_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale               =  new ProductTypeLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->product_type_id = $data->id;
            $locale->name         = $request->$name;
            $locale->save();
        }
        return  redirect('admin/product-types')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  ProductType::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
}
