<?php
namespace App\Http\Controllers\ValidationsApi\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OffsetsRequest extends FormRequest {

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
             'client_id'=>'required|integer',
             'code'=>'required|numeric|integer',
             'cahier number'=>'required',
             'grammage'=>'required|string',
             'format'=>'required',
             'poids'=>'required',
             'category_id'=>'required|integer',
             'date'=>'',
             'equipe'=>'',
             'visa'=>'required',
		];
	}


	protected function onUpdate() {
		return [
             'client_id'=>'required|integer',
             'code'=>'required|numeric|integer',
             'cahier number'=>'required',
             'grammage'=>'required|string',
             'format'=>'required',
             'poids'=>'required',
             'category_id'=>'required|integer',
             'date'=>'',
             'equipe'=>'',
             'visa'=>'required',
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
             'client_id'=>trans('admin.client_id'),
             'code'=>trans('admin.code'),
             'cahier number'=>trans('admin.cahier number'),
             'grammage'=>trans('admin.grammage'),
             'format'=>trans('admin.format'),
             'poids'=>trans('admin.poids'),
             'category_id'=>trans('admin.category_id'),
             'date'=>trans('admin.date'),
             'equipe'=>trans('admin.equipe'),
             'visa'=>trans('admin.visa'),
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