@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{ $data->name }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/farms') }}">{{ trans('home.Farm Areas') }}</a>
                <span class="breadcrumb-item active">{{ $data->name }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/farms/edit/'.$data->id,'files'=>true,'enctype'=>'multipart']) }}
			   
			    <div class="form-row">
					
					
					<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Farming Area') }}</label>
			            {{ Form::select('area_id',$areas,$data->area_id,['class'=>'form-control basic-select','required','placeholder'=>trans('home.Farming Area')]) }}
			        </div>
					<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Product Type') }}</label>
			            {{ Form::select('product_type_id',$product_types,$data->product_type_id,['class'=>'form-control basic-select','required']) }}
			        </div>
			    	<!-- <div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Plant Type') }}</label>
			            {{ Form::select('plant_type_id',$plant_types,$data->plant_type_id,['class'=>'form-control basic-select','placeholder'=>trans('home.Choose Plant Type'),'required']) }}
			        </div> -->
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.State') }}</label>
			            {{ Form::select('state',$states,$data->state,['class'=>'form-control basic-select','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Seeding Date') }}</label>
			            {{ Form::date('seeding_date',$data->seeding_date,['class'=>'form-control','required']) }}
			        </div>
			       
			    </div>
			   
			    <button type="submit" class="btn btn-primary">Save</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop