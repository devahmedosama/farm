@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{  $title  }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/equipmentuses') }}">{{  trans('home.Equipment Uses')  }}</a>
                <span class="breadcrumb-item active">{{  $title  }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/equipmentuses/add','files'=>true,'enctype'=>'multipart']) }}
			    <div class="form-row">
			    	<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Employee') }}</label>
			            {{ Form::select('employee_id',$employees,null,['class'=>'form-control basic-select','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Equipment') }} </label>
			            {{ Form::select('equipment_id',$equipments,null,['class'=>'form-control basic-select','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Date') }} </label>
			            {{ Form::date('date',null,['class'=>'form-control','required']) }}
			        </div>

			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Return Date') }} </label>
			            {{ Form::date('return_date',null,['class'=>'form-control','required']) }}
			        </div>
			    </div>
			    
			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop