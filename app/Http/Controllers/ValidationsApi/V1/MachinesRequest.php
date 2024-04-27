<?php
namespace App\Http\Controllers\ValidationsApi\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MachinesRequest extends FormRequest {

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
             'code'=>'required',
             'date'=>'required',
             'capacite production'=>'required|string',
             'fiche'=>'required',
             'date finproduction'=>'required',
             'photo'=>'required|image',
		];
	}


	protected function onUpdate() {
		return [
             'code'=>'required',
             'date'=>'required',
             'capacite production'=>'required|string',
             'fiche'=>'required',
             'date finproduction'=>'required',
             'photo'=>'required|image',
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
             'code'=>trans('admin.code'),
             'date'=>trans('admin.date'),
             'capacite production'=>trans('admin.capacite production'),
             'fiche'=>trans('admin.fiche'),
             'date finproduction'=>trans('admin.date finproduction'),
             'photo'=>trans('admin.photo'),
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