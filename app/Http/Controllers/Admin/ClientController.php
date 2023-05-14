<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Client; 
use  App\Models\ClientLocale; 
use App\Models\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;


class ClientController extends Controller
{
    protected $lang;
    public function __construct($value='')
    {
        $this->lang =   \App::getLocale();
    }
    public function index(Request $request)
    {
        $allData  =  Client::OrderBy('id','desc')->paginate(30);
        return view('admin.clients.index')
                ->with('allData',$allData)
                ->with('title',trans('home.Clients'));
    }
    public function add()
    {
        return view('admin.clients.add')
                ->with('title',trans('home.Add Client'));

    }
    public function post_add(Request $request)
    {
        $this->lang =  \App::getLocale();
        $request->validate([
            'name'=>'required'
            ]);
        $data =  new Client;
        $data->phone =  $request->phone;
        $data->email =  $request->email;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale               =  new ClientLocale;
            $locale->locale       = $lang->locale;
            $locale->client_id = $data->id;
            if ($request->name) {
                $locale->name         = GoogleTranslate::trans($request->name,$lang->locale, $this->lang);
            }
            if ($request->text) {
                $locale->text         = GoogleTranslate::trans($request->text,$lang->locale, $this->lang);
            }
            $locale->save();
        }
        return  redirect('admin/clients')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function edit($id)
    {
        $data =  Client::find($id);
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $locale            =  ClientLocale::where('client_id',$id)->where('locale',$lang->locale)->first();  
            $lang->locale_name =  ($locale)?$locale->name:' ';
            $lang->locale_text =  ($locale)?$locale->text:' ';
        }
        return view('admin.clients.edit')
                   ->with('data',$data)
                   ->with('langs',$langs)
                   ->with('title',$data->name)
                ;
    }
    public function post_edit($id,Request $request)
    {
        $data =  Client::find($id);
        $data->phone =  $request->phone;
        $data->email =  $request->email;
        $data->save();
        $langs =  Language::get();
        foreach ($langs as $lang) {
            $name =  'name_'.$lang->locale;
            $text =  'text_'.$lang->locale;
            $locale =  ClientLocale::where('client_id',$id)->where('locale',$lang->locale)->first();
            if (empty($locale)) {
               $locale         =  new ClientLocale;
            }
            $locale->locale    = $lang->locale;
            $locale->client_id = $data->id;
            $locale->name      = $request->$name;
            $locale->text      = $request->$text;
            $locale->save();
        }
        return  redirect('admin/clients')
                    ->with('yes',trans('home.Done Successfully'));
    }
    public function delete($id)
    {
        $data =  Client::find($id);
        if ($data) {
            $data->delete();
        }
        return  back()
                  ->with('yes',trans('home.Done Successfully'));
    }
}
