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

		        {{ Form::open(['url'=>'admin/reports/moves','method'=>'get','class'=>'search-form']) }}

		        <div class="row">

		        	    <div class="col-sm-4">

			            	<label class="label-control">{{ trans('home.Stock Type') }}</label>

			               {{ Form::select('stock_type_id',$stock_types,app('request')->input('stock_type_id'),

			               ['class'=>'form-control','placeholder'=>trans('home.Stock Types')]) }}

			            </div>

			            <div class="col-sm-4">

			            	<label class="label-control">{{ trans('home.Date From') }}</label>

			               {{ Form::date('date_from',app('request')->input('date_from'),['class'=>'form-control']) }}

			            </div>

			            <div class="col-sm-3">

			            	<label class="label-control">{{ trans('home.Date To') }}</label>

			               {{ Form::date('date_to',app('request')->input('date_to'),['class'=>'form-control']) }}

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

			                <th scope="col">{{ trans('home.Name') }}</th>

			                <th scope="col">{{ trans('home.Amount') }}</th>

			                <th scope="col">{{ trans('home.Date') }}</th>

			            </tr>

			        </thead>

			        <tbody>

			        	@foreach($allData as $key=>$data)

			            <tr>

			                <td>{{ $data->stock->name }} {{  ($data->stock->company)?' ( '.$data->stock->company->name.' ) ':' ' }}</td>

			                <td>{{ $data->amount.' '.$data->stock->unit->name }}</td>

			                <td>{{ date('Y-m-d',strtotime($data->created_at)) }}</td>

			               

			            </tr>

			           @endforeach

			           <tr>

			           	<td colspan="3">{{ $allData->appends($_GET)->links() }}</td>

			           </tr>

			        </tbody>

			    </table>

			</div>

		</div>

	</div>

@stop