@extends('admin.content.layout')

@section('content')

	<div class="page-header">

        <h2 class="header-title">{{  $title  }}</h2>

        <div class="header-sub-title">

            <nav class="breadcrumb breadcrumb-dash">

                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>

                <a class="breadcrumb-item" href="{{ URL::to('admin/pesticide-plans') }}">{{  trans('home.Pesticide Plans')  }}</a>

                <span class="breadcrumb-item active">{{  $title  }}</span>

            </nav>

        </div>

    </div>

	<div class="card">

		<div class="card-body">

			{{ Form::open(['url'=>'admin/pesticide-plans/edit/'.$data->id,'files'=>true,'enctype'=>'multipart']) }}

			    

			    <div class="form-row  row grv_item">

			        

			   <div class="col-md-3">
			      <label class="control-lablel">{{ trans('home.Company') }}</label>
			      {{ Form::select('stock_item_id',$stocks,$data->company_id,['class'=>'form-control basic-select','required']) }}	          
			    </div>
				<div class="col-md-3">
			      <label class="control-lablel">{{ trans("home.Pesticide Type") }}</label>
			      {{ Form::select('fertilization_type_id',$types,$data->fertilization_type_id,['class'=>'form-control basic-select','required']) }}	          
			    </div>
			   <div class="col-md-3">			
			   	<label class="control-lablel">{{ trans('home.Quantity In Gram') }}</label>	          
			   	<input type="number" value="{{ $data->amount }}" class="form-control" step="any" value="1" min="1" name="quantity">			
			   </div>
			   <div class="col-md-3">			
			   	<label class="control-lablel">{{ trans('home.Date') }}</label>             
			   	<input name="date" value="{{ $data->date }}" class="form-control" type="date">	
			   	</div>
						
			    </div>

			    </br>
			    </br>

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

	    var  fertilization_name =  '{{ trans("home.Fertilization") }}';

	    var  quantity_name = "{{ trans('home.Quantity') }}";

	    var  date_name  =  "{{ trans('home.Date') }}";

     

	</script>

@stop