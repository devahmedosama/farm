<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =  UnitLocale::where('unit_id',$this->attributes['id'])
    					->where('locale',$lang)->first();
    	if ($locale) {
    		return $locale->name;
    	}
    }
    public static function items()
    {
        $arr = [];
        foreach (Unit::get() as $item) {
            $arr[$item->id] =  $item->name;
        }
        return $arr;
    }
    public static function weight()
    {
        $arr = [];
        foreach (Unit::where('equal_kg','>',0)->get() as $item) {
            $arr[$item->id] =  $item->name;
        }
        return $arr;
    }
}
 