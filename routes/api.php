<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
// your api is integerated but if you want reintegrate no problem
// to configure jwt-auth visit this link https://jwt-auth.readthedocs.io/en/docs/

Route::group(['middleware' => ['ApiLang', 'cors'], 'prefix' => 'v1', 'namespace' => 'Api\V1'], function () {

	Route::get('/', function () {

	});
	// Insert your Api Here Start //
	Route::group(['middleware' => 'guest'], function () {
		Route::post('login', 'Auth\AuthAndLogin@login')->name('api.login');
		Route::post('register', 'Auth\Register@register')->name('api.register');
	});

	Route::group(['middleware' => 'auth:api'], function () {
		Route::get('account', 'Auth\AuthAndLogin@account')->name('api.account');
		Route::post('logout', 'Auth\AuthAndLogin@logout')->name('api.logout');
		Route::post('refresh', 'Auth\AuthAndLogin@refresh')->name('api.refresh');
		Route::post('me', 'Auth\AuthAndLogin@me')->name('api.me');
		Route::post('change/password', 'Auth\AuthAndLogin@change_password')->name('api.change_password');
		//Auth-Api-Start//
		Route::apiResource("user","UserApi", ["as" => "api.user"]); 
			Route::post("user/multi_delete","UserApi@multi_delete"); 
			Route::apiResource("client","ClientApi", ["as" => "api.client"]); 
			Route::post("client/multi_delete","ClientApi@multi_delete"); 
			Route::apiResource("clients","ClientsApi", ["as" => "api.clients"]); 
			Route::post("clients/multi_delete","ClientsApi@multi_delete"); 
			Route::apiResource("grades","GradesApi", ["as" => "api.grades"]); 
			Route::post("grades/multi_delete","GradesApi@multi_delete"); 
			Route::apiResource("types","TypesApi", ["as" => "api.types"]); 
			Route::post("types/multi_delete","TypesApi@multi_delete"); 
			Route::apiResource("categories","CategoriesApi", ["as" => "api.categories"]); 
			Route::post("categories/multi_delete","CategoriesApi@multi_delete"); 
			Route::apiResource("directions","DirectionsApi", ["as" => "api.directions"]); 
			Route::post("directions/multi_delete","DirectionsApi@multi_delete"); 
			Route::apiResource("responses","ResponsesApi", ["as" => "api.responses"]); 
			Route::post("responses/multi_delete","ResponsesApi@multi_delete"); 
			Route::apiResource("decesions","DecesionsApi", ["as" => "api.decesions"]); 
			Route::post("decesions/multi_delete","DecesionsApi@multi_delete"); 
			Route::apiResource("machines","MachinesApi", ["as" => "api.machines"]); 
			Route::post("machines/multi_delete","MachinesApi@multi_delete"); 
			Route::apiResource("offsets","OffsetsApi", ["as" => "api.offsets"]); 
			Route::post("offsets/multi_delete","OffsetsApi@multi_delete"); 
			//Auth-Api-End//
	});
	// Insert your Api Here End //
});