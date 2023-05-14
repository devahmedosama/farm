@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{ $data->name }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/areas') }}">{{ trans('home.Farm Areas') }}</a>
                <span class="breadcrumb-item active">{{ $data->name }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/areas/edit/'.$data->id,'files'=>true,'enctype'=>'multipart']) }}
			   
			    <div class="form-row">
					
					@foreach($langs as $lang)
					<div class="form-group col-md-6">
						<label for="inputEmail4"> {{trans('home.Name In') }} {{ $lang->name }}  </label>
						{{ Form::text('name_'.$lang->locale,$lang->locale_name,['class'=>'form-control','placeholder'=>trans('home.Name'),'required']) }}
					</div>
					@endforeach
					<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Type') }}</label>
			            {{ Form::select('type',$types,$data->type,['class'=>'form-control basic-select','required']) }}
			        </div>
					
			    	<div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.number of valves') }} 
			            </label>
			            {{ Form::number('no_valves',$data->no_valves,['class'=>'form-control','required']) }}
			        </div>
					<div class="form-group col-md-12">
			            <label for="inputEmail4">{{ trans('home.No drops') }}</label>
			            {{ Form::number('no_drops',$data->no_drops,['class'=>'form-control','required']) }}
			        </div>
			    </div>
			   
			    <button type="submit" class="btn btn-primary">Save</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop