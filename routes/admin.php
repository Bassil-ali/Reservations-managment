<?php
use Illuminate\Support\Facades\Route;

\L::Panel(app('admin'));///SetLangredirecttoadmin
\L::LangNonymous();//RunRouteLang'namespace'=>'Admin',

Route::group(['prefix'=>app('admin'),'middleware'=>'Lang'],function(){
	Route::get('lock/screen','Admin\AdminAuthenticated@lock_screen');
	Route::get('theme/{id}','Admin\Dashboard@theme');
	Route::group(['middleware'=>'admin_guest'],function(){

		Route::get('login','Admin\AdminAuthenticated@login_page');
		Route::post('login','Admin\AdminAuthenticated@login_post');
		Route::view('forgot/password','admin.forgot_password');

		Route::post('reset/password','Admin\AdminAuthenticated@reset_password');
		Route::get('password/reset/{token}','Admin\AdminAuthenticated@reset_password_final');
		Route::post('password/reset/{token}','Admin\AdminAuthenticated@reset_password_change');
	});

	Route::view('need/permission','admin.no_permission');

	Route::group(['middleware'=>'admin:admin'],function(){
		if(class_exists(\UniSharp\LaravelFilemanager\Lfm::class)){
			Route::group(['prefix'=>'filemanager'],function(){
				\UniSharp\LaravelFilemanager\Lfm::routes();
			});
		}

		////////AdminRoutes/*Start*///////////////
		Route::get('/','Admin\Dashboard@home');
		Route::any('logout','Admin\AdminAuthenticated@logout');
		Route::get('account','Admin\AdminAuthenticated@account');
		Route::post('account','Admin\AdminAuthenticated@account_post');
		Route::resource('settings','Admin\Settings');
		Route::resource('admingroups','Admin\AdminGroups');
		Route::post('admingroups/multi_delete','Admin\AdminGroups@multi_delete');
		Route::resource('admins','Admin\Admins');
		Route::post('admins/multi_delete','Admin\Admins@multi_delete');
		Route::resource('user','User\User');
		Route::post('user/multi_delete','User\User@multi_delete');
		
		
		
		
		Route::resource('clients','Admin\clients'); 
		Route::post('clients/multi_delete','Admin\clients@multi_delete'); 
		Route::resource('grades','Admin\Grades'); 
		Route::post('grades/multi_delete','Admin\Grades@multi_delete'); 
		Route::resource('types','Admin\Types'); 
		Route::post('types/multi_delete','Admin\Types@multi_delete'); 
		Route::resource('categories','Admin\Categories'); 
		Route::post('categories/multi_delete','Admin\Categories@multi_delete'); 
		Route::resource('directions','Admin\Directions'); 
		Route::post('directions/multi_delete','Admin\Directions@multi_delete'); 
		Route::resource('responses','Admin\Responses'); 
		Route::post('responses/multi_delete','Admin\Responses@multi_delete'); 
		Route::resource('decesions','Admin\Decesions'); 
		Route::post('decesions/multi_delete','Admin\Decesions@multi_delete'); 
		Route::resource('machines','Admin\Machines'); 
		Route::post('machines/multi_delete','Admin\Machines@multi_delete'); 
		Route::resource('offsets','Admin\Offsets'); 
		Route::post('offsets/multi_delete','Admin\Offsets@multi_delete'); 
		////////AdminRoutes/*End*///////////////
	});

});