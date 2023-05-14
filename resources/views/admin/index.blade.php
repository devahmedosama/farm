@extends('admin.content.layout')
@section('content')
<!-- Content Wrapper START -->
<div class="main-content">
    <div class="row">
    	<div class="col-md-12">
    		<ul class="home-ul">
                <!-- @if(Auth::User()->type == 0)
                <li> 
                    <a href="{{ URL::to('admin/users') }}" class="btn btn-md btn-primary">
                        {{ trans('home.Users') }}
                    </a>
                </li>
                @endif -->
                @if(\App\Models\Permission::check('employees/land') == 1)
                <li> 
                    <a href="{{ URL::to('admin/employees/land') }}" class="btn btn-md btn-primary">
                         {{ trans('home.Employees') }}
                    </a>
                </li>
                @endif
                @if(\App\Models\Permission::check('data-entry') == 1)
    			<li> 
    				<a href="{{ URL::to('admin/data-entry') }}" class="btn btn-md btn-primary">
    					{{ trans('home.Data Entry') }} 
    				</a>
    			</li>
                @endif
                @if(\App\Models\Permission::check('edit-entry') == 1)
                <li> 
                    <a href="{{ URL::to('admin/edit-entry') }}" class="btn btn-md btn-primary">
                        {{ trans('home.Edit Entries') }} 
                    </a>
                </li>
                @endif
                @if(\App\Models\Permission::check('fertilizations') == 1)
                <li> 
                    <a href="{{ URL::to('admin/fertilizations') }}" class=" note-holder btn btn-md btn-primary">
                        {{ trans('home.Fertilizations') }} 
                        <span class="note-number">{{ $fer_count }}</span>
                    </a>
                </li>
                @endif
                @if(\App\Models\Permission::check('pesticides') == 1)
                <li> 
                    <a href="{{ URL::to('admin/pesticides') }}" class=" note-holder btn btn-md btn-primary">
                        {{ trans('home.Pesticides') }} 
                        <span class="note-number">{{ $pest_count }}</span>
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
                @if(\App\Models\Permission::check('alerts') == 1)
                <li> 
                    <a href="{{ URL::to('admin/alerts') }}" class="note-holder btn btn-md btn-primary">
                        {{ trans('home.Alerts') }}
                        <span class="note-number">{{ $alert_count }}</span>
                    </a>
                </li>
                @endif
                @if(Auth::User()->type == 0)
                <li> 
                    <a href="{{ URL::to('admin/reports') }}" class="note-holder btn btn-md btn-primary">
                        {{ trans('home.Reports') }}
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