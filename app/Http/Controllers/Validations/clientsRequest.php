<?php
namespace App\Http\Controllers\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class clientsRequest extends FormRequest {

	/**
	 * Baboon Script By [it v 1.6.40]
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Baboon Script By [it v 1.6.40]
	 * Get the validation rules that apply to the request.
	 *
	 * @return array (onCreate,onUpdate,rules) methods
	 */
	protected function onCreate() {
		return [
             'first_name'=>'required|string',
             'second_name'=>'required|string',
             'grade_id'=>'required|integer',
             'type_id'=>'required|integer',
             'password'=>'required|string',
             'username'=>'required|string',
             'direction_id'=>'required|string',
             'active'=>'',
             'photo'=>'required|image',
             'email'=>'required|string',
		];
	}

	protected function onUpdate() {
		return [
             'first_name'=>'required|string',
             'second_name'=>'required|string',
             'grade_id'=>'required|integer',
             'type_id'=>'required|integer',
             'password'=>'required|string',
             'username'=>'required|string',
             'direction_id'=>'required|string',
             'active'=>'',
             'photo'=>'required|image',
             'email'=>'required|string',
		];
	}

	public function rules() {
		return request()->isMethod('put') || request()->isMethod('patch') ?
		$this->onUpdate() : $this->onCreate();
	}


	/**
	 * Baboon Script By [it v 1.6.40]
	 * Get the validation attributes that apply to the request.
	 *
	 * @return array
	 */
	public function attributes() {
		return [
             'first_name'=>trans('admin.first_name'),
             'second_name'=>trans('admin.second_name'),
             'grade_id'=>trans('admin.grade_id'),
             'type_id'=>trans('admin.type_id'),
             'password'=>trans('admin.password'),
             'username'=>trans('admin.username'),
             'direction_id'=>trans('admin.direction_id'),
             'active'=>trans('admin.active'),
             'photo'=>trans('admin.photo'),
             'email'=>trans('admin.email'),
		];
	}

	/**
	 * Baboon Script By [it v 1.6.40]
	 * response redirect if fails or failed request
	 *
	 * @return redirect
	 */
	public function response(array $errors) {
		return $this->ajax() || $this->wantsJson() ?
		response([
			'status' => false,
			'StatusCode' => 422,
			'StatusType' => 'Unprocessable',
			'errors' => $errors,
		], 422) :
		back()->withErrors($errors)->withInput(); // Redirect back
	}



}