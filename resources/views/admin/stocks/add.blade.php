@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title">{{  trans('home.Add Stock')  }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/stocks') }}">{{  trans('home.Stocks')  }}</a>
                <span class="breadcrumb-item active">{{  trans('home.Add Stock')  }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			{{ Form::open(['url'=>'admin/stocks/add','files'=>true,'enctype'=>'multipart']) }}
			    <div class="form-row">
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Name') }} </label>
			            {{ Form::text('name',null,['class'=>'form-control','placeholder'=>trans('home.Name'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> 
			            <a style="color:red;cursor:pointer"  data-toggle="modal" data-target="#exampleModalviewcompany">
			            {{trans('home.Company') }} *
			            </a>  </label>
								
			            {{ Form::select('company_id',$stock_items,null,['class'=>'form-control basic-select','placeholder'=>trans('home.choose company')]) }}
			        </div>
					<div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.pesticide or fertilizante') }} * </label>
			            {{ Form::select('fertilization_type_id',$types,null,['class'=>'form-control basic-select','placeholder'=>trans('home.choose pesticide or fertilizante')]) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Stock Type') }} </label>
			            {{ Form::select('stock_type_id',$items,app('request')->input('stock_type_id'),['class'=>'form-control basic-select','placeholder'=>trans('home.Stock Types'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> 
			            	<a style="color:red;cursor:pointer" 
			            	 data-toggle="modal" data-target="#exampleModalviewsupplier" target="_blank">
			            	{{trans('home.Supplier') }}
			            	</a> 
			            </label>
			            {{ Form::select('supplier_id',$suppliers,app('request')->input('supplier_id'),['class'=>'form-control basic-select','placeholder'=>trans('home.Choose Supplier')]) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Unit') }} </label>
			            {{ Form::select('unit_id',$units,app('request')->input('unit_id'),['class'=>'form-control basic-select','placeholder'=>trans('home.Choose Unit'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Single Item Weight') }} </label>
			            {{ Form::number('unit_weight',app('request')->input('unit_weight'),['class'=>'form-control','step'=>'any','min'=>0]) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Quantity') }} </label>
			            {{ Form::number('quantity',app('request')->input('quantity'),['class'=>'form-control','step'=>'any','min'=>0,'required']) }}
			        </div>
			        <!-- <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Unit Price') }} </label>
			            {{ Form::number('unit_price',app('request')->input('unit_price'),['class'=>'form-control','step'=>'any','min'=>0,'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Total Price') }} </label>
			            {{ Form::number('total_price',app('request')->input('total_price'),['class'=>'form-control','step'=>'any','min'=>0,'required']) }}
			        </div> -->
			        <div class="form-group col-md-12">
			            <label for="inputEmail4"> {{trans('home.Text') }} </label>
			            {{ Form::textarea('text',app('request')->input('text'),['class'=>'form-control']) }}
			        </div>
			    </div>
			    <button type="submit" class="btn btn-primary">{{ trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="exampleModalviewcompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog popup_form" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">{{ trans('home.Add Company') }}</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        {{ Form::open(['url'=>'admin/companies/add-ajax','files'=>true,'enctype'=>'multipart','class'=>'ajax_form']) }}
			    <div class="form-row">
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Name') }} </label>
			            {{ Form::text('company_name',null,['class'=>'form-control','placeholder'=>trans('home.Name'),'required']) }}
			        </div>
			        <div class="form-group col-md-6">
			            <label for="inputEmail4"> {{trans('home.Type') }} </label>
			            {{ Form::select('company_type',$companies,null,['class'=>'form-control','required']) }}
			        </div>
			    </div>
			    <button type="submit" class="btn btn-primary">{{trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
	      </div>
	      
	    </div>
	  </div>
	</div>


	<div class="modal fade" id="exampleModalviewsupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog popup_form" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">{{ trans('home.Add Supplier') }}</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        {{ Form::open(['url'=>'admin/suppliers/ajax-add','files'=>true,'enctype'=>'multipart','class'=>'ajax_form']) }}
			    <div class="form-row">
			        <div class="form-group col-md-12">
			            <label for="inputEmail4"> {{trans('home.Name') }} </label>
			            {{ Form::text('supplier_name',null,['class'=>'form-control','placeholder'=>trans('home.Name'),'required']) }}
			        </div>
			       
			    </div>
			    <button type="submit" class="btn btn-primary">{{trans('home.Save') }}</button>
			{{ Form::token() }}
			{{ Form::close() }}
	      </div>
	      
	    </div>
	  </div>
	</div>
@stop