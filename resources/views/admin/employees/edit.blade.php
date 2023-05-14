@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{ $data->name }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/employees') }}">{{ trans('home.Employees') }}</a>
                <span class="breadcrumb-item active">{{ $data->name }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/employees/edit/'.$data->id,'files'=>true,'enctype'=>'multipart']) }}
			   
			    <div class="form-row">
			    	@foreach($langs as $lang)
					<div class="form-group col-md-6">
						<label for="inputEmail4"> {{trans('home.Name In') }} {{ $lang->name }}  </label>
						{{ Form::text('name_'.$lang->locale,$lang->locale_name,['class'=>'form-control','placeholder'=>trans('home.Name'),'required']) }}
					</div>
					@endforeach
					<div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Id No') }} </label>
			            {{ Form::text('id_no',$data->id_no,['class'=>'form-control','placeholder'=>trans('home.Id No'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Salary') }} </label>
			            {{ Form::text('salary',$data->salary,['class'=>'form-control','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Passport No') }} </label>
			            {{ Form::text('passport_no',$data->passport_no,['class'=>'form-control','placeholder'=>trans('home.Passport No'),'required']) }}
			        </div> 
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Phone') }} </label>
			            {{ Form::text('phone',$data->phone,['class'=>'form-control','placeholder'=>trans('home.Phone'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Date Of Birth') }} </label>
			            {{ Form::date('birth_date',$data->birth_date,['class'=>'form-control','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Joining Date') }} </label>
			            {{ Form::date('join_date',$data->join_date,['class'=>'form-control','placeholder'=>trans('home.Joining Date'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Visa Expire Date') }} </label>
			            {{ Form::date('visa_expire_date',$data->visa_expire_date,['class'=>'form-control','placeholder'=>trans('home.Visa Expire Date'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Passport Expire Date') }} </label>
			            {{ Form::date('passport_expire',$data->passport_expire,['class'=>'form-control','placeholder'=>trans('home.Visa Expire Date'),'required']) }}
			        </div>
			        
			        <div class="form-group col-md-8">
			            <label for="inputEmail4"> {{trans('home.Image') }} </label>
			            {{ Form::file('image',['class'=>'form-control','accept'=>'image/*']) }}
			        </div>
			        <div class="form-group col-md-4">
			            <img src="{{ URL::to($data->image) }}" class="img-thumbnail">
			        </div>
					@foreach($langs as $lang)
					<div class="form-group col-md-6">
						<label for="inputEmail4"> {{trans('home.Nationality In') }} {{ $lang->name }}  </label>
						{{ Form::text('nationality_'.$lang->locale,$lang->locale_nationality,['class'=>'form-control','placeholder'=>trans('home.Nationality'),'required']) }}
					</div>
					@endforeach
					@foreach($langs as $lang)
					<div class="form-group col-md-6">
						<label for="inputEmail4"> {{trans('home.Job In') }} {{ $lang->name }}  </label>
						{{ Form::text('job_'.$lang->locale,$lang->locale_job,['class'=>'form-control','required']) }}
					</div>
					@endforeach


					@foreach($langs as $lang)
					<div class="form-group col-md-6">
						<label for="inputEmail4"> {{trans('home.Text In') }} {{ $lang->name }} </label>
						{{ Form::textarea('text_'.$lang->locale,$lang->locale_text,['class'=>'form-control','placeholder'=>trans('home.Text'),'required']) }}
					</div>
					@endforeach
			    </div>
			   
			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop