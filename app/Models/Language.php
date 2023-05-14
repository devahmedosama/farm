<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public function getNameAttribute()
    {
    	$lang =  \App::getLocale();
    	$locale =  LanguageLocale::where('language_id',$this->attributes['id'])
    					->where('locale',$lang)->first();
    	if ($locale) {
    		return $locale->name;
    	}
    }
    public static function items()
    {
        $arr = [];
        foreach (Language::get() as $item) {
            $arr[$item->locale] =  $item->name;
        }
        return $arr;
    }
}
