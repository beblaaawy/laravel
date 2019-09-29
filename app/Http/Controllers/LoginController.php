<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;

class LoginController extends Controller
{

	public function show_view () {
		return view('login');
	}

    public function login_process() {

		$validate = Validator::make(request()->all(), [
			'email' => 'required|string|min:10|max:100|email|exists:users,email',
			'password' => 'required|string|min:6|max:50'
		]);

		if ($validate->fails()) {
			session()->flash('errors', $validate->errors()->toArray());
			return back();
		} else {
			$user = User::where('email', request()->email)->limit(1)->first();

			if (password_verify(request()->password, $user->password)) {
				if (empty($user->email_verified_at)) {
					session()->flash('error', 'Your email is not verified yet!');
					return back();
				}
				Auth::login($user);
				return redirect('/');
			} else {
				session()->flash('error', 'Your password is not valid!');
				return back();
			}
		}
	}
}
