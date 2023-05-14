<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeedlingMove extends Model
{
    use HasFactory;
    public function nursery()
    {
    	return $this->belongsTo('App\Models\Nursery','nursery_id');
    }
    public function farm()
    {
    	return $this->belongsTo('App\Models\Farm','farm_id');
    }
}
