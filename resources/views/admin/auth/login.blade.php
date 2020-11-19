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
    <title>Iraq Post</title>
    <link rel="apple-touch-icon" href="{{url('/')}}/app-assets/images/ico/apple-icon-120.png">
     <link rel="shortcut icon" type="image/x-icon" href="{{url('/')}}/app-assets/images/logo/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
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
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/fontawesome-v5.7.2-pro.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/app-assets/css/admin-new.css">
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/style.css">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0 login-page-section">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                    <img src="{{url('/')}}/app-assets/images/pages/login.png" alt="branding logo">
                                </div>
                                <div class="col-lg-6 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">Login</h4>
                                            </div>
                                        </div>
                                        <p class="px-2">Welcome back, please login to your account.</p>
                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                                <form action="{{url($admin_panel_slug.'/process_login')}}" id="frm_login" method="post"  class="form-validate">
													{{csrf_field()}}
                                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" autofocus="true" placeholder="Email address" name="email" id="email" value="{{isset($_COOKIE['remember_me_email']) && !empty($_COOKIE['remember_me_email']) ? $_COOKIE['remember_me_email']:''}}">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                        <label for="email">Email</label>
                                                        <span class="error_class" style="color:red;">{{ $errors->first('email') }} </span>
                                                    </fieldset>

                                                    <fieldset class="form-label-group position-relative has-icon-left">
                                                       <input type="password" class="form-control" placeholder="Password" name="password" id="password" required="required" minlength="6" data-rule-maxlength="16" value="{{isset($_COOKIE['remember_me_password']) && !empty($_COOKIE['remember_me_password']) ? $_COOKIE['remember_me_password']:''}}">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-lock"></i>
                                                        </div>
                                                        <label for="password">Password</label>
                                                        <span class="error_class" style="color:red;">{{ $errors->first('password') }} </span>
                                                    </fieldset>
                                             
                                                   
                                                    <button type="submit" class="btn btn-primary float-right btn-inline login-width">Login</button>
                                                </form>
                                            </div>
                                        </div>
                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{url('/')}}/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{url('/')}}/app-assets/js/core/app-menu.js"></script>
    <script src="{{url('/')}}/app-assets/js/core/app.js"></script>
    <script src="{{url('/')}}/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

    <script>
		$(document).ready(function(){
			jQuery('#frm_login').validate({
				errorClass: "error_class",
				highlight: function(element) { },
				errorElement: "span",
				rules: {
					email: {
						required: true,
						email: true,
						pattern: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/
					}
				},
				messages: {
					email: {
						pattern: "Please enter a valid email address.",

					},
				}

			});
		});
	</script>

</body>
<!-- END: Body-->

</html>