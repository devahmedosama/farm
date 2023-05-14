<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;
    protected $table = 'vactions';
    public static function types()
    {
    	return [
    			0=>trans('home.normal'),
                1=>trans('home.sick leave'),
    			2=>trans('home.annual')
    			];
    }
    public function getTypeNameAttribute()
    {
    	if (array_key_exists($this->attributes['type'], $this->types() )) {
    		return $this->types()[$this->attributes['type']];
    	}else{
    		return trans('home.annual');
    	}
    }
}
