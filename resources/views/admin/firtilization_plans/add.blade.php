@extends('admin.content.layout')

@section('content')

	<div class="page-header">

        <h2 class="header-title">{{  $title  }}</h2>

        <div class="header-sub-title">

            <nav class="breadcrumb breadcrumb-dash">

                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>

                <a class="breadcrumb-item" href="{{ URL::to('admin/data-entry') }}">{{  trans('home.Data Entry')  }}</a>

                <span class="breadcrumb-item active">{{  $title  }}</span>

            </nav>

        </div>

    </div>

	<div class="card">

		<div class="card-body">

			{{ Form::open(['url'=>'admin/fertilizations/plan/add','files'=>true,'enctype'=>'multipart']) }}

			    

			    <div class="form-row">

			        <!-- <div class="form-group col-md-12">

			            <label for="inputEmail4"> {{trans('home.Title') }} </label>

			            {{ Form::text('name',null,['class'=>'form-control','required']) }}

			        </div> -->

			        <div class="form-group col-md-6">

			            <label for="inputEmail4"> {{trans('home.Farming Area') }} </label>

			            {{ Form::select('farm_id[]',$farms,null,['class'=>'form-control basic-select','required','multiple']) }}

			        </div>
					<div class="form-group col-md-6">
						<label for="inputEmail4">{{ trans('home.Date') }}</label>
						{{ Form::date('main_date',null,['class'=>'form-control','required']) }}
					</div>

			    </div>

			    <div class="col-md-12">

			    	<a class="btn btn-primary btn-xs" id="add_item"> <i class="anticon anticon-plus"></i></a>

		        	<h3 class="text-center"> {{ trans('home.Fertilizations') }} </h3>

		            </br>
		        	<div  id='stocks_items' style="min-height: 30px">

			        	

			        </div>
		        </div>

			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>

			{{ Form::token() }}

			{{ Form::close() }}

		</div>

	</div>

	<script type="text/javascript">

	    var  stocks = {

					        @foreach($stocks as $key=>$item)

					           '{{ $key }}':{

					           'name':'{{ $item }}',

					           },

					        @endforeach

					    };
		var  fertilization_types = {

					        @foreach($types as $key=>$item)

					           '{{ $key }}':{
					           	'id':'{{ $item->id }}',
					           'name':'{{ $item->name }}',
					           'quantity_name':'{{ ($item->unit)?$item->unit->name:' ' }}',

					           },

					        @endforeach

					    };

	    var  fertilization_name =  '{{ trans("home.Company") }}';
	    var  type_name =  '{{ trans("home.Fertilization Type") }}';

	    var  quantity_name = "{{ trans('home.Quantity for 1000') }}";

	    var  date_name  =  "{{ trans('home.Date') }}";

     

	</script>

@stop