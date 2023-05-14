<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nursery extends Model
{
    use HasFactory;

    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =   NurseryLocale::where('nursery_id',$this->attributes['id'])->where('locale',$lang)->first();
        if($locale){
            return $locale->name;
        }
    }
    public static function states()
    {
    	return [
    	      0=>trans('home.Farming'),
    	      1=>trans('home.Transfering'),
    	      2=>trans('home.Finished')
    	];
    }
    public  function product_type()
    {
        return $this->belongsTo('App\Models\ProductType','product_type_id');
    }
    public static function active_items()
    {
        $arr  =  [];
        foreach (Nursery::where('state',0)->get() as $item) {
            $arr[$item->id] =  $item->product_type->name.'-'.$item->seeding_date;
        }
        return $arr;
    }
    public static function items()
    {
        $arr  =  [];
        foreach (Nursery::OrderBy('id','desc')->get() as $item) {
            $arr[$item->id] =  $item->product_type->name.'-'.$item->seeding_date;
        }
        return $arr;
    }
    public function area()
    {
        return $this->belongsTo('App\Models\Area','area_id');
    }
}
