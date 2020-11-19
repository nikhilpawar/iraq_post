<?php

$web_admin_path =config('app.project.admin_panel_slug');



Route::group(array('prefix' => '/common'), function()
{
		Route::get('/get_states', [ 'as'=>'', 'uses'=>'Common\LocationController@get_states']);
		Route::get('/get_cities', [ 'as'=>'', 'uses'=>'Common\LocationController@get_cities']);
});

// ------------Before Login Routes----------------

Route::group(array('prefix' => $web_admin_path,'middleware'=>['admin_auth_check','web']), function ()
{

	$route_slug = 'admin_';
	$module_controller = "Admin\AuthController@";

	Route::get('/',                         ['as' =>$route_slug.'login', 'uses' => $module_controller.'login']);
	Route::get('/login',                    ['as' =>$route_slug.'login', 'uses' => $module_controller.'login']);

	Route::post('process_login',			['as' =>$route_slug.'validate', 'uses' => $module_controller.'process_login']);


	Route::get('forgot_password',			['as' =>$route_slug.'forgot_password', 'uses' => $module_controller.'forgot_password']);

	Route::post('process_forgot_password',	['as' =>$route_slug.'process_forgot_password', 'uses' => $module_controller.'process_forgot_password']);

	Route::get('validate_admin_reset_password_link/{enc_id}/{enc_reminder_code}', 	
											[	'as'	=> $route_slug.'validate_admin_reset_password_link',
												'uses'	=> $module_controller.'validate_reset_password_link']);

	Route::post('reset_password',			[	'as'	=> $route_slug.'reset_passsword',
												'uses'	=> $module_controller.'reset_password']);

	

	
});
 
// ----------------------After login routes--------------------------



