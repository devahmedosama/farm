@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title"> Settings</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active"> Settings</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/settings','files'=>true,'enctype'=>'multipart']) }}
			   
			    <div class="form-row">
			    	<div class="form-group col-md-6">
			            <label for="inputEmail4">Name</label>
			            {{ Form::text('name',$data->name,['class'=>'form-control','placeholder'=>'name','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">Phone1</label>
			            {{ Form::text('phone1',$data->phone1,['class'=>'form-control','placeholder'=>'phone1','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">Phone2</label>
			            {{ Form::text('phone2',$data->phone2,['class'=>'form-control','placeholder'=>'phone2','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">Location</label>
			            {{ Form::text('location',$data->location,['class'=>'form-control','placeholder'=>'Location','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">E-mail</label>
			            {{ Form::email('email',$data->email,['class'=>'form-control','placeholder'=>'E-mail','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4">Website</label>
			            {{ Form::url('website',$data->website,['class'=>'form-control','placeholder'=>'Website','required']) }}
			        </div>
			        <div class="form-group col-md-12">
			            <label for="inputEmail4">Vat Percentage</label>
			            {{ Form::number('vat',$data->vat,['class'=>'form-control','placeholder'=>'Vat Percentage','required']) }}
			        </div>
			        <div class="form-group col-md-12">
			            <label for="inputEmail4">LPO E-mail Text</label>
			            {{ Form::textarea('lpo_email_text',$data->lpo_email_text,['class'=>'form-control','placeholder'=>'LPO E-mail Text','required','row'=>4]) }}
			        </div>
			    </div>
			   
			    <button type="submit" class="btn btn-primary">Save</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop