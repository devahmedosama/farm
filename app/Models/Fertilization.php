<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fertilization extends Model
{
    use HasFactory;

    protected $appends = ['name'];

    public function stock()
    {
        return $this->belongsTo('App\Models\Stock','stock_id');
    }
    public function fertilization_type()
    {
    	return $this->belongsTo('App\Models\FertilizationType','fertilization_type_id');
    }
    public function getNameAttribute()
    {
    	$nursery  =  Nursery::find($this->attributes['nursery_id']);
        $farm     =  Farm::find($this->attributes['farm_id']);
    	if ($nursery) {
    		return $nursery->name ;
    	}elseif($farm){
            return $farm->name;
        }
    }
}
