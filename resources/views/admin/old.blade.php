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
    			<li> 
    				<a href="{{ URL::to('admin/my-farm') }}" class="btn btn-md btn-primary">
    					{{ trans('home.My Farm') }}
    				</a>
    			</li>

    			<li> 
    				<a href="{{ URL::to('admin/stocks') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Stocks') }}
    				</a>
    			</li>
    			<li> 
    				<a href="{{ URL::to('admin/sells') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Sells') }}
    				</a>
    			</li>
    			<li> 
    				<a href="{{ URL::to('admin/suppliers') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Suppliers') }}
    				</a>
    			</li>
    			<li> 
    				<a href="{{ URL::to('admin/fertilization-types') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Fertilization Types') }}
    				</a>
    			</li><li> 
    				<a href="{{ URL::to('admin/clients') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Clients') }}
    				</a>
    			</li><li> 
    				<a href="{{ URL::to('admin/units') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Units') }}
    				</a>
    			</li><li> 
    				<a href="{{ URL::to('admin/plant-types') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Plant Types') }}
    				</a>
    			</li><li> 
    				<a href="{{ URL::to('admin/products') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Products') }}
    				</a>
    			</li>
    			<li> 
    				<a href="{{ URL::to('admin/stock-types') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Stock Types') }}
    				</a>
    			</li>
    			<li> 
    				<a href="{{ URL::to('admin/equipments') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Equipments') }}
    				</a>
    			</li>
    			<li> 
    				<a href="{{ URL::to('admin/equipmentuses') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Equipment Uses') }}
    				</a>
    			</li>
                <li> 
                    <a href="{{ URL::to('admin/alerts') }}" class="btn btn-md btn-primary">
                        {{ trans('home.Alerts') }}
                    </a>
                </li>
                <li> 
                    <a href="{{ URL::to('admin/employees') }}" class="btn btn-md btn-primary">
                         {{ trans('home.Employees') }}
                    </a>
                </li>
               
    			
    			
    		</ul>
    	</div>
    </div>
   
</div>

<script type="text/javascript">
  
   
</script>
@stop