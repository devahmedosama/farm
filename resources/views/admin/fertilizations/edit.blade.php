@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{ $data->name }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/fertilization') }}">{{ trans('home.Fertilization') }}</a>
                <span class="breadcrumb-item active">{{ $data->name }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/fertilization/edit/'.$data->id,'files'=>true,'enctype'=>'multipart']) }}
			    <div class="row">
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Fertilization Type') }} </label>
			            {{ Form::select('fertilization_type_id',$types,$data->fertilization_type_id,['class'=>'form-control','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Fertilization') }} </label>
			            {{ Form::select('stock_id',$stocks,$data->stock_id,['class'=>'form-control','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Quantity Per 100 Letter') }} </label>
			            {{ Form::number('quantity_per_100_letter',$data->quantity_per_100_letter,['class'=>'form-control','required','step'=>'any','min'=>0]) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Date') }} </label>
			            {{ Form::date('date',$data->date,['class'=>'form-control','required','step'=>'any','min'=>0]) }}
			        </div>
			        <div class="form-group col-md-12">
			            <label for="inputEmail4"> {{trans('home.Amount') }} </label>
			            {{ Form::number('amount',$data->amount,['class'=>'form-control','required','step'=>'any','min'=>0]) }}
			        </div>
			      </div>
			   
			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop