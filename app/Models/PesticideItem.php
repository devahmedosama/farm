<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesticideItem extends Model
{
    use HasFactory;
    public function stock($value='')
    {
    	return $this->belongsTo('App\Models\Stock','stock_id');
    }
    public function company($value='')
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }
    public function stock_item($value='')
    {
    	return $this->belongsTo('App\Models\StockItem','stock_item_id');
    }
    public function ferrilization_plan()
    {
    	return $this->belongsTo('App\Models\PesticidePlan','pesticide_plan_id');
    }

    public function fertilization_type()
    {
    	return $this->belongsTo('App\Models\FertilizationType','fertilization_type_id');
    }
}
