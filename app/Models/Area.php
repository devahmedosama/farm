<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
     public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =   AreaLocale::where('area_id',$this->attributes['id'])->where('locale',$lang)->first();
        if($locale){
            return $locale->name;
        }
    }
    public static function items()
    {
        $arr =  [];
        foreach (Area::get() as $data) {
        	$arr[$data->id] =  $data->name;
        }
        return $arr;
    }
    public function farms($value='')
    {
         return $this->hasMany('App\Models\Farm','area_id');
    }
} 
