@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{  $title  }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/products') }}">{{  trans('home.Products')  }}</a>
                <span class="breadcrumb-item active">{{  $title  }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/products/add','files'=>true,'enctype'=>'multipart']) }}
			    
			    <div class="form-row">
			    	
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Name') }} </label>
			            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>trans('home.Name'),'required']) }}
			        </div>
			       <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Support Amount  Per KG') }} </label>
			             {{ Form::number('support_amount',null,['class'=>'form-control','step'=>'any','required']) }}
			        </div>
			    </div>
			    
			    <button type="submit" class="btn btn-primary">{{trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop