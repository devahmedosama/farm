<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductLocale;


class ProductController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index()
    {
        $allData  =  Product::OrderBy('id','desc')->paginate(30);
        return view('admin.products.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Products'));
    }
    public function add($value='')
    {
    	return view('admin.products.add')
    			->with('title',trans('home.Add Product'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
         	'name'=>'required'
         	]);
        $data =  new Product;
        $data->support_amount  =  $request->support_amount;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
        	$locale               =  new ProductLocale;
        	$locale->locale       = $lang->locale;
        	$locale->product_id = $data->id;
            $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
        	$locale->save();
        }
        return  redirect('admin/products')
        			->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  Product::find($id);

        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  ProductLocale::where('product_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
        }
        return view('admin.products.edit')
                   ->with('data',$data)
                   ->with('langs',$langs)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {

        $data =  Product::find($id);
        $data->support_amount  =  $request->support_amount;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $locale =  ProductLocale::where('product_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale               =  new ProductLocale;
            }
            $locale->locale       = $lang->locale;
            $locale->product_id = $data->id;
            $locale->name         = $request->$name;
            $locale->save();
        }
        return  redirect('admin/products')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  Product::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
}
