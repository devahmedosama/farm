<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;
     
    public function farm()
    {
    	return $this->belongsTo('\App\Models\Farm','farm_id');
    }
    public function unit()
    {
    	return $this->belongsTo('\App\Models\Unit','unit_id');
    }
    public function client()
    {
    	return $this->belongsTo('\App\Models\Client','client_id');
    }
    public function items()
    {
        return $this->hasMany('\App\Models\SellItem','sell_id');
    }
    public function getTotalPriceAttribute()
    {
        $items  =  SellItem::where('sell_id',$this->attributes['id'])->get();
        $total  =  0;
        foreach ($items as $item) {
            $total += intval($item->total_price);
        }
        return $total;
    }
    public function getTotalWeightAttribute()
    {
        $items  =  SellItem::where('sell_id',$this->attributes['id'])->where(function($query){
                        if (app('request')->input('area_id')) {
                            $query->whereHas('farm',function($query){
                                    $query->where('area_id',app('request')->input('area_id'));
                            }); 
                        }
                        if (app('request')->input('product_type_id')) {
                            $query->whereHas('farm',function($query){
                                    $query->where('product_type_id',app('request')->input('product_type_id'));
                            }); 
                        }
                       
                    })->get();
        $total  =  0;
        foreach ($items as $item) {
            $total += $item->quantity*$item->unit_weight;
        }
        return $total;
    }
    public function getTotalQuantityAttribute()
    {
        $items  =  SellItem::where('sell_id',$this->attributes['id'])->get();
        $total  =  0;
        foreach ($items as $item) {
            $total += $item->quantity;
        }
        return $total;
    }
    public function getTotalSupportAttribute()
    {
        $items  =  SellItem::where('sell_id',$this->attributes['id'])->where(function($query){
            if (app('request')->input('area_id')) {
                $query->whereHas('farm',function($query){
                        $query->where('area_id',app('request')->input('area_id'));
                }); 
            }
            if (app('request')->input('product_type_id')) {
                $query->whereHas('farm',function($query){
                        $query->where('product_type_id',app('request')->input('product_type_id'));
                }); 
            }
        })->get();
        $total  =  0;
        foreach ($items as $item) {
            if ($item->farm) {
               $total += ($item->quantity*$item->unit_weight*$item->farm->product_type->product->support_amount);
            }
        }
        return $total;
    }
}
