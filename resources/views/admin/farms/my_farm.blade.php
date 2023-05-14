@extends('admin.content.layout')
@section('content')
<!-- Content Wrapper START -->
<div class="main-content">
    <div class="row">
    	<div class="col-md-12">
    		<ul class="home-ul">
    			<li> 
    				<a href="{{ URL::to('admin/farms') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Farm Areas') }}
    				</a>
    			</li>
    			<li> 
    				<a href="{{ URL::to('admin/nurseries') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Nurseries') }}
    				</a>
    			</li>
    			
    			
    		</ul>
    	</div>
    </div>
   
</div>

<script type="text/javascript">
  
   
</script>
@stop