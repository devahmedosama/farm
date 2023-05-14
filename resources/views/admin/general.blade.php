@extends('admin.content.layout')
@section('content')
<style type="text/css">
.general-ul li{
	display: inline-block;
	margin: 10px;
}
</style>
	<div class="page-header">
        <h2 class="header-title"> {{ trans('home.General') }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <span class="breadcrumb-item active"> {{ trans('home.General') }}</span>
            </nav>
        </div>
    </div>

	<div class="card">
		<div class="card-body">
		     <ul class="general-ul">
		     	<li>
		     		<a href="{{ URL::to('admin/plant-types') }}" class="btn btn-md btn-primary">{{ trans('home.Plant Types') }}</a>
		     	</li>
		     	<li>
		     		<a href="{{ URL::to('admin/products') }}" class="btn btn-md btn-primary">{{ trans('home.Products') }}</a>
		     	</li>
		     	<li>
		     		<a href="{{ URL::to('admin/stock-types') }}" class="btn btn-md btn-primary">{{ trans('home.Stock Types') }}</a>
		     	</li>
		     	<li>
		     		<a href="{{ URL::to('admin/units') }}" class="btn btn-md btn-primary">{{ trans('home.Units') }}</a>
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
		     	</li>
		     	
		     	
		     </ul>
		</div>
	</div>
@stop