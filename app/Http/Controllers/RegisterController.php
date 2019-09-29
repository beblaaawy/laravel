<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show_view() {
    	return view('register');
    }

    public function process() {
		// validate user data
		// save avatar into storage
		// generate verify token
		// insert user data in database
		// send an email to user to verify his email

		$request = request();

		$validate = Validator::make($request->all(), [
			'first_name' => 'required|string|min:2|max:50',
			'last_name' => 'required|string|min:2|max:50',
			'email' => 'required|string|min:10|max:100|email|unique:users,email',
			'password' => 'required|string|min:6|max:50|confirmed',
			'role_id' => 'required|numeric|in:2,3',
			'gender' => 'required|string|in:male,female',
			'age' => 'required|string|date',
			'avatar' => 'required|file|image'
		]);

		if ($validate->fails()) {
			session()->flash('errors', $validate->errors()->toArray());
			return back();
		} else {
			$avatar = $request->file('avatar')->store('public/avatars');
			$avatar = str_replace('public', '/storage', $avatar);

			$token = str_random(100);

			User::forceCreate([
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'email' => $request->email,
				'password' => password_hash($request->password, PASSWORD_DEFAULT),
				'role_id' => $request->role_id,
				'email_verify_token' => $token,
				'gender' => $request->gender,
				'age' => $request->age,
				'avatar' => $avatar,
			]);

			// $user = new User;
			// $user->first_name = $request->first_name;
			// $user->last_name = $request->last_name;
			// $user->email = $request->email;
			// //
			// $user->save();

			$name = ucwords($request->first_name . ' ' . $request->last_name);

			Mail::send('verify_email', [
				'token' => $token,
				'name' => $name
			], function($mail) use($request){
				$mail->to($request->email);
				$mail->subject('CoursesHUB | Verify email');
			});

			session()->flash('success', 'You have registered successfully, please login!');
			return redirect('/login');
		}

    }
}
