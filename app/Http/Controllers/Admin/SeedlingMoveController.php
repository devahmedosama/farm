<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeedlingMove;
use App\Models\Farm;
use App\Models\Nursery;


class SeedlingMoveController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function add()
    {
    	$nurseries  =  Nursery::active_items();
    	$farms      =  Farm::active_items();
    	return view('admin.seedling_move.add')
    			->with('nurseries',$nurseries)
    			->with('farms',$farms)
    			->with('title',trans('home.Seedling Move'));
    }
    public function edit($id)
    {
        $nurseries  =  Nursery::active_items();
        $farms      =  Farm::active_items();
        $data     = SeedlingMove::find($id);
        return view('admin.seedling_move.edit')
                ->with('nurseries',$nurseries)
                ->with('farms',$farms)
                ->with('data',$data)
                ->with('title',trans('home.Seedling Move'));
    }
    public function post_add(Request $request)
    {
    	$data                          =  new SeedlingMove;
        $data->nursery_id              =  $request->nursery_id;
    	$data->seedling_no              =  $request->seedling_no;
    	$data->farm_id                 =  $request->farm_id;
        $data->date                    =  $request->date;
    	$data->save();
    	return  redirect('admin/seedling-moves')
    				->with('yes',trans('home.Done Successfully'));
    }
    public function post_edit(Request $request,$id)
    {
        $data              =  SeedlingMove::find($id);
        $data->nursery_id  =  $request->nursery_id;
        $data->seedling_no =  $request->seedling_no;
        $data->farm_id     =  $request->farm_id;
        $data->date        =  $request->date;
        $data->save();
        return  redirect('admin/seedling-moves')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function index(Request $request)
    {
    	$allData  =  SeedlingMove::OrderBy('id','desc')->paginate(30);
    	return view('admin.seedling_move.index')
    				->with('allData',$allData)
    				->with('title',trans('home.Seedling Moves'));
    }
    public function delete($id)
    {
        $data = SeedlingMove::find($id);
        if ($data) {
            $data->delete();
        }
        return back()
                ->with('yes',trans('home.Done Successfully'));
    }
}
