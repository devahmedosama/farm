<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $appends = ['name'];

    public function stock($value='')
    {
    	return $this->belongsTo('App\Models\Stock','stock_id');
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
