@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{ $data->name }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/nurseries') }}">{{ trans('home.Nurseries') }}</a>
                <span class="breadcrumb-item active">{{ $data->name }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/nurseries/edit/'.$data->id,'files'=>true,'enctype'=>'multipart']) }}
			   
			    <div class="form-row">
					
					@foreach($langs as $lang)
					<div class="form-group col-md-6">
						<label for="inputEmail4"> {{trans('home.Name In') }} {{ $lang->name }}  </label>
						{{ Form::text('name_'.$lang->locale,$lang->locale_name,['class'=>'form-control','placeholder'=>trans('home.Name'),'required']) }}
					</div>
					@endforeach
					<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Farming Area') }}</label>
			            {{ Form::select('area_id',$areas,$data->area_id,['class'=>'form-control basic-select','placeholder'=>trans('home.Choose Farming Area'),'required']) }}
			        </div>
					<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.State') }}</label>
			            {{ Form::select('state',$states,$data->state,['class'=>'form-control basic-select','required']) }}
			        </div>
					<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Product') }}</label>
			            {{ Form::select('product_type_id',$product_types,$data->product_type_id,['class'=>'form-control basic-select','placeholder'=>trans('home.Choose Product'),'required']) }}
			        </div>
			    	<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.No Seeds') }}</label>
			            {{ Form::number('no_seeds',$data->no_seeds,['class'=>'form-control','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Seeding Date') }}</label>
			            {{ Form::date('seeding_date',$data->seeding_date,['class'=>'form-control','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Transfering Seeds To Plant Date') }}</label>
			            {{ Form::date('transfering_seeds_to_plant_date',$data->transfering_seeds_to_plant_date,['class'=>'form-control','required']) }}
			        </div>
			    </div>
			   
			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop