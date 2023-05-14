<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockType extends Model
{
    use HasFactory;

    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =  StockTypeLocale::where('stock_type_id',$this->attributes['id'])
    					->where('locale',$lang)->first();
    	if ($locale) {
    		return $locale->name;
    	}
    }

    public static function items()
    {
        $arr = [];
        foreach (StockType::get() as $item) {
            $arr[$item->id] =  $item->name;
        }
        return $arr;
    }

}

