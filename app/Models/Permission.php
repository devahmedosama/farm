<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Permission extends Model
{
    use HasFactory;

    public static function check($url)
    {
    	if (Auth::User()->type == 0) {
    		return 1;
    	}else{
    		$per =  UserPermission::where('user_id',\Auth::id())
                            ->whereHas('permission',function($query) use($url){
                                    $query->where('url',$url);
                                })->first();
            if ($per) {
            	return 1;
            }
    	}
    }
}
