@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{  trans('home.Add Product Type')  }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/product-types') }}">{{  trans('home.Plant Types')  }}</a>
                <span class="breadcrumb-item active">{{  trans('home.Add Product Type')  }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/product-types/add','files'=>true,'enctype'=>'multipart']) }}
			    
			    <div class="form-row">
			    	<div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Product') }} </label>
			            {{ Form::select('product_id',$items,app('request')->input('product_id'),['class'=>'form-control basic-select','placeholder'=>trans('home.Choose Product'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Name') }} </label>
			            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>trans('home.Name'),'required']) }}
			        </div>
			        <div class="form-group col-md-12">
			            <label for="inputEmail4" style="width:100%"> {{trans('home.Image') }} </label>
			            {{ Form::file('image',null,['class'=>'form-control']) }}
			        </div>
			    </div>
			    
			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop