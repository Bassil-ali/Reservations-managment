<?php
namespace App\Http\Controllers\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookMachinesRequest extends FormRequest {

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
             'client_id'=>'required',
             'machine_id'=>'required',
             'question_1'=>'required|string',
             'answer'=>'in:Yes,No,Empty',
             'Document_number'=>'required',
             'isAnswer'=>'sometimes|integer',
             'date'=>'required',
             'team_number'=>'required',
		];
	}

	protected function onUpdate() {
		return [
             'client_id'=>'sometimes',
             'machine_id'=>'sometimes',
             'question_1'=>'required|string',
             'answer'=>'in:Yes,No,Empty',
             'Document_number'=>'required',
             'isAnswer'=>'sometimes|integer',
             'date'=>'required',
             'team_number'=>'required',
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
             'machine_id'=>trans('admin.machine_id'),
             'question_1'=>trans('admin.question_1'),
             'answer'=>trans('admin.answer'),
             'Document_number'=>trans('admin.Document_number'),
             'isAnswer'=>trans('admin.isAnswer'),
             'date'=>trans('admin.date'),
             'team_number'=>trans('admin.team_number'),
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