Route::group(array('prefix' => $web_admin_path,'middleware'=>'auth_admin'), function () use($web_admin_path)
{

	

	$route_slug 	   = 'admin_';
	$module_controller = "Admin\AuthController@";

	Route::get('/domain',    				[	'as' 	=> $route_slug.'domain', 'uses' => $module_controller.'domain']);
	Route::get('change_password',			['as' =>$route_slug.'change_password', 'uses' => $module_controller.'change_password']);
	Route::post('update_password',			['as' =>$route_slug.'update_password', 'uses' => $module_controller.'update_password']);
	Route::get('logout',					['as' =>$route_slug.'logout', 'uses' => $module_controller.'logout']);
	Route::get('set_domain',				[	'as'	=> $route_slug.'set_domain',
												'uses'	=> $module_controller.'set_domain']);
	$module_controller = "Admin\DashboardController@";
		
	Route::any('/dashboard',				[	'as' 	=> $route_slug.'index', 	 'uses' => $module_controller.'index']);
	Route::post('/dashboard/get_orders',    [	'as' 	=> $route_slug.'get_orders', 'uses' => $module_controller.'get_orders']);
	
	$module_controller = "Admin\SiteSettingController@";

	Route::get('site_setting',			    ['as' =>$route_slug.'site_setting', 'uses' => $module_controller.'index']);
	Route::post('site_setting/update',			['as' =>$route_slug.'update_password', 'uses' => $module_controller.'update']);

	$module_controller = "Admin\AccountSettingController@";

	Route::get('account_setting',			['as' =>$route_slug.'account_setting', 'uses' => $module_controller.'index']);
	Route::post('account_setting/update',	['as' =>$route_slug.'account_setting', 'uses' => $module_controller.'update']);

	Route::group(array('prefix' => 'front_pages'), function ()
	{
		$route_slug        = "front_pages_";
		$module_controller = "Admin\FrontPagesController@";

		Route::get('/',             	['as' => $route_slug.'manage', 'uses' => $module_controller.'index']);
		Route::get('/create',	    	['as' => $route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',			['as' => $route_slug.'create', 'uses' => $module_controller.'store']);
		Route::get('/load_data',		['as' =>$route_slug.'load_data', 'uses' => $module_controller.'load_data']);
		Route::get('/edit/{enc_id}',	['as' => $route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update',		    ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/activate/{id}',    ['as' =>$route_slug.'activate', 'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',  ['as' =>$route_slug.'deactivate', 'uses' => $module_controller.'deactivate']);
		Route::get('/delete/{enc_id}',  ['as' => $route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',    ['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'faq'), function ()
	{
		$route_slug        = "faq_";
		$module_controller = "Admin\FaqController@";		

		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		  ['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update',	      ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/activate/{id}',  ['as' =>$route_slug.'activate', 'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',['as' =>$route_slug.'deactivate', 'uses' => $module_controller.'deactivate']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	/*Route::group(array('prefix' => 'setting'), function () use($route_slug)
	{
		$module_controller = "Admin\SettingController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/manage',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		  ['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});*/

	Route::group(array('prefix' => 'contact_enquiry'), function () use($route_slug)
	{
		$module_controller = "Admin\ContactEnquiryController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/view/{id}',	  ['as' =>$route_slug.'view', 'uses' => $module_controller.'view']);
		Route::post('/reply',	      ['as' =>$route_slug.'reply', 'uses' => $module_controller.'reply']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'email_template'), function () use($route_slug)
	{
		$module_controller = "Admin\EmailTemplateController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update',	      ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::post('/preview',	      ['as' =>$route_slug.'preview', 'uses' => $module_controller.'preview']);
		

	});
	/*Route::group(array('prefix' => 'notifications'), function () use($route_slug)
	{
		$module_controller = "Admin\NotificationsController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});*/

	/*Main Category Route*/

	Route::group(array('prefix' => 'category'), function () use($route_slug)
	{
		$module_controller = "Admin\CategoryController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);

	});

	/* Product Category Route */

	Route::group(array('prefix' => 'product_category'), function () use($route_slug)
	{
		$module_controller = "Admin\ProductCategoryController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);

	});


	/* Sub Category Route */

	Route::group(array('prefix' => 'sub_category'), function () use($route_slug)
	{
		$module_controller = "Admin\SubCategoryController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);

	});

	/* Sub Sub Category Route */

	Route::group(array('prefix' => 'sub_sub_category'), function () use($route_slug)
	{
		$module_controller = "Admin\SubSubCategoryController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);

	});


	Route::group(array('prefix' => 'cuisine'), function () use($route_slug)
	{
		$module_controller = "Admin\CuisineController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);

	});

	Route::group(array('prefix' => 'product_attribute'), function () use($route_slug)
	{
		$module_controller = "Admin\ProductAttributeController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);

	});

	/* Product Attribute */
	Route::group(array('prefix' => 'food_attribute'), function () use($route_slug)
	{
		$module_controller = "Admin\FoodAttributeController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);

	});


	Route::group(array('prefix' => 'commission'), function () use($route_slug)
	{
		$module_controller = "Admin\CommissionController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
	});

	Route::group(array('prefix' => 'mile_charges'), function () use($route_slug)
	{
		$module_controller = "Admin\MileChargesController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);

	});

	Route::group(array('prefix' => 'driver'), function () use($route_slug)
	{
		$module_controller = "Admin\DriverController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::get('/view/{id}',	  		[	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);
		Route::get('/view_payment/{id}',    [	'as' =>$route_slug.'view_payment', 		'uses' => $module_controller.'view_payment']);
		Route::get('/download_document/{id}',	  		
											[	'as' =>$route_slug.'download_document', 'uses' => $module_controller.'download_document']);

	});

	Route::group(array('prefix' => 'vehicle_type'), function () use($route_slug)
	{
		$module_controller = "Admin\VehicleTypeController@";
				
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);

	});

	Route::group(array('prefix' => 'chef'), function () use($route_slug)
	{
		$module_controller = "Admin\ChefController@";		
		
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);
		Route::get('/view/{id}',    	    [	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::get('/view_payment/{id}',    [	'as' =>$route_slug.'view_payment', 		'uses' => $module_controller.'view_payment']);
		Route::post('/store_receipt/{enc_id}',        [	'as' =>$route_slug.'store_receipt', 	'uses' => $module_controller.'store_receipt']);
		
		Route::get('/load/{status}',		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/verify/{id}',	  		[	'as' =>$route_slug.'verify', 			'uses' => $module_controller.'verify']);
		Route::get('/reject/{id}',	  		[	'as' =>$route_slug.'reject', 			'uses' => $module_controller.'reject']);
		Route::get('/{status}',  	  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/verify_business/{id}',	  		[	'as' =>$route_slug.'verify_business', 			'uses' => $module_controller.'verify_business']);
		Route::get('/reject_business/{id}',	  		[	'as' =>$route_slug.'reject_business', 			'uses' => $module_controller.'reject_business']);
		Route::get('/verify_email/{id}',	  		[	'as' =>$route_slug.'verify_email',   			'uses' => $module_controller.'verify_email']);
		Route::get('/reject_email/{id}',	  		[	'as' =>$route_slug.'reject_email',	 			'uses' => $module_controller.'reject_email']);
		Route::get('/download_document/{id}',	  		[	'as' =>$route_slug.'download_document',		'uses' => $module_controller.'download_document']);
		
	});

	Route::group(array('prefix' => 'customers'), function () use($route_slug)
	{
		$module_controller = "Admin\CustomersController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);
		Route::get('/view/{id}',    	    [	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::get('/delete/{id}',    	    [	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::get('/verify_email/{id}',	  		[	'as' =>$route_slug.'verify_email',   			'uses' => $module_controller.'verify_email']);
		Route::get('/reject_email/{id}',	  		[	'as' =>$route_slug.'reject_email',	 			'uses' => $module_controller.'reject_email']);

	});

	Route::group(array('prefix' => 'orders'), function () use($route_slug)
	{
		$module_controller = "Admin\OrdersController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/view/{id}',    	    [	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::get('/view_invoice/{id}',    [	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view_invoice']);
	});

	Route::group(array('prefix' => 'track_drivers'), function () use($route_slug)
	{
		$module_controller = "Admin\OrdersTrackingController@";		
		Route::get('/{type}/{status}',		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::any('/get_drivers',    		[	'as' =>$route_slug.'get_drivers',		'uses' => $module_controller.'get_drivers']);
		Route::get('/order_history',  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'order_history']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/view/{id}',    	    [	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::get('/view_invoice/{id}',    [	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view_invoice']);
	});

	Route::group(array('prefix' => 'review'), function () use($route_slug)
	{
		$module_controller = "Admin\ReviewController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/view/{id}',    	    [	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::get('/load_view/{id}',    	    [	'as' =>$route_slug.'view', 			'uses' => $module_controller.'load_view']);

	});

	Route::group(array('prefix' => 'badge'), function () use($route_slug)
	{
		$module_controller = "Admin\BadgeController@";	
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);
		Route::get('/view/{id}',    	    [	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);

	});
	

	Route::group(array('prefix' => 'service'), function () use($route_slug)
	{
		$module_controller = "Admin\ServicesController@";
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',    	    	[	'as' =>$route_slug.'create', 		    'uses' => $module_controller.'create']);
		Route::post('/store',    	    	[	'as' =>$route_slug.'store', 		    'uses' => $module_controller.'store']);
		Route::get('/view/{id}',    	    [	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);
	});

	Route::group(array('prefix' => 'skills'), function () use($route_slug)
	{
		$module_controller = "Admin\SkillsController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);
		Route::get('/view/{id}',    	    [	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);

	});
	Route::group(array('prefix' => 'service_provider'), function () use($route_slug)
	{
		$module_controller = "Admin\ServiceProviderController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::get('/view/{id}',	  		[	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);
		Route::get('/add_business/{id}',    [	'as' =>$route_slug.'add_business', 		'uses' => $module_controller.'add_business']);
		Route::get('/edit_business/{id}',	[	'as' =>$route_slug.'edit_business',     'uses' => $module_controller.'edit_business']);
		Route::get('/verify_business/{id}', [	'as' =>$route_slug.'verify_business', 	'uses' => $module_controller.'verify_business']);
		Route::get('/reject_business/{id}', [	'as' =>$route_slug.'reject_business', 	'uses' => $module_controller.'reject_business']);
		Route::post('/select_category',  	[	'as' =>$route_slug.'select_category', 	'uses' => $module_controller.'select_category']);
		Route::post('/select_service',  	[	'as' =>$route_slug.'select_service', 	'uses' => $module_controller.'select_service']);
		Route::post('/store_business',		[	'as' =>$route_slug.'store_business',    'uses' => $module_controller.'store_business']);
		Route::post('/update_business',		[	'as' =>$route_slug.'update_business',   'uses' => $module_controller.'update_business']);
		Route::post('/verify',				[	'as' =>$route_slug.'verify',   			'uses' => $module_controller.'verify']);
		Route::post('/reject',				[	'as' =>$route_slug.'reject',   			'uses' => $module_controller.'reject']);

	});
	Route::group(array('prefix' => 'expert'), function () use($route_slug)
	{
		$module_controller = "Admin\ExpertController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::get('/view/{id}',	  		[	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);
		Route::post('/assign_badges',    	[	'as' =>$route_slug.'assign_badges',     'uses' => $module_controller.'assign_badges']);
		Route::get('/get_badges/{enc_id}',      	[	'as' =>$route_slug.'get_badges',        'uses' => $module_controller.'get_badges']);
		

	});
	Route::group(array('prefix' => 'coupons'), function () use($route_slug)
	{
		$module_controller = "Admin\CouponsController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/view/{id}',	  		[	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);
		Route::get('/generate_code',    	[	'as' =>$route_slug.'generate_code',     'uses' => $module_controller.'generate_code']);

		Route::get('/used_coupons',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'used_coupons']);
		Route::get('/load_used_coupons',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_used_coupons']);
		
	});
	Route::group(array('prefix' => 'vendor'), function () use($route_slug)
	{
		$module_controller = "Admin\VendorController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);
		Route::get('/view/{id}',    	    [	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::get('/verify_business/{id}',	[	'as' =>$route_slug.'verify_business',	'uses' => $module_controller.'verify_business']);
		Route::get('/reject_business/{id}',	[	'as' =>$route_slug.'reject_business',	'uses' => $module_controller.'reject_business']);
		Route::get('/view_payment/{id}',    [	'as' =>$route_slug.'view_payment', 		'uses' => $module_controller.'view_payment']);
		Route::post('/store_receipt/{enc_id}',        [	'as' =>$route_slug.'store_receipt', 	'uses' => $module_controller.'store_receipt']);
	});
	Route::group(array('prefix' => 'loads'), function () use($route_slug)
	{
		$module_controller = "Admin\LoadsController@";		
		
		Route::get('/load/{type}',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/view/{id}/{type}',    	    [	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::get('/{type?}',			[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);

	});
	/*-------------------------Reports Ends-------------------------*/

	Route::group(array('prefix' => 'location'), function () use($route_slug)
	{
		$module_controller = "Admin\LocationController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::get('/view/{id}',	  		[	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);	

	});

	Route::group(array('prefix' => 'newsletter'), function () use($route_slug)
	{
		$module_controller = "Admin\NewsletterController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/delete/{id}',     		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);

	});

	Route::group(array('prefix' => 'inquiries'), function () use($route_slug)
	{
		$module_controller = "Admin\InquiriesController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/view/{id}',	  		[	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);

	});

	Route::group(array('prefix' => 'subscription_plan'), function () use($route_slug)
	{
		$module_controller = "Admin\SubscriptionPlanController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::get('/view/{id}',	  		[	'as' =>$route_slug.'view', 				'uses' => $module_controller.'view']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);	

	});


	Route::group(['prefix'=>'keyword_translation'],function()
	{
		$route_slug        = "keyword_translation_";
		$module_controller = "Admin\KeywordTranslationController@";

		Route::get('/',					[	'as'	=>	$route_slug.'index',
						 	    			'uses'	=>	$module_controller.'index']);

		Route::get('get_records',		[	'as'	=> $route_slug.'get_records',
						 					'uses' 	=> $module_controller.'get_records']);

		Route::get('edit/{enc_id}',		[	'as' 	=> $route_slug.'edit',
						 					'uses' 	=> $module_controller.'edit']);

		Route::post('update/',			[	'as' 	=> $route_slug.'update',
											'uses' 	=> $module_controller.'update']);

		Route::get('create/',			[	'as' 	=> $route_slug.'create',
								  			'uses' 	=> $module_controller.'create']);

		Route::post('store/',			[	'as' 	=> $route_slug.'store',
			 					  			'uses' 	=> $module_controller.'store']);

	});

	


	Route::group(array('prefix' => 'notifications'), function ()
	{
		$module_controller = "Admin\NotificationsController@";		
		Route::get('/',				  ['as' =>'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>'load', 'uses' => $module_controller.'load_data']);
		Route::get('/delete/{id}',	  ['as' =>'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>'multi_action', 'uses' => $module_controller.'multi_action']);
	});

	Route::group(array('prefix' => 'tax'), function () use($route_slug)
	{
		$module_controller = "Admin\AdminTaxController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
	});

	Route::group(array('prefix' => 'product_threshold'), function () use($route_slug)
	{
		$module_controller = "Admin\ThresholdController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
	});


	Route::group(array('prefix' => 'dish'), function ()
	{
		$module_controller = "Admin\DishController@";		
		Route::get('/',				  		[	'as' =>'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/view/{id}',	  		[	'as' =>'view', 				'uses' => $module_controller.'view']);
		Route::get('/block/{id}',	  		[	'as' =>'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>'deactivate', 		'uses' => $module_controller.'deactivate']);
		Route::get('/approve_dish/{id}',    [	'as' =>'deactivate', 		'uses' => $module_controller.'approve_dish']);
		Route::get('/reject_dish/{id}',    	[	'as' =>'deactivate', 		'uses' => $module_controller.'reject_dish']);
		Route::post('/multi_action',        ['as' =>'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	/* Products */

	Route::group(array('prefix' => 'products'), function ()
	{
		$module_controller = "Admin\ProductsController@";		
		Route::get('/',				  		[	'as' =>'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/view/{id}',	  		[	'as' =>'view', 				'uses' => $module_controller.'view']);
		Route::get('/block/{id}',	  		[	'as' =>'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>'deactivate', 		'uses' => $module_controller.'deactivate']);
		Route::get('/approve_product/{id}',    [	'as' =>'deactivate', 		'uses' => $module_controller.'approve_product']);
		Route::get('/reject_product/{id}',    	[	'as' =>'deactivate', 		'uses' => $module_controller.'reject_product']);
		Route::post('/multi_action',        ['as' =>'multi_action', 'uses' => $module_controller.'multi_action']);

	});


	Route::group(array('prefix' => 'transactions'), function () use($route_slug)
	{
		$module_controller = "Admin\TransactionsController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		

	});
	Route::group(array('prefix' => 'food_threshold'), function () use($route_slug)
	{
		$module_controller = "Admin\ThresholdController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
	});

	Route::group(array('prefix' => 'earnings'), function () use($route_slug)
	{
		$module_controller = "Admin\EarningsController@";		
		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => $module_controller.'index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::post('/store_request',		[	'as' =>'store_request', 				'uses' => $module_controller.'store_request']);
		Route::post('/change_status',		[	'as' =>'change_status', 				'uses' => $module_controller.'change_status']);
	});


	/*
	|
	| Freelancer Roots Start
	|
	 */
	
	/* Sub Category Route */
	Route::group(array('prefix' => 'freelancer_sub_category'), function () use($route_slug)
	{

		$module_controller = "Admin\FreelancerSubCategoryController@";		

		Route::get('/',				  		[	'as' =>$route_slug.'index', 			'uses' => 'Admin\FreelancerSubCategoryController@index']);
		Route::get('/load',		      		[	'as' =>$route_slug.'load', 				'uses' => $module_controller.'load_data']);
		Route::get('/create',		  		[	'as' =>$route_slug.'create', 			'uses' => $module_controller.'create']);
		Route::post('/store',		  		[	'as' =>$route_slug.'store', 			'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  		[	'as' =>$route_slug.'edit', 				'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  		[	'as' =>$route_slug.'update', 			'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  		[	'as' =>$route_slug.'block', 			'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  		[	'as' =>$route_slug.'unblock', 			'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  		[	'as' =>$route_slug.'delete', 			'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  		[	'as' =>$route_slug.'multi_action', 		'uses' => $module_controller.'multi_action']);
		Route::get('/activate/{id}',      	[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);
		Route::get('/deactivate/{id}',    	[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);

	});
	/* Sub Sub Category Route */

	/* Project */
	Route::group(array('prefix' => 'project'),function() use($route_slug)
	{
		$module_controller = "Admin\ProjectController@";		

		Route::get('/load_bid_data/{enc_id}', 	[	'as' 	=> $route_slug.'load_bid_data', 'uses' => $module_controller.'load_bid_data']);

		Route::get('/load_project_list/{enc_id}',[ 	'as' 	=> $route_slug.'load_project_list', 'uses' => $module_controller.'load_project_list' ]);

		Route::get('/awarded',					[ 	'as'	=> $route_slug.'awarded_project',	'uses' => $module_controller.'project_list']);

		Route::get('/in_progress',				[ 	'as' 	=> $route_slug.'awarded_project',	'uses' => $module_controller.'project_list']);

		Route::get('/completed',				[ 	'as' 	=> $route_slug.'completed',			'uses' => $module_controller.'project_list']);

		Route::get('/cancelled',				[ 	'as' 	=> $route_slug.'cancelled',			'uses' => $module_controller.'project_list']);
		
		
		Route::get('/',							[	'as'   => $route_slug.'index',			'uses' => $module_controller.'index']);
		
		Route::get('/load',						[	'as'   => $route_slug.'load_data',		'uses' => $module_controller.'load_data']);

		
		Route::get('/view/{enc_id}',			[	'as' => $route_slug.'view',				'uses'=> $module_controller.'view']);
		
		Route::get('/approve_project/{enc_id}', [   'as' => $route_slug.'approve_project', 'uses' => $module_controller.'approve_project' ]);
		
		Route::get('/reject_project/{enc_id}', 	[   'as' => $route_slug.'reject_project',  'uses' => $module_controller.'reject_project']);
		
		Route::post('/multi_action',  			[	'as' =>$route_slug.'multi_action',     'uses' => $module_controller.'multi_action']);

		Route::get('/download_document/{enc_id}',[  'as' =>$route_slug.'download_document','uses' => $module_controller.'download_document']);

		Route::get('/download_bid_document/{enc_id}', 	[ 'as' => $route_slug.'download_bid_document', 
														  'uses'=> $module_controller.'download_bid_document' ]);
		
		Route::get('/activate/{id}',      		[	'as' =>$route_slug.'activate', 			'uses' => $module_controller.'activate']);

		Route::get('/deactivate/{id}',    		[	'as' =>$route_slug.'deactivate', 		'uses' => $module_controller.'deactivate']);
		


	});
	/* Project */
	
});