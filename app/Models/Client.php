<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public function getNameAttribute()
    {
    	$lang   =  \App::getLocale();
    	$locale =  ClientLocale::where('client_id',$this->attributes['id'])
    					->where('locale',$lang)->first();
    	if ($locale) {
    		return $locale->name;
    	}
    }
    public static function items()
    {
        $arr = [];
        foreach (Client::get() as $item) {
            $arr[$item->id] =  $item->name;
        }
        return $arr;
    }
}
