<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="PIXINVENT">
    <title>{{config('app.project.name')}}</title>
    <link rel="apple-touch-icon" href="{{url('/')}}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/')}}/app-assets/images/logo/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/vendors/css/extensions/tether-theme-arrows.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/vendors/css/extensions/tether.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/vendors/css/extensions/shepherd-theme-default.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/pages/dashboard-analytics.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/pages/card-analytics.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/plugins/tour/tour.css">
    <!-- END: Page CSS-->


    <!--Custom Css-->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/fontawesome-v5.7.2-pro.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/admin-new.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/admin-new.css">

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/style.css">
    <!-- END: Custom CSS-->
    <link rel="stylesheet" type="text/css" href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- BEGIN: Header-->
    
    
       <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="mr-2"><i class="fal fa-calendar-alt"></i> {{date("d-m-Y")}}</li>
<!--                            <li><i class="fal fa-calendar-alt"></i> 28-10-2020</li>-->
                        </ul>

                    </div>
                   
                    <ul class="nav navbar-nav float-right">
<!--
                        <li class="dropdown dropdown-language nav-item">
                            <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="selected-language">English</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"> English</a><a class="dropdown-item" href="#" data-language="de"> Arabic</a></div>
                        </li>
-->
                        <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon feather icon-search"></i></a>
                            <div class="search-input">
                                <div class="search-input-icon"><i class="feather icon-search primary"></i></div>
                                <input class="input" type="text" placeholder="Explore Renteem..." tabindex="-1" data-search="template-list">
                                <div class="search-input-close"><i class="feather icon-x"></i></div>
                                <ul class="search-list search-list-main"></ul>
                            </div>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up">5</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">

                                <li class="scrollable-container media-list">
                                    <a class="d-flex justify-content-between" href="javascript:void(0)">
                                        <div class="media d-flex align-items-start">
                                            <div class="media-body">
                                                <h6 class="primary media-heading">You have new order!</h6><small class="notification-text"> Are your going to meet me tonight?</small>
                                            </div><small>
                                                <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">9 hours ago</time></small>
                                        </div>
                                    </a>
                                </li>
                                     <li class="scrollable-container media-list">
                                    <a class="d-flex justify-content-between" href="javascript:void(0)">
                                        <div class="media d-flex align-items-start">
                                            <div class="media-body">
                                                <h6 class="primary media-heading">You have new order!</h6><small class="notification-text"> Are your going to meet me tonight?</small>
                                            </div><small>
                                                <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">9 hours ago</time></small>
                                        </div>
                                    </a>
                                </li>
                                
                                     <li class="scrollable-container media-list">
                                    <a class="d-flex justify-content-between" href="javascript:void(0)">
                                        <div class="media d-flex align-items-start">
                                            <div class="media-body">
                                                <h6 class="primary media-heading">You have new order!</h6><small class="notification-text"> Are your going to meet me tonight?</small>
                                            </div><small>
                                                <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">9 hours ago</time></small>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">View all notifications</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            
                            @php 
                                $admin_profile_img =  isset($shared_admin_details['profile_image'])  ? $shared_admin_details['profile_image'] : "";
                                $profile_image_src = ""; 
                            @endphp

                            @if(isset($admin_profile_img) &&  $admin_profile_img!="" && file_exists($profile_image_base_img_path.$admin_profile_img))
                                @php
                                    $profile_image_src = $profile_image_public_img_path.$admin_profile_img;
                                @endphp
                            @else
                                @php
                                    $profile_image_src = $profile_image_public_img_path."default-profile.png";
                                @endphp
                            @endif
                                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{isset($shared_admin_details['first_name'])?ucwords($shared_admin_details['first_name']):''}} </span><span class="user-status">Available</span></div><span><img class="round" src="{{$profile_image_src}}" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="page-user-profile.html">
                                    <i class="feather icon-user"></i> Edit Profile
                                </a>
                                <a class="dropdown-item" href="app-email.html">
                                    <i class="feather icon-mail"></i> My Inbox
                                </a>
                                <a class="dropdown-item" href="app-todo.html">
                                    <i class="feather icon-check-square"></i> Task
                                </a>
                                <a class="dropdown-item" href="app-chat.html">
                                    <i class="feather icon-message-square"></i> Chats
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="auth-login.html">
                                    <i class="feather icon-power"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>