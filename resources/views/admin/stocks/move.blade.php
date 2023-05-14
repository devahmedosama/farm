@extends('admin.content.layout')

@section('content')

	<div class="page-header">

        <h2 class="header-title">{{  $title  }}</h2>

        <div class="header-sub-title">

            <nav class="breadcrumb breadcrumb-dash">

                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>

                <a class="breadcrumb-item" href="{{ URL::to('admin/stocks') }}">{{  trans('home.Stocks')  }}</a>

                <span class="breadcrumb-item active">{{  $title  }}</span>

            </nav>

        </div>

    </div>

	<div class="card">

		<div class="card-body">

			{{ Form::open(['url'=>'admin/stocks/move','files'=>true,'enctype'=>'multipart']) }}

			    <div class="form-row">

			       

			        <div class="form-group col-md-6">

			            <label for="inputEmail4"> {{trans('home.Stock Item') }} </label>

			            <select id="stock_id" name="stock_id" class="form-control basic-select" required>

			            	@foreach($stocks as $stock)

			            	 <option value="{{ $stock->id }}" data-max="{{ $stock->available_amount }}">

			            	 	{{ $stock->name.' ( '.$stock->unit->name.' )' }}

			            	 </option>

			            	@endforeach

			            </select>

			        </div>

			        <div class="form-group col-md-6">

			            <label for="inputEmail4"> {{trans('home.Quantity') }} </label>
			            <?php $max =  (count($stocks)> 0)?$stocks[0]->available_amount:0 ?>
			            {{ Form::number('amount',1,['id'=>'quantity','class'=>'form-control','step'=>'any','min'=>0,'max'=>$max,'required']) }}

			        </div>

			       

			        <div class="form-group col-md-6">

			            <label for="inputEmail4"> {{trans('home.Farm') }} </label>

			            {{ Form::select('farm_id',$farms,null,['class'=>'form-control basic-select','placeholder'=>trans('home.Choose Farm')]) }}

			        </div>

			        <div class="form-group col-md-6">

			            <label for="inputEmail4"> {{trans('home.Equipment') }} </label>

			            {{ Form::select('equipment_id',$equipments,null,['class'=>'form-control basic-select','placeholder'=>trans('home.Choose Equipment')]) }}

			        </div>

			    </div>

			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>

			{{ Form::token() }}

			{{ Form::close() }}

		</div>

	</div>

@stop