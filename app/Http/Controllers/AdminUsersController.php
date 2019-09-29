<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Validator;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index() {
    	$request = request();

		$limit = 10;
		if (!empty($request->limit) && is_numeric($request->limit) && in_array($request->limit, [10, 20, 50, 100])) {
			$limit = $request->limit;
		}

		$page = 1;
		if (!empty($request->page) && is_numeric($request->page)) {
			$page = $request->page;
		}
		// TASK
		$offset = ($page - 1) * $limit;

		// limit: 10
		// page: 1 offset: 0  >> 1  - 10
		// page: 2 offset: 10 >> 11 - 20

		$q = $request->q;

		$users = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
			->limit($limit)
			->offset($offset)
			->where('first_name', 'LIKE', '%' . $q . '%')
			->orWhere('last_name', 'LIKE', '%' . $q . '%')
			->orWhere('email', 'LIKE', '%' . $q . '%')
			->get();

    	return view('admin.users.index')->with([
    		'q' => $q,
    		'page' => $page,
    		'limit' => $limit,
    		'users' => $users,
    		'limits' => [10, 20, 50, 100],
    	]);
    }

    public function create() {
    	return view('admin.users.create', [
    		'roles' => Role::all()
    	]);
    }

    public function store() {
    	$request = request();
    	$validate = Validator::make($request->all(), [
			'first_name' => 'required|string|min:2|max:50',
			'last_name' => 'required|string|min:2|max:50',
			'email' => 'required|string|min:6|max:100|email|unique:users,email',
			'password' => 'required|string|min:6|max:50|confirmed',
			'role_id' => 'required|numeric|exists:roles,id',
    	]);

    	if ($validate->fails()) {
    		session()->flash('errors', $validate->errors()->toArray());
    		return back();
    	} else {
    		User::forceCreate([
    			'first_name' => $request->first_name,
    			'last_name' => $request->last_name,
    			'email' => $request->email,
    			'password' => password_hash($request->password, PASSWORD_DEFAULT),
    			'role_id' => $request->role_id,
    			'avatar' => 'avatar!!',
    		]);

    		session()->flash('success', 'New user has been created successfully!');
    		return redirect('/admin/users');
    	}
    }

    public function show($id) {
    	$user = User::where('id', $id)->first();

    	if ($user) {
	    	return $user;
    	} else {
    		return back();
    	}
    }

    public function update($id) {
    	$user = User::where('id', $id)->first();

    	if ($user) {
	    	return $user;
    	} else {
    		return back();
    	}
    }

    public function delete($id) {
    	$user = User::where('id', $id)->first();

    	if ($user) {
	    	return $user;
    	} else {
    		return back();
    	}
    }
}
