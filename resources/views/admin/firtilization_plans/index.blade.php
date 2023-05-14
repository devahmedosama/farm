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

			<div class="panel-heading">
			<ul class="area-ul">
				@foreach($areas  as $area)
					<li> <a href="{{ URL::to('admin/fertilizations?area_id='.$area->id) }}" 
						class="btn {{ ($id==$area->id)?'btn-success':'btn-primary' }} ">
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

			                <th scope="col">{{ trans('home.Fertilization') }}</th>

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
			                	{{ ($data->company)?$data->company->name:' ' }}{{  ($data->fertilization_type)?'('.$data->fertilization_type->name.')':$data->fertilization_type_id }}
			                </td>

			                <td>{{ $data->amount }} {{ ($data->fertilization_type->unit)?$data->fertilization_type->unit->name:'' }}</td>

			                <td>{{ $data->date }}</td>

			                <td>

			                	@if($data->state == 1)

			                	<a class="btn btn-primary btn-xs">

			                		<i class="anticon anticon-check"></i>

			                	</a>

			                	@else

			                	<a href="{{ URL::to('admin/fertilization/state/'.$data->id) }}" class="btn btn-success btn-xs">

			                		<i class="anticon anticon-check"></i>

			                	</a>

			                	@endif

			                </td>

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