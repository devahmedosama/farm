<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    use HasFactory;
    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =  StockItemLocale::where('stock_item_id',$this->attributes['id'])
    					->where('locale',$lang)->first();
    	if ($locale) {
    		return $locale->name;
    	}
    }
    public static function items()
    {
         $arr = [];
         $items  = StockItem::whereHas('fertilization_type',function($query){
                                $query->where('type',0);
                             })->get();
         foreach ($items as $data) {
             $arr[$data->id] = $data->fertilization_type->name.' ('.$data->name.')';
         }
         return $arr;
    }
    public static function pesticides()
    {
         $arr = [];
         $items  = StockItem::whereHas('fertilization_type',function($query){
                                $query->where('type',1);
                             })->get();
         foreach ($items as $data) {
             $arr[$data->id] = $data->fertilization_type->name.' ('.$data->name.')';
         }
         return $arr;
    }
    public static function all_items(Type $var = null)
    {
        $arr = [];
         foreach (StockItem::get() as $data) {
             $arr[$data->id] =  $data->fertilization_type->name.' ('.$data->name.')';
         }
         return $arr;
    }
    public function fertilization_type()
    {
        return $this->belongsTo('\App\Models\FertilizationType','fertilization_type_id');
    }
}
