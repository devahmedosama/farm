@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{  $title  }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/employees') }}">{{  trans('home.Employees')  }}</a>
                <span class="breadcrumb-item active">{{  $title  }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/employees/add','files'=>true,'enctype'=>'multipart']) }}
			    
			    <div class="form-row">
			    	<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Name') }}</label>
			            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>trans('home.Name'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Job') }}</label>
			            {{ Form::text('job',null,['class'=>'form-control','placeholder'=>trans('home.Job'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Salary') }} </label>
			            {{ Form::text('salary',null,['class'=>'form-control','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Nationality') }} </label>
			            {{ Form::text('nationality',null,['class'=>'form-control','placeholder'=>trans('home.Nationality'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Id No') }} </label>
			            {{ Form::text('id_no',null,['class'=>'form-control','placeholder'=>trans('home.Id No'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Passport No') }} </label>
			            {{ Form::text('passport_no',null,['class'=>'form-control','placeholder'=>trans('home.Passport No'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Phone') }} </label>
			            {{ Form::text('phone',null,['class'=>'form-control','placeholder'=>trans('home.Phone'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Date Of Birth') }} </label>
			            {{ Form::date('birth_date',null,['class'=>'form-control','required']) }}
			        </div>

			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Joining Date') }} </label>
			            {{ Form::date('join_date',null,['class'=>'form-control','placeholder'=>trans('home.Joining Date'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Visa Expire Date') }} </label>
			            {{ Form::date('visa_expire_date',null,['class'=>'form-control','placeholder'=>trans('home.Visa Expire Date'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Passport Expire Date') }} </label>
			            {{ Form::date('passport_expire',null,['class'=>'form-control','placeholder'=>trans('home.Visa Expire Date'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Image') }} </label>
			            {{ Form::file('image',['class'=>'form-control','accept'=>'image/*']) }}
			        </div>
			        <div class="form-group col-md-12">
			            <label for="inputEmail4"> {{trans('home.Text') }} </label>
			            {{ Form::textarea('text',null,['class'=>'form-control','placeholder'=>trans('home.Your Note'),'required']) }}
			        </div>
			    </div>
			    
			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop