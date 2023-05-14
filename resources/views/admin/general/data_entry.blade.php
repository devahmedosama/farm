@extends('admin.content.layout')

@section('content')

<!-- Content Wrapper START -->

<div class="main-content">

    <div class="row">

    	<div class="col-md-12">

    		<ul class="home-ul">


                @if(\App\Models\Permission::check('employees/add') == 1)
                <li> 

                    <a href="{{ URL::to('admin/employees/add') }}" class="btn btn-md btn-primary">

                         {{ trans('home.Add Employee') }}

                    </a>

                </li>
                @endif
                @if(\App\Models\Permission::check('fertilizations/add') == 1)
    			<li> 

    				<a href="{{ URL::to('admin/fertilizations/add') }}" class="btn btn-md btn-primary">

    					{{ trans('home.Add Fertilization') }} 

    				</a>

    			</li>
                @endif
                @if(\App\Models\Permission::check('medicines/plans/add') == 1)
                <li> 

                    <a href="{{ URL::to('admin/medicines/plans/add') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Add Pesticides') }} 

                    </a>

                </li>
                @endif
                @if(\App\Models\Permission::check('areas/add') == 1)
                <li> 

                    <a href="{{ URL::to('admin/areas/add') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Add Farmming Area') }} 

                    </a>

                </li>
                @endif
                @if(\App\Models\Permission::check('farms/add') == 1)
                <li> 

                    <a href="{{ URL::to('admin/farms/add') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Farming') }} 

                    </a>

                </li>
                @endif
                <!-- <li> 

                    <a href="{{ URL::to('admin/nurseries/add') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Add Nursery') }} 

                    </a>

                </li> -->
                @if(\App\Models\Permission::check('stocks/add') == 1)
                <li> 

                    <a href="{{ URL::to('admin/stocks/add') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Add Stock') }} 

                    </a>

                </li>
                @endif
                @if(\App\Models\Permission::check('sells/add') == 1)
                 <li> 

                    <a href="{{ URL::to('admin/sells/add') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Sell or Harvester') }} 

                    </a>

                </li>
                @endif
                @if(\App\Models\Permission::check('stocks/move') == 1)
                <li> 

                    <a href="{{ URL::to('admin/stocks/move') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Move Stock') }} 

                    </a>

                </li>
                @endif
                

    		</ul>

    	</div>

    </div>

   

</div>



<script type="text/javascript">

  

   

</script>

@stop