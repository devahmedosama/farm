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
			<div class="table-responsive">
			    <table class="table">
			        <thead>
			            <tr>
			                <th scope="col">{{ trans('home.Name') }}</th>
			                <th scope="col">{{ trans('home.Nationality') }}</th>
			                <th scope="col">{{ trans('home.Job') }}</th>
			                <th scope="col">{{ trans('home.Salary') }}</th>
			                <th>{{trans('home.Visa Expire Date') }}</th>
			                <th>{{trans('home.Vacations') }}</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($allData as $data)
			            <tr>
			                <td>
			                	<a href="{{ URL::to('admin/employees/show/'.$data->id) }}">
			                		{{ $data->name }}
			                	</a>
			                	
			                </td>
			               <td>
			               	{{ $data->nationality }}
			               </td>
			                <td>
			               	{{ $data->job }}
			               </td>
			               <td>
			               	{{ $data->salary }}
			               </td>
			               <td>
			               	{{ $data->visa_expire_date }}
			               </td>
			               <td>
			               	@if(\App\Models\Permission::check('vacations/add') == 1)
			               	<a  class="btn btn-xs btn-primary"
			               	 data-toggle="modal" data-target="#exampleModalviewcompany{{ $data->id }}">
			               		<i class="fa fa-plus" aria-hidden="true"></i>
			               	</a>
			               
			               	<div class="modal fade" id="exampleModalviewcompany{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog popup_form" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        {{ Form::open(['url'=>'admin/vacations/add/'.$data->id,'files'=>true,'enctype'=>'multipart','class'=>'ajax_form']) }}
									    <div class="form-row">
									        <div class="form-group col-md-6">
									            <label for="inputEmail4"> {{trans('home.Date From') }} </label>
									            {{ Form::date('date_from',null,['class'=>'form-control','required']) }}
									        </div>
									        <div class="form-group col-md-6">
									            <label for="inputEmail4"> {{trans('home.Date To') }} </label>
									            {{ Form::date('date_to',null,['class'=>'form-control','required']) }}
									        </div>
									        <div class="form-group col-md-12">
									            <label for="inputEmail4"> {{trans('home.Type') }} </label>
									            {{ Form::select('type',$types,null,['class'=>'form-control','required']) }}
									        </div>
									    </div>
									    <button type="submit" class="btn btn-primary">{{trans('home.Save') }}</button>
									{{ Form::token() }}
									{{ Form::close() }}
							      </div>
							      
							    </div>
							  </div>
							</div>
							@endif
							@if(\App\Models\Permission::check('vacations') == 1)
			               	<a href="{{ URL::to('admin/vacations/'.$data->id) }}" class="btn btn-xs btn-success">
			               		<i class="fa fa-bars" aria-hidden="true"></i>
			               	</a>
			               	@endif
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