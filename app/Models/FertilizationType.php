<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FertilizationType extends Model
{
    use HasFactory;

    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =  FertilizationTypeLocale::where('fertilization_type_id',$this->attributes['id'])
    					->where('locale',$lang)->first();
    	if ($locale) {
    		return $locale->name;
    	}
    }
     public function unit()
    {
        return $this->belongsTo('App\Models\Unit','unit_id');
    }
    public static function items($type=0)
    {
        $arr = [];
        foreach (FertilizationType::where('type',$type)->get() as $item) {
            $arr[$item->id] =  $item->name;
        }
        return $arr;
    }
    public static function all_items()
    {
        $arr = [];
        foreach (FertilizationType::get() as $item) {
            $arr[$item->id] =  $item->name;
        }
        return $arr;
    }
}
