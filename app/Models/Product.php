<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; 
    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =  ProductLocale::where('product_id',$this->attributes['id'])
    					->where('locale',$lang)->first();
    	if ($locale) {
    		return $locale->name;
    	}
    }
    public static function items($value='')
    {
        $arr = [];
        foreach (Product::get() as $item) {
            $arr[$item->id] = $item->name;
        }
        return $arr;
    }
}
