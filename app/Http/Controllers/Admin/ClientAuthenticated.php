<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;


class ClientAuthenticated extends Controller {

	public function login_page() {
		return view('admin.login-client', ['title' => trans('Client.login_page')]);
	}

	public function lock_screen() {
		$Client = Client::where('email', request('email'))->first();
		auth()->logout();
		if (is_null($Client) || empty($Client)) {
			return redirect(aurl('login'));
		}
		return view('Client.lock_screen', [
			'title' => trans('Client.lock_screen'),
			'Client' => $Client,
		]);
	}

	public function login_post() {
		
	// if(!is_null(Client::where('email', request('email'))->where('active', 'activate')->get())){
        if (Auth::guard('client')->attempt(['email' => request('email'), 'password' => request('password')])) {
			
			return redirect(aurl('/'));
		} else {
			session()->flash('error', trans('Client.error_loggedin'));
			return back();
		}
	// }else{
	// 	session()->flash('error', trans('Client.not_activated'));
	// 	return back();
	// }
		
	}

	public function logout() {
		auth()->guard('client')->logout();
		return redirect(aurl('/login-client'));
	}

}