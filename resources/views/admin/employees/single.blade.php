@extends('admin.content.layout')
@section('content')
<div class="page-header">
        <h2 class="header-title">{{ $data->name }}</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{ URL::to('admin') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>{{ trans('home.Home') }}</a>
                <a class="breadcrumb-item" href="{{ URL::to('admin/employees/land') }}">{{ trans('home.Employees') }}</a>
                <span class="breadcrumb-item active">{{ $data->name }}</span>
            </nav>
        </div>
    </div>
<div class="card">
        <div class="card-body">
                <div class="card mb-4 single_page">
                    @if(file_exists($data->image))
                    <img src="{{ URL::to($data->image) }}"  alt="Detail Picture" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <p class="text-muted mb-2"> {{ trans('home.Name') }} :  {{ $data->name }}</p>
                        <p class="text-muted mb-2"> 
                             {{trans('home.Phone') }} 
                             :  {{ $data->phone }}
                        </p>
                        <p class="text-muted mb-2"> {{ trans('home.Id No') }} : 
                         {{ $data->id_no }}</p>
                         <p class="text-muted mb-2"> {{ trans('home.Salary') }} : 
                         {{ $data->salary }}</p>
                        <p class="text-muted mb-2"> {{ trans('home.Job') }} : 
                         {{ $data->job }}</p>
                        <p class="text-muted mb-2"> {{ trans('home.Passport No') }} :  {{ $data->passport_no }}</p>
                        <p class="text-muted mb-2">  {{trans('home.Date Of Birth') }}
                             :  {{ $data->birth_date }}
                        </p>
                       
                        <p class="text-muted mb-2"> 
                             {{trans('home.Joining Date') }}
                             :  {{ $data->join_date }}
                        </p>
                        <p class="text-muted mb-2"> 
                             {{trans('home.Visa Expire Date') }}
                             :  {{ $data->visa_expire_date }}
                        </p>
                        <p class="text-muted mb-2"> 
                             {{trans('home.Nationality') }}
                             :  {{ $data->nationality }}
                        </p>
                        <p class="mb-3">
                            {{ $data->text }}
                        </p>

                        
                    </div>
                </div>
        </div>
</div>
@stop