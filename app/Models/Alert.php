<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;
    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =   AlertLocale::where('alert_id',$this->attributes['id'])->where('locale',$lang)->first();
        if($locale){
            return $locale->name;
        }
    }
}
