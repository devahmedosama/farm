@extends('admin.content.layout')

@section('content')

<!-- Content Wrapper START -->

<div class="main-content">

    <div class="row">

    	<div class="col-md-12">

    		<ul class="home-ul">

                @if(Auth::User()->type == 0)

                <li> 

                    <a href="{{ URL::to('admin/users') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Users') }}

                    </a>

                </li>

                @endif
                @if(\App\Models\Permission::check('farms') == 1)
    			<li> 
    				<a href="{{ URL::to('admin/farms') }}" class="btn btn-md btn-primary">
    					{{ trans('home.My Farm') }}
    				</a>
    			</li>
                @endif

                @if(\App\Models\Permission::check('stocks') == 1)
    			<li> 

    				<a href="{{ URL::to('admin/stocks') }}" class="btn btn-md btn-primary">

    					{{ trans('home.Stocks') }}

    				</a>

    			</li>
                @endif
                @if(\App\Models\Permission::check('stock/moves') == 1)
                <li> 

                    <a href="{{ URL::to('admin/stock/moves') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Stock Move') }}

                    </a>

                </li>
                @endif
                @if(\App\Models\Permission::check('sells') == 1)
    			<li> 

    				<a href="{{ URL::to('admin/sells') }}" class="btn btn-md btn-primary">

    					{{ trans('home.Sells') }}

    				</a>

    			</li>
                @endif
                @if(\App\Models\Permission::check('areas') == 1)
                <li> 

                    <a href="{{ URL::to('admin/areas') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Farming Area') }}

                    </a>

                </li>
                @endif
                @if(\App\Models\Permission::check('suppliers') == 1)
    			<li> 

    				<a href="{{ URL::to('admin/suppliers') }}" class="btn btn-md btn-primary">

    					{{ trans('home.Suppliers') }}

    				</a>

    			</li>
                @endif
                @if(\App\Models\Permission::check('companies') == 1)
                <li> 

                    <a href="{{ URL::to('admin/companies') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Companies') }}

                    </a>

                </li>
                @endif
                @if(\App\Models\Permission::check('fertilization-plans') == 1)
                <li> 

                    <a href="{{ URL::to('admin/fertilization-plans') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Fertilization Plans') }}

                    </a>

                </li>
                @endif
                @if(\App\Models\Permission::check('pesticide-plans') == 1)
                <li> 

                    <a href="{{ URL::to('admin/pesticide-plans') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Pesticide Plans') }}

                    </a>

                </li>
                @endif
                @if(\App\Models\Permission::check('fertilization-types') == 1)
    			<li> 

    				<a href="{{ URL::to('admin/fertilization-types') }}" class="btn btn-md btn-primary">

    					{{ trans('home.Fertilization Types') }}

    				</a>

    			</li>
                @endif
                @if(\App\Models\Permission::check('fertilization-types') == 1)
				<li> 

    				<a href="{{ URL::to('admin/fertilization-types?type=1') }}" class="btn btn-md btn-primary">

    					{{ trans('home.Pesticide Types') }}

    				</a>

    			</li>
                @endif
                @if(\App\Models\Permission::check('clients') == 1)
                <li> 

    				<a href="{{ URL::to('admin/clients') }}" class="btn btn-md btn-primary">

    					{{ trans('home.Clients') }}

    				</a>

    			</li>
                @endif
                @if(\App\Models\Permission::check('units') == 1)
                <li> 

    				<a href="{{ URL::to('admin/units') }}" class="btn btn-md btn-primary">

    					{{ trans('home.Units') }}

    				</a>

    			</li>
                @endif
				<!-- <li> 

    				<a href="{{ URL::to('admin/plant-types') }}" class="btn btn-md btn-primary">

    					{{ trans('home.Plant Types') }}

    				</a>

    			</li> -->
                @if(\App\Models\Permission::check('products') == 1)
				<li> 

    				<a href="{{ URL::to('admin/products') }}" class="btn btn-md btn-primary">

    					{{ trans('home.Products') }}

    				</a>

    			</li>
                @endif
                @if(\App\Models\Permission::check('stock-types') == 1)
    			<li> 

    				<a href="{{ URL::to('admin/stock-types') }}" class="btn btn-md btn-primary">

    					{{ trans('home.Stock Types') }}

    				</a>

    			</li>
                @endif
                @if(\App\Models\Permission::check('equipments') == 1)
    			<li> 

    				<a href="{{ URL::to('admin/equipments') }}" class="btn btn-md btn-primary">

    					{{ trans('home.Equipments') }}

    				</a>

    			</li>
                @endif
                @if(\App\Models\Permission::check('equipmentuses') == 1)
    			<li> 

    				<a href="{{ URL::to('admin/equipmentuses') }}" class="btn btn-md btn-primary">

    					{{ trans('home.Equipment Uses') }}

    				</a>

    			</li>
                @endif
                @if(\App\Models\Permission::check('alerts') == 1)
                <li> 

                    <a href="{{ URL::to('admin/alerts') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Alerts') }}

                    </a>

                </li>
                @endif
                @if(\App\Models\Permission::check('employees') == 1)
                <li> 

                    <a href="{{ URL::to('admin/employees') }}" class="btn btn-md btn-primary">

                         {{ trans('home.Employees') }}

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