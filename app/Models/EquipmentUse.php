<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentUse extends Model
{
    use HasFactory;

    public function equipment()
    {
    	return $this->belongsTo('App\Models\Equipment','equipment_id');
    }
    public function employee()
    {
    	return $this->belongsTo('App\Models\Employee','employee_id');
    }
}
