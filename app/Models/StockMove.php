<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMove extends Model
{
    use HasFactory;

    public function stock()
    {
    	return $this->belongsTo('App\Models\Stock','stock_id');
    }
    public function nursery()
    {
    	return $this->belongsTo('App\Models\Nursery','nursery_id');
    }
    public function farm()
    {
    	return $this->belongsTo('App\Models\Farm','farm_id');
    }
    public function equipment()
    {
    	return $this->belongsTo('App\Models\Equipment','equipment_id');
    }
}
