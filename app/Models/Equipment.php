<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Equipment extends Model
{
    use HasFactory;
    protected $table = 'equipments';

    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =   EquipmentLocale::where('equipment_id',$this->attributes['id'])->where('locale',$lang)->first();
        if($locale){
            return $locale->name;
        }
    }
    public function getTextAttribute()
    {
        $lang   =  \App::getLocale();
        $locale =   EquipmentLocale::where('equipment_id',$this->attributes['id'])->where('locale',$lang)->first();
        if($locale){
            return $locale->text;
        }
    }
    public static function items()
    {
        $arr = [];
        foreach (Equipment::get() as $data) {
            $arr[$data->id]  =  $data->name;
        }
        return $arr;
    }
}
