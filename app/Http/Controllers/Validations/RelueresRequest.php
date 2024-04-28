<?php
namespace App\Http\Controllers\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RelueresRequest extends FormRequest {

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
             'user_id'=>'required|integer',
             'code'=>'required|string',
             'format'=>'required|string',
             'poids'=>'required|string',
             'category_id'=>'required|integer',
             'decesion_id'=>'required|integer',
             'machine_id'=>'required|integer',
             'date'=>'sometimes|required|string',
             'equipe'=>'required|string',
		];
	}

	protected function onUpdate() {
		return [
             'user_id'=>'required|integer',
             'code'=>'required|string',
             'format'=>'required|string',
             'poids'=>'required|string',
             'category_id'=>'required|integer',
             'decesion_id'=>'required|integer',
             'machine_id'=>'required|integer',
             'date'=>'sometimes|required|string',
             'equipe'=>'required|string',
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
             'user_id'=>trans('admin.user_id'),
             'code'=>trans('admin.code'),
             'format'=>trans('admin.format'),
             'poids'=>trans('admin.poids'),
             'category_id'=>trans('admin.category_id'),
             'decesion_id'=>trans('admin.decesion_id'),
             'machine_id'=>trans('admin.machine_id'),
             'date'=>trans('admin.date'),
             'equipe'=>trans('admin.equipe'),
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