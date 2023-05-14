<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FertilizationItem extends Model
{
    use HasFactory;

    public function stock()
    {
    	return $this->belongsTo('App\Models\Stock','stock_id');
    }
    
    public function stock_item()
    {
        return $this->belongsTo('App\Models\StockItem','stock_item_id');
    }
    public function ferrilization_plan()
    {
    	return $this->belongsTo('App\Models\FertilizationPlan','fertilization_plan_id');
    }
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }
    public function fertilization_type()
    {
    	return $this->belongsTo('App\Models\FertilizationType','fertilization_type_id');
    }
}
