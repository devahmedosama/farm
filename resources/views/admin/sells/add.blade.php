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
			{{ Form::open(['url'=>'admin/sells/add','files'=>true,'enctype'=>'multipart']) }}
			    
			    <div class="form-row">
					<!-- <div class="form-group col-md-6">
			            <label for="inputEmail4">{{ trans('home.Client') }}</label>
			            {{ Form::select('client_id',$clients,null,['class'=>'form-control basic-select','required']) }}
			        </div> -->
			        <div class="form-group col-md-12">
			            <label for="inputEmail4">{{ trans('home.Date') }}</label>
			            {{ Form::date('date',null,['class'=>'form-control','required']) }}
			        </div>
			        <div class="col-md-12">

				    	<a class="btn btn-primary btn-xs" id="add_sell"> <i class="anticon anticon-plus"></i></a>
			            </br>
			        	<div  id='sell_items' style="min-height: 30px">

				        </div> 

			        </div>
			        <div class="form-group col-md-12 ">
			        	</hr>
			        </div>
			        <div class="form-group col-md-12 " id="products_div" style="color:#000">

			        </div>
			        
			        <div class="form-group col-md-4 ">
			        	<label class="control-label">{{ trans('home.Total Weight') }} <span id="total_weight"></span></label>
			        	
			        </div>
			        <div class="form-group col-md-4 ">
			        	<label class="control-label">{{ trans('home.Total Quantity') }} <span id="total_quantity"></span></label>
			        	
			        </div>
			        <div class="form-group col-md-4 ">
			        	<label class="control-label">{{ trans('home.Total Support Amount') }} 
			        		<span id="total_support">0</span> {{ trans('home.Dinar') }}
			        	</label>
			        	
			        </div>
			       <!--  <div class="form-group col-md-3 ">
			        	<label class="control-label">{{ trans('home.Total Price') }} <span id="total_price"></span></label>
			        	
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
			        @foreach($clients as $key=>$item)
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