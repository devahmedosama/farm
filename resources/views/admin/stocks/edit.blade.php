@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{ $data->name }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/stocks') }}">{{ trans('home.Stocks') }}</a>
                <span class="breadcrumb-item active">{{ $data->name }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/stocks/edit/'.$data->id,'files'=>true,'enctype'=>'multipart']) }}
			    <div class="form-row">
					@foreach($langs as $lang)
					<div class="form-group col-md-6">
						<label for="inputEmail4"> {{trans('home.Name In') }} {{ $lang->name }}  </label>
						{{ Form::text('name_'.$lang->locale,$lang->locale_name,['class'=>'form-control','placeholder'=>trans('home.Name'),'required']) }}
					</div>
					@endforeach
					<div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Company') }} * </label>
			            {{ Form::select('company_id',$stock_items,$data->company_id,['class'=>'form-control basic-select','placeholder'=>trans('home.choose company')]) }}
			        </div>
					<div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.pesticide or fertilizante') }} * </label>
			            {{ Form::select('fertilization_type_id',$types,$data->fertilization_type_id,['class'=>'form-control basic-select','placeholder'=>trans('home.choose pesticide or fertilizante')]) }}
			        </div>
					 <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Stock Type') }} </label>
			            {{ Form::select('stock_type_id',$items,$data->stock_type_id,['class'=>'form-control basic-select','placeholder'=>trans('home.Stock Types'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Supplier') }} </label>
			            {{ Form::select('supplier_id',$suppliers,$data->supplier_id,['class'=>'form-control basic-select','placeholder'=>trans('home.Choose Supplier')]) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Unit') }} </label>
			            {{ Form::select('unit_id',$units,$data->unit_id,['class'=>'form-control basic-select','placeholder'=>trans('home.Choose Unit'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Quantity') }} </label>
			            {{ Form::number('quantity',$data->quantity,['class'=>'form-control','step'=>'any','min'=>0,'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Single Item Weight') }} </label>
			            {{ Form::number('unit_weight',$data->unit_weight,['class'=>'form-control','step'=>'any','min'=>0]) }}
			        </div>
			        <!--  <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Unit Price') }} </label>
			            {{ Form::number('unit_price',$data->unit_price,['class'=>'form-control','step'=>'any','min'=>0,'required']) }}
			        </div>
			        <div class="form-group col-md-12">
			            <label for="inputEmail4"> {{trans('home.Total Price') }} </label>
			            {{ Form::number('total_price',$data->total_price,['class'=>'form-control','step'=>'any','min'=>0,'required']) }}
			        </div> -->
			        @foreach($langs as $lang)
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Text') }} </label>
			            {{ Form::textarea('text',$lang->locale_text,['class'=>'form-control']) }}
			        </div>
			        @endforeach
			    </div>
			   
			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@stop