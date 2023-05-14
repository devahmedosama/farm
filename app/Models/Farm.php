<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;
    public static function states()
    {
        return [
            0=>trans('home.Farming'),
            1=>trans('home.Harvester'),
            2=>trans('home.Finished')
        ];
    }
    public function getNameAttribute()
    {
    	// $lang   =  \App::getLocale();
    	// $locale =   FarmLocale::where('farm_id',$this->attributes['id'])->where('locale',$lang)->first();
     //    if($locale){
     //        return $this->area->name.' ( '.$this->product_type->name.')';
     //    }
         return $this->area->name.' ( '.$this->product_type->name.')';
    }
    public static function types()
    {
        return [
            0=>trans('home.Open Field'),
            1=>trans('home.Green House'),
        ];
    } 
    public  function product_type()
    {
        return $this->belongsTo('App\Models\ProductType','product_type_id');
    }
    public static function active_items()
    {
        $arr  =  [];
        foreach (Farm::where('state',0)->get() as $item) {
            $arr[$item->id] =  $item->name;
        }
        return $arr;
    }
    public static function items()
    {
        $arr  =  [];
        foreach (Farm::OrderBy('id','desc')->get() as $item) {
            $arr[$item->id] =  $item->name;
        }
        return $arr;
    }
    public function harvester_items()
    {
        $arr  =  [];
        foreach (Farm::get() as $item) {
            $arr[$item->id] =  $item->name;
        }
        return $arr;
    }
    public function area()
    {
        return $this->belongsTo('App\Models\Area','area_id');
    }
    public function sell_items()
    {
        return $this->hasMany('App\Models\SellItem','farm_id');
    }
}
