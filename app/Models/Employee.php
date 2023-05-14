<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =   EmployeeLocale::where('employee_id',$this->attributes['id'])->where('locale',$lang)->first();
        if($locale){
            return $locale->name;
        }
    }
    public function getTextAttribute()
    {
        $lang   =  \App::getLocale();
        $locale =   EmployeeLocale::where('employee_id',$this->attributes['id'])->where('locale',$lang)->first();
        if($locale){
            return $locale->text;
        }
    }
    public function getNationalityAttribute()
    {
        $lang   =  \App::getLocale();
        $locale =   EmployeeLocale::where('employee_id',$this->attributes['id'])->where('locale',$lang)->first();
        if($locale){
            return $locale->nationality;
        }
    }
    public function getJobAttribute()
    {
        $lang   =  \App::getLocale();
        $locale =   EmployeeLocale::where('employee_id',$this->attributes['id'])->where('locale',$lang)->first();
        if($locale){
            return $locale->job;
        }
    }
    public static function items()
    {
    	$arr = [];
    	foreach (Employee::get() as $data) {
    		$arr[$data->id]  =  $data->name;
    	}
    	return $arr;
    }
}
