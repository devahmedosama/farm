@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{  $title  }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/nurseries') }}">{{  trans('home.Stocks')  }}</a>
                <span class="breadcrumb-item active">{{  $title  }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/fertilization/add','files'=>true,'enctype'=>'multipart']) }}
			    
			    <div class="form-row">
				<input type="hidden" value="{{ app('request')->input('nursery_id') }}" name="nursery_id">
			    	<input type="hidden" value="{{ app('request')->input('farm_id') }}" name="farm_id">
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Fertilization Type') }} </label>
			            {{ Form::select('fertilization_type_id',$types,null,['class'=>'form-control','required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Fertilization Item') }} </label>
			            {{ Form::select('stock_id',$stocks,null,['class'=>'form-control','required']) }}
			        </div>
			        <div class="form-group col-md-12">
			            <label for="inputEmail4"> {{trans('home.Quantity Per 100 Letter') }} </label>
			            {{ Form::number('quantity_per_100_letter',0,['class'=>'form-control','required','step'=>'any','min'=>0]) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Amount') }} </label>
			            {{ Form::number('amount',0,['class'=>'form-control','required','step'=>'any','min'=>0]) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Date') }} </label>
			            {{ Form::date('date',null,['class'=>'form-control','required','step'=>'any','min'=>0]) }}
			        </div>
			       
			    </div>
			    
			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop