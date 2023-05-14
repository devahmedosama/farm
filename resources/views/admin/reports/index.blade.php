@extends('admin.content.layout')

@section('content')

<!-- Content Wrapper START -->

<div class="main-content">

    <div class="row">

    	<div class="col-md-12">

    		<ul class="home-ul">



             
    			

                

                <li> 

                    <a href="{{ URL::to('admin/reports/farms') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Farming') }} 

                    </a>

                </li>
                <li> 
                    <a href="{{ URL::to('admin/reports/sells') }}" class="btn btn-md btn-primary">
                        {{ trans('home.Sell or Harvester') }} 
                    </a>
                </li>
               
                <li> 

                    <a href="{{ URL::to('admin/reports/stocks') }}" class="btn btn-md btn-primary">

                        {{ trans('home.Stocks') }} 

                    </a>

                </li>
                
                <li> 
                    <a href="{{ URL::to('admin/reports/moves') }}" class="btn btn-md btn-primary">
                        {{ trans('home.Move Stock') }} 
                    </a>
                </li>
    		</ul>

    	</div>

    </div>

   

</div>



<script type="text/javascript">

  

   

</script>

@stop