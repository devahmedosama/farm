<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $appends =  ['name'];
    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =  SupplierLocale::where('supplier_id',$this->attributes['id'])
    					->where('locale',$lang)->first();
    	if ($locale) {
    		return $locale->name;
    	}
    }
    public static function items()
    {
        $arr = [];
        foreach (Supplier::get() as $item) {
            $arr[$item->id] =  $item->name;
        }
        return $arr;
    }
}
