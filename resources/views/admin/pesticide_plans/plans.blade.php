@extends('admin.content.layout')

@section('content')

	<div class="page-header">

        <h2 class="header-title"> {{ $title }} </h2>

        <div class="header-sub-title">

            <nav class="breadcrumb breadcrumb-dash">

                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>

                <a href="{{ URL::to('admin/edit-entry') }}" class="breadcrumb-item">{{ trans('home.Edit Entries') }}</a>

                <span class="breadcrumb-item active">{{ $title }}</span>

            </nav>

        </div>

    </div>

	<div class="card">

		<div class="card-body">

			<div class="panel-heading">
				<ul class="area-ul">
					@foreach($areas  as $area)
						<li> <a href="{{ URL::to('admin/pesticide-plans?area_id='.$area->id) }}" class="btn btn-primary">
							{{ $area->name }}</a> 
						</li>
			        @endforeach
				</ul>

		    </div>

			<div class="table-responsive">

			    <table class="table">

			        <thead>

			             <tr>

			                <th scope="col">{{ trans('home.Farming Area') }}</th>

			                <th scope="col">{{ trans('home.Pesticide') }}</th>

			                <th scope="col">{{ trans('home.Quantity') }}</th>

			                <th scope="col">{{ trans('home.Date') }}</th>

			                <th scope="col">{{ trans('home.Options') }}</th>

			            </tr>

			        </thead>

			        <tbody>
			        	<?php $old_class =  ''; ?>
			        	@foreach($allData as $key=>$data)
			        	<?php 

			        	      $current   =  $data->farm_id.'-'.$data->date;

			        	      $state     = ($current == $old_class)?1:0;

			        	      $old_class =  $current;

			        	 ?>

			            <tr class="{{ ($state == 1)?'current_row':'' }}">



			            	<td>



			            		{{ ($data->ferrilization_plan?$data->ferrilization_plan->area:' ') }}



			            	</td>



			                <td>
			                	{{ ($data->company)?$data->company->name:'' }} 

			                	{{  ($data->fertilization_type)?'('.$data->fertilization_type->name.')':$data->fertilization_type_id }}

			                </td>

			                <td>{{ $data->amount }} {{ ($data->fertilization_type->unit)?$data->fertilization_type->unit->name:'' }}</td>

			                <td>{{ $data->date }}</td>

			                <td>

			                	<a href="{{ URL::to('admin/pesticide-plans/edit/'.$data->id) }}" class="btn btn-primary btn-xs">

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

								        <h5 class="modal-title" id="exampleModalLabel">{{ trans('home.Alert') }} </h5>

								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

								          <span aria-hidden="true">&times;</span>

								        </button>

								      </div>

								      <div class="modal-body">

								         {{ trans('home.Are You Sure You Want to Delete This ?') }}

								      </div>

								      <div class="modal-footer">

								        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('home.Close') }} </button>

								        <a href="{{ URL::to('admin/pesticide-plans/delete/'.$data->id) }}" class="btn btn-danger"> {{ trans('home.Confirm') }}</a>

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