<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{ 
    use HasFactory;

    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =  StockLocale::where('stock_id',$this->attributes['id'])
    					->where('locale',$lang)->first();
    	if ($locale) {
    		return $locale->name;
    	}
    }
    public function unit($value='')
    {
        return $this->belongsTo('App\Models\Unit','unit_id');
    }
    public static function items($type='')
    {
        $allData =  Stock::OrderBy('id','desc')->where(function($query) use($type){
                        if ($type) {
                            $query->where('stock_type_id',$type);
                        }
                    })->get();
        $arr = [];
        foreach ($allData as $data) {
            $arr[$data->id] =  $data->name.' ( '.$data->unit->name.' )';
        }
        return $arr;;
    }
    public static function move($id)
    {
        $plan =  FertilizationPlan::find($id);
        foreach ($plan->items as $item) {
            $amount  = $item->amount;
            $stock = Stock::where('available_amount','>',0)->where('company_id',$item->company_id)
                            ->where('fertilization_type_id',$item->fertilization_type_id)->first();
            if ($stock) {
                // available in gram
                $vailable =  $stock->available_amount*$stock->unit->equal_kg;
                // available in stock unit;
                $diff     =  $vailable -  $amount;
                $data =  new StockMove;
                $data->farm_id =  $plan->farm_id;
                $data->amount     = ($diff > 0)?$amount:abs($diff);
                $data->stock_id   =  $stock->id;
                $data->save();
                $stock->available_amount = ($diff >0)?$diff:0;
                $stock->save();
                if ($diff < 0) {
                    $wait  =  new WaitStock;
                    $wait->date =  $item->date;
                    $wait->company_id = $item->company_id;
                    $wait->fertilization_type_id = $item->fertilization_type_id;
                    $wait->amount = abs($diff)*$stock->unit->equal_kg*1000;
                    $wait->farm_id =  $plan->farm_id; 
                    $wait->save();
                }
            }else{
                $wait  =  new WaitStock;
                $wait->date =  $item->date;
                $wait->company_id = $item->company_id;
                $wait->fertilization_type_id = $item->fertilization_type_id;
                $wait->amount        = $item->amount*1000;
                $wait->farm_id =$plan->farm_id; 
                $wait->save();

            }
        }
    }
    public static function wait($id)
    {
         $stock = Stock::find($id);
         $items = WaitStock::where('company_id',$stock->company_id)
                    ->where('fertilization_type_id',$stock->fertilization_type_id)->get();
         foreach ($items as $item) {
             $amount =  $item->amount;
             $vailable =  $stock->available_amount*$stock->unit->equal_kg*1000;
            // available in stock unit;
            $diff     =  $vailable -  $amount;
            $data =  new StockMove;
            $data->farm_id =  $item->farm_id;
            $data->amount     = ($diff > 0)?$amount/1000:abs($diff)/1000;
            $data->stock_id   =  $stock->id;
            $data->save();
            $decre  =  $diff/(1000*$stock->unit->equal_kg);
            $stock->available_amount = ($diff >0)?$decre:0;
            $stock->save();
            if ($diff < 0) {
                $wait  =  new WaitStock;
                $wait->date =  $item->date;
                $wait->company_id = $item->company_id;
                $wait->fertilization_type_id = $item->fertilization_type_id;
                $wait->amount = abs($diff);
                $wait->farm_id =  $item->farm_id; 
                $wait->save();
            }
            $item->delete();
            if ($diff <= 0) {
                return 1;
            }
         }
    }
    public static function pesticide($id)
    {
        $plan =  PesticidePlan::find($id);
        foreach ($plan->items as $item) {
            $amount  = $item->amount;
            $stock = Stock::where('available_amount','>',0)->where('company_id',$item->company_id)
                    ->where('fertilization_type_id',$item->fertilization_type_id)->first();
            if ($stock) {
                // available in gram
                $vailable =  $stock->available_amount*$stock->unit->equal_kg*1000;
                // available in stock unit;
                $stock_amount = $amount/($stock->unit->equal_kg*1000);
                $diff     =  $stock->available_amount -  $stock_amount;
                $data =  new StockMove;
                $data->farm_id =  $plan->farm_id;
                $data->amount     = ($diff > 0)?$amount:abs($diff);
                $data->stock_id   =  $stock->id;
                $data->save();
                $stock->available_amount = ($diff >0)?$diff:0;
                $stock->save();
                if ($diff < 0) {
                    $wait  =  new WaitStock;
                    $wait->date =  $item->date;
                    $wait->company_id = $item->company_id;
                    $wait->fertilization_type_id = $item->fertilization_type_id;
                    $wait->amount = abs($diff)*$stock->unit->equal_kg*1000;
                    $wait->farm_id =  $plan->farm_id; 
                    $wait->save();
                }
            }else{
                $wait  =  new WaitStock;
                $wait->date =  $item->date;
                $wait->company_id = $item->company_id;
                $wait->fertilization_type_id = $item->fertilization_type_id;
                $wait->amount        = $item->amount;
                $wait->farm_id =$plan->farm_id; 
                $wait->save();
                return 2;

            }
        }
    }
    public static function packages()
    {
        $allData =  Stock::OrderBy('id','desc')->where(function($query){
                            $query->where('stock_type_id',7);
                    })->where('available_amount','>',0)->get();
        $arr = [];
        foreach ($allData as $data) {
            $arr[$data->id] =  $data->name.' ('.intval($data->available_amount).')';
        }
        return $arr;;
    }
    public function stock_type($value='')
    {
        return $this->belongsTo('\App\Models\StockType','stock_type_id');
    }
    public static function MRound($n) {
        $arr =  explode('.', $n);
        $x = $arr[0];
        $y = 0;
        if (array_key_exists(1,$arr)) {
            $x2 =  $arr[1];
            if ($x2 <= 25 ) {
                $y  = 0;
            }elseif ($x2 >= 26 && $x2 <=75 ) {
                $y = .5;
            }else{
                $y = 1;
            }
        }
        return $x+$y;
    }
    public function company($value='')
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }
}
