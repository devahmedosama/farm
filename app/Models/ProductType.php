<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory; 
    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =  ProductTypeLocale::where('product_type_id',$this->attributes['id'])
    					->where('locale',$lang)->first();
    	if ($locale) {
    		return $this->product->name.' - '.$locale->name.'';
    	}
    }
    public function product($value='')
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }
	public static function items()
	{
		$arr = [];
		foreach(ProductType::get() as $item){
			$arr[$item->id] = $item->name;
		}
		return $arr;
	}
}
