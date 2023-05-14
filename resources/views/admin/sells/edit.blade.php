@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{  $title }}</h2>
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
			{{ Form::open(['url'=>'admin/sells/edit/'.$data->id,'files'=>true,'enctype'=>'multipart']) }}
			    
			    <div class="form-row">
			    	
					<!-- <div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Client') }}</label>
			            {{ Form::select('client_id',$clients,$data->client_id,['class'=>'form-control basic-select','required']) }}
			        </div> -->
					
			        <div class="form-group col-md-12">
			            <label for="inputEmail4">{{ trans('home.Date') }}</label>
			            {{ Form::date('date',$data->date,['class'=>'form-control','required']) }}
			        </div>
			        <div class="col-md-12">

				    	<a class="btn btn-primary btn-xs" id="add_sell"> <i class="anticon anticon-plus"></i></a>
			            </br>
			        	<div  id='sell_items' style="min-height: 30px">
			        		 @foreach($data->items as $item)
			        		 	<div class="row grv_item"> 
			        		 		<a class="close_item">X </a>
			        		 		<input type="hidden" name="item_id[]" value="{{ $item->id }}">
									<div class="col-md-6">
									  <label class="control-lablel" >{{ trans('home.Client') }}</label>
			                          <select name="old_client_id[]" class=" form-control basic-select" required>
			                          	@foreach($clients as $farm)
			                          	<option value="{{ $farm->id }}"
			                          		{{ ($item->client_id == $farm->id)?'selected':'' }}
			                          		>
			                          		{{ $farm->name }}
			                          	</option>
			                          	@endforeach
			                          </select>
									</div>
									<div class="col-md-6">
									  <label class="control-lablel" >{{ trans('home.Farming Area') }}</label>
			                          <select name="old_farm_id[]" class="area_select form-control basic-select" required>
			                          	@foreach($farms as $farm)
			                          	<option data-product="{{ $farm->area->name }}" data-support="{{ $farm->product_type->product->support_amount }}" value="{{ $farm->id }}"
			                          		{{ ($item->farm_id == $farm->id)?'selected':'' }}
			                          		>
			                          		{{ $farm->name }}
			                          	</option>
			                          	@endforeach
			                          </select>
									</div>
									<div class="col-md-4">
									  <label class="control-lablel" >
									  	{{ trans('home.Quantity') }}
									  </label>
			                          {{ Form::number('old_quantity[]',$item->quantity,['class'=>'form-control sell_quantity',
			                          		'step'=>'any','required']) }}
									</div>
									<div class="col-md-4">
									  <label class="control-lablel" >
									  	{{ trans('home.Unit Weight') }}
									  </label>
			                          {{ Form::number('old_unit_weight[]',$item->unit_weight,['class'=>'form-control sell_weight','step'=>'any'
			                          	,'required']) }}
									</div>
									<div class="col-md-4">
									  <label class="control-lablel" >
									  	{{ trans('home.Packaging') }}
									  </label>
			                          {{ Form::select('old_stock_id[]',$packages,$item->stock_id,['class'=>'form-control basic-select','step'=>'any'
			                          	,'required']) }}
									</div>
									<!-- <div class="col-md-2">
									  <label class="control-lablel" >
									  	{{ trans('home.Unit Price') }}
									  </label>
			                          {{ Form::number('old_unit_price[]',$item->unit_price,['class'=>'form-control unit_price'
			                          	,'step'=>'any','required']) }}
									</div> -->
									<!-- <div class="col-md-2">
									  <label class="control-lablel" >
									  	{{ trans('home.Discount Percentage') }}
									  </label>
			                          {{ Form::number('old_discount[]',$item->discount,['class'=>'form-control discount'
			                          	,'step'=>'any','required','min'=>0]) }}
									</div>
									<div class="col-md-2">
									  <label class="control-lablel" >
									  	{{ trans('home.Total Price') }}
									  </label>
			                          {{ Form::number('old_total_price[]',$item->total_price,['class'=>'form-control sell_total'
			                          	,'step'=>'any','required']) }}
									</div> -->
								</div>
			        		 @endforeach
				        </div> 
			        </div>
			        <div class="form-group col-md-12 ">
			        	</hr>
			        </div>
			        <div class="form-group col-md-12 " id="products_div" style="color:#000">

			        </div>
			        <div class="form-group col-md-4 ">
			        	<label class="control-label">{{ trans('home.Total Weight') }} 
			        		<span id="total_weight">{{ $data->total_weight }}</span>
			        	</label>
			        	
			        </div>
			        <div class="form-group col-md-4 ">
			        	<label class="control-label">{{ trans('home.Total Quantity') }}
			        	 <span id="total_quantity">{{ $data->total_quantity }}</span>
			        	</label>
			        	
			        </div>
			        <div class="form-group col-md-4 ">
			        	<label class="control-label">{{ trans('home.Total Support Amount') }} 
			        		<span id="total_support">{{ $data->total_support }}</span> {{ trans('home.Dinar') }}
			        	</label>
			        	
			        </div>
			       <!--  <div class="form-group col-md-3 ">
			        	<label class="control-label">{{ trans('home.Total Price') }}
			        	 <span id="total_price">{{ $data->total_price }}</span>
			        	</label>
			        	
			        </div> -->
			    </div>
			    
			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
	<script type="text/javascript">


	    var  farms = {
			        @foreach($farms as $key=>$item)
			           '{{ $key }}':{
			           'id':'{{ $item->id }}',
			           'name':'{{ $item->name }}',
			           'product':'{{ $item->area->name }}',
			           'support':'{{ $item->product_type->product->support_amount }}'
			           },
			        @endforeach
			    }; 
		
	    var  packages = {
			        @foreach($packages as $key=>$item)
			           '{{ $key }}':{
			           'id':'{{ $key }}',
			           'name':'{{ $item }}',
			           },
			        @endforeach
			    }; 
		var  clients = {
			        @foreach($client_ite as $key=>$item)
			           '{{ $key }}':{
			           'id':'{{ $key }}',
			           'name':'{{ $item }}',
			           },
			        @endforeach
			    }; 
		
	    var  client_name         =  '{{ trans("home.Client") }}';
	    var  farm_name         =  '{{ trans("home.Farming Area") }}';
	    var  choose_area_name  =  '{{ trans("home.Choose Farming Area") }}';
	    var  support_name      =  '{{ trans("home.Total Support Amount") }}';
	    var  total_weight_name      =  '{{ trans("home.Total Weight") }}';
	    var  total_quantity_name      =  '{{ trans("home.Total Quantity") }}';
	    var  total_price_name =  '{{ trans("home.Total Price") }}';
	    var  discount_name     =  '{{ trans("home.Discount Percentage") }}';
	    var  quantity_name     =  '{{ trans("home.Quantity") }}';
	    var  unit_weight_name  = "{{ trans('home.Unit Weight') }}";
	    var  unit_price_name   = "{{ trans('home.Unit Price') }}";
	    var  total_price_name  =  "{{ trans('home.Total Price') }}";
	    var  package_name  =  "{{ trans('home.Packaging') }}";
	</script>
@stop