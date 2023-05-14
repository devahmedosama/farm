<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FertilizationPlan extends Model
{
    use HasFactory;
    protected $appends = ['area'];
    public function farm()
    {
    	return $this->belongsTo('App\Models\Farm','farm_id');
    }
    public function nursery()
    {
    	return $this->belongsTo('App\Models\Nursery','nursery_id');
    }
   
    public function getAreaAttribute()
    {
    	if ($this->farm) {
    		return $this->farm->area->name;
    	}elseif ($this->nursery) {
    		return $this->nursery->area->name;
    	}else{
    		return 1;
    	}
    }
    public function getNameAttribute()
    {
        $lang   =  \App::getLocale();
        $locale =   FertilizationPlanLocale::where('fertilization_plan_id',$this->attributes['id'])->where('locale',$lang)->first();
        if($locale){
            return $locale->name;
        }
    }
    public function items()
    {
         return $this->hasMany('App\Models\FertilizationItem','fertilization_plan_id');
    }
}
