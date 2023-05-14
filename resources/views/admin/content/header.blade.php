<!DOCTYPE html>

<html lang="{{ $lang }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ (isset($title))?$title:$setting->name }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ URL::to('assets/admin') }}/images/logo/logo_black.png">

    <!-- page css -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Core css -->
    @if(App::getLocale() == 'ar')
    <link href="{{ URL::to('assets/admin') }}/css/app_ar.css?v=1.05" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/admin/css/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/admin/css/style_ar.css?v=1.03') }}">
    @else
        <link href="{{ URL::to('assets/admin') }}/css/app.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/admin/css/style.css?v=1.01') }}">

    @endif
</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="{{ URL::to('admin') }}">
                        <img src="{{ URL::to('assets/admin') }}/images/logo/logo_black.png" alt="Logo" height="70">
                        <img class="logo-fold" src="{{ URL::to('assets/admin') }}/images/logo/logo_black.png" alt="Logo" height="70">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="{{ URL::to('admin') }}">
                        <img src="{{ URL::to('assets/admin') }}/images/logo/logo_black.png" alt="Logo">
                        <img class="logo-fold" src="{{ URL::to('assets/admin') }}/images/logo/logo_black.png" alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                   <ul class="nav-left">
                      <li class="desktop-toggle">
                         <a href="javascript:void(0);">
                         <i class="anticon"></i>
                         </a>
                      </li>
                      <li class="mobile-toggle">
                         <a href="javascript:void(0);">
                         <i class="anticon"></i>
                         </a>
                      </li>
                      
                      </li>
                   </ul>
                  
                   <ul class="nav-right">
                      <li class=" scale-left">
                         <div class="pointer" >
                            <div class="avatar avatar-image  m-h-10 m-r-15">
                              <a href="{{ URL::to('admin/profile') }}">
                               <img style="max-width:100%" src="{{ URL::to('assets/admin/images/logo/avatar.jpeg') }}" alt="">
                              </a>
                            </div>
                         </div>
                         
                      </li>
                      
                   </ul>
                </div>
            </div>    
            <!-- Header END -->