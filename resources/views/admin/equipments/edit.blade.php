@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{ $data->name }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/equipments') }}">{{ trans('home.Equipments') }}</a>
                <span class="breadcrumb-item active">{{ $data->name }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/equipments/edit/'.$data->id,'files'=>true,'enctype'=>'multipart']) }}
			   
			    <div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputEmail4">{{ trans('home.Machine No') }}</label>
						{{ Form::text('machine_no',$data->machine_no,['class'=>'form-control','placeholder'=>trans('home.Machine No'),'required']) }}
					</div>
					@foreach($langs as $lang)
					<div class="form-group col-md-6">
						<label for="inputEmail4"> {{trans('home.Name In') }} {{ $lang->name }}  </label>
						{{ Form::text('name_'.$lang->locale,$lang->locale_name,['class'=>'form-control','placeholder'=>trans('home.Name'),'required']) }}
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