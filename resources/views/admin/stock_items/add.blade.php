@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{  $title }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a href="{{ URL::to('admin/fertilization-types?type='.$type) }}" class="breadcrumb-item">{{ $parent_title }}</a>
                <span class="breadcrumb-item active">{{  $title  }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/stock-items/add','files'=>true,'enctype'=>'multipart']) }}
			    
			    <div class="form-row">
			    	
			        <input type="hidden" name="fertilization_type_id" value="{{app('request')->input('id')}}">
			        <div class="form-group col-md-12">
			            <label for="inputEmail4"> {{trans('home.Name') }} </label>
			            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>trans('home.Name'),'required']) }}
			        </div>
			       
			    </div>
			    
			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop