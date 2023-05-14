@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{  $title  }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/nurseries') }}">{{  trans('home.Nurseries')  }}</a>
                <span class="breadcrumb-item active">{{  $title  }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/nurseries/add','files'=>true,'enctype'=>'multipart']) }}
			    
			    <div class="form-row">
			    	<div class="form-group col-md-12">
			            <label for="inputEmail4"> {{trans('home.Product Name') }} </label>
			            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>trans('home.Product Name'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Farming Area') }}</label>
			            {{ Form::select('area_id',$areas,null,['class'=>'form-control basic-select','placeholder'=>trans('home.Choose Plant Type'),'required']) }}
			        </div>
			    	<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Product') }}</label>
			            {{ Form::select('product_type_id',$product_types,null,['class'=>'form-control basic-select','placeholder'=>trans('home.Choose Product'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.State') }}</label>
			            {{ Form::select('state',$states,null,['class'=>'form-control basic-select','required']) }}
			        </div>
			    	<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.No Seeds') }}</label>
			            {{ Form::number('no_seeds',1,['class'=>'form-control','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Seeding Date') }}</label>
			            {{ Form::date('seeding_date',null,['class'=>'form-control','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Transfering Seeds To Plant Date') }}</label>
			            {{ Form::date('transfering_seeds_to_plant_date',null,['class'=>'form-control','placeholder'=>trans('home.Machine No'),'required']) }}
			        </div>
			        
			       
			    </div>
			    
			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop