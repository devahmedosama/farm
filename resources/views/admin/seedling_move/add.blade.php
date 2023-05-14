@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{  $title }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/seedling-moves') }}">{{  trans('home.Seedling Moves')  }}</a>
                <span class="breadcrumb-item active">{{  $title  }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/seedling-moves/add','files'=>true,'enctype'=>'multipart']) }}
			    
			    <div class="form-row">
			    	
					<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Nursery') }}</label>
			            {{ Form::select('nursery_id',$nurseries,null,['class'=>'form-control basic-select','required']) }}
			        </div>
					<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Farm') }}</label>
			            {{ Form::select('farm_id',$farms,null,['class'=>'form-control basic-select','required']) }}
			        </div>
			    	<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Seedling No') }}</label>
			            {{ Form::number('seedling_no',1,['class'=>'form-control ','min'=>1,'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Date') }}</label>
			            {{ Form::date('date',null,['class'=>'form-control','required']) }}
			        </div>
			      
			    </div>
			    
			    <button type="submit" class="btn btn-primary">Save</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop