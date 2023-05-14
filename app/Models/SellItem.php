<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellItem extends Model
{
    use HasFactory;
    public function farm($value='')
    {
    	return $this->belongsTo('\App\Models\Farm','farm_id');
    }
    public function stocks($value='')
    {
    	return $this->belongsTo('\App\Models\Stock','stock_id');
    }
    public function client()
    {
    	return $this->belongsTo('\App\Models\Client','client_id');
    }
}
