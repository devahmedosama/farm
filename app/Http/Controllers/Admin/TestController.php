<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TestController extends Controller
{
    public function index()
    {
    	$tra = [];
    	$arr = [
                'Products'=>'Products',
                'Add Product Type'=>'Add Product Type',
                'Product Types'=>'Product Types',
                'Image'=>'Image',
                'Choose Product'=>'Choose Product',
                'Product'=>'Product',
                'Add Stock Type'=>'Add Stock Type',
                'Stock Types'=>'Stock Types',
                'Add Unit'=>'Add Unit',
                'Units'=>'Units',
                'Add Supplier'=>'Add Supplier',
                'Suppliers'=>'Suppliers',
                'Add Stock'=>'Add Stock',
                'Stocks'=>'Stocks',
                'Stock Type'=>'Stock Type',
                'Choose Supplier'=>'Choose Supplier',
                'Choose Unit'=>'Choose Unit',
                'Quantity'=>'Quantity',
                'Unit Price'=>'Unit Price',
                'Total Price'=>'Total Price',
                'Unit'=>'Unit',
                'Supplier'=>'Supplier',
                'General'=>'General',
			   
			];
			foreach ($arr as $key => $value) {
				$tra[$key] =  GoogleTranslate::trans($value,'ar', 'en');
			}
			return json_encode($tra);
    }
}
