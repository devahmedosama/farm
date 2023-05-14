@extends('admin.content.layout')
@section('content')
	<div class="page-header">
        <h2 class="header-title"> {{ $title }} </h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <span class="breadcrumb-item active">{{ $title }}</span>
            </nav>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
			<a href="{{ URL::to('admin/seedling-moves/add') }}" class="btn btn-md btn-primary pull-right">{{ trans('home.Add Seedling Move') }}</a>
			<div class="table-responsive">
			    <table class="table">
			        <thead>
			            <tr>
			                <th scope="col">{{ trans('home.Date') }}</th>
			                <th scope="col">{{ trans('home.Nursery') }}</th>
			                <th scope="col">{{ trans('home.Farm') }}</th>
			                <th scope="col">{{ trans('home.Options') }}</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($allData as $data)
			            <tr>
			                <td>{{ $data->date }}</td>
			                <td>{{ $data->nursery->plant_type->name.' '.$data->nursery->seeding_date }}</td>
			                <td>{{ $data->farm->product_type->name.'-'.$data->farm->seeding_date; }}</td>
			                <td>
			                
			                	<a href="{{ URL::to('admin/seedling-moves/edit/'.$data->id) }}" class="btn btn-primary btn-xs">
			                		<i class="anticon anticon-setting"></i>
			                	 </a>
			                	<!-- Button trigger modal -->
								<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal{{ $data->id }}">
								   <i class="fa fa-trash" aria-hidden="true"></i>
								</button>

								<!-- Modal -->
								<div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel"> {{ trans('home.Alert') }}</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								         {{ trans('home.Are You Sure You Want to Delete This ?') }}
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('home.Close') }}</button>
								        <a href="{{ URL::to('admin/seedling-moves/delete/'.$data->id) }}" class="btn btn-danger">{{ trans('home.Confirm') }}</a>
								      </div>
								    </div>
								  </div>
								</div>
			                </td>
			            </tr>
			           @endforeach
			           <tr>
			           	<td colspan="3">{{ $allData->links() }}</td>
			           </tr>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
@stop