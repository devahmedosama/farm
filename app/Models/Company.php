<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $appends = ['name'];
    public static function types()
    {
        return [
            0=>trans('home.All'),
            1=>trans('home.Fertilizante'),
            2=>trans('home.Pesticide')
        ];
    }
    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =  CompanyLocale::where('company_id',$this->attributes['id'])
    					->where('locale',$lang)->first();
    	if ($locale) {
    		return $locale->name;
    	}
    }
    public static function items($type=0)
    {
        $arr = [];
        $allData =  Company::where(function($query) use($type){
            if ($type ==2) {
                $query->where('type',0);
                $query->orwhere('type',2);
            }else{
                $query->where('type',0);
                $query->orwhere('type',1);
            }
        })->get();
        foreach ($allData as $item) {
            $arr[$item->id] =  $item->name;
        }
        return $arr;
    }
    public static function all_items()
    {
        $arr = [];
        foreach (Company::get() as $item) {
            $arr[$item->id] =  $item->name;
        }
        return $arr;
    }
}
