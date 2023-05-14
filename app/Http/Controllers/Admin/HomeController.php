<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FertilizationItem;
use App\Models\PesticideItem;
use App\Models\Alert;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $date =  Carbon::now()->addDay();
        $fer_count =  FertilizationItem::where('date','<=',$date)->where('state',0)
                             ->count('id');
        $pest_count =  PesticideItem::where('date','<=',$date)->where('state',0)
                            ->count('id');
        $alert_count =  Alert::where('date','<=',$date)->where('state',0)
                            ->count('id');
        return view('admin.index')
                ->with('fer_count',$fer_count)
                ->with('pest_count',$pest_count)
                ->with('alert_count',$alert_count)
                ;
    }
    public function general()
    {
    	 return view('admin.general');
    }
    public function data_entry()
    {
    	return view('admin.general.data_entry')
    			->with('title',trans('home.Data Entry'));
    }
    public function edit_entry()
    {
        return view('admin.general.edit_entry')
                ->with('title',trans('home.Data Entry'));
        

    }
}
 