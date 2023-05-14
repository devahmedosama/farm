@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{  trans('home.Add Plant Type')  }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/plant-types') }}">{{  trans('home.Plant Types')  }}</a>
                <span class="breadcrumb-item active">{{  trans('home.Add Plant Type')  }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/plant-types/add','files'=>true,'enctype'=>'multipart']) }}
			    
			    <div class="form-row">
			    	
			        <div class="form-group col-md-12">
			            <label for="inputEmail4"> {{trans('home.Name') }} </label>
			            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>trans('home.Name'),'required']) }}
			        </div>
			       
			    </div>
			    
			    <button type="submit" class="btn btn-primary">{{trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop