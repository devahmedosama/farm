@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title"> {{ $title }} </h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a href="{{ URL::to('admin/reports') }}" class="breadcrumb-item">
                	{{ trans('home.Reports') }}
                </a>
                <span class="breadcrumb-item active">{{ $title }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			<div class="panel-heading text-right">
		        {{ Form::open(['url'=>'admin/reports/sells','method'=>'get','class'=>'search-form']) }}
		        <div class="row">
		        	    <div class="col-sm-4">
			            	<label class="label-control">{{ trans('home.Farming Area') }}</label>
			               {{ Form::select('area_id',$areas,app('request')->input('area_id'),
			               ['class'=>'form-control','placeholder'=>trans('home.Farming Area')]) }}
			            </div>
			            <div class="col-sm-4">
			            	<label class="label-control">{{ trans('home.Product') }}</label>
			               {{ Form::select('product_type_id',$products,app('request')->input('product_type_id')
			               ,['class'=>'form-control','placeholder'=>trans('home.Product')]) }}
			            </div>
			            <div class="col-sm-4">
			            	<label class="label-control">{{ trans('home.Client') }}</label>
			               {{ Form::select('client_id',$clients,app('request')->input('client_id')
			               ,['class'=>'form-control','placeholder'=>trans('home.Client')]) }}
			            </div>
			            <div class="col-sm-4">
			            	<label class="label-control">{{ trans('home.Date From') }}</label>
			               {{ Form::date('date_from',app('request')->input('date_from'),['class'=>'form-control']) }}
			            </div>
			            <div class="col-sm-4">
			            	<label class="label-control">{{ trans('home.Date To') }}</label>
			               {{ Form::date('date_to',app('request')->input('date_to'),['class'=>'form-control']) }}
			            </div>
			           <div class="col-sm-3">
			            	<label class="label-control">&nbsp;</label>
			            	<label class="label-control">{{ trans('home.Export') }}  <input type='checkbox' value='1' name="export"></label>
			              
			            </div>
			            <div class="col-sm-1">
			            	<label class="label-control">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			                <button type="submit"  class="btn btn-primary btn-md">
			                	<i class="anticon anticon-search"></i>
			                </button>
			            </div>
			        </div>
			        {{ Form::close() }}
			    </div>
			<div class="table-responsive">

			    <table class="table">
			        <thead>
			            <tr>
			                <th scope="col">{{ trans('home.Client') }}</th>
			                <th scope="col">{{ trans('home.Total Weight') }}</th>
			                <th scope="col">{{ trans('home.Support Amount') }}</th>
			                <th scope="col">{{ trans('home.Date') }}</th> 
			                <th scope="col">{{ trans('home.Options') }}</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($allData as $data)
			            <tr>
			                <td><a href="{{ URL::to('admin/reports/sells?client_id='.$data->client_id) }}">
			                {{ ($data->client)?$data->client->name:'' }}
			                </a></td>
			                <td>{{ $data->total_weight }}</td>
			                <td>{{ $data->total_support.' '.trans('home.Dinar') }}</td>
			                <td>{{ $data->date }}</td>
			                <td>
			                	<a href="{{ URL::to('admin/sells/edit/'.$data->id) }}">
			                		<i class="anticon anticon-eye"></i>
			                	</a>

			                	<a href="{{ URL::to('admin/reports/sells-print/'.$data->id) }}">
			                		<i class="fa fa-print" aria-hidden="true"></i>

			                	</a>
			                </td>
			            </tr>
			           @endforeach
			           <tr>
			           	<td colspan="6">{{ $allData->appends($_GET)->links() }}</td>
			           </tr>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
@stop