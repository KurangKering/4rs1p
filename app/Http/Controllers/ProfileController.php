<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Facades\Storage;
use Hash;
use Image;
use File;
class ProfileController extends Controller
{
	public function __construct()
	{
		
	}
	public function index() {
		$user = \Auth::check() ? \Auth::user() : '';
		return view('profile.index', compact('user'));
	}


	public function update(Request $request)
	{

		$user = User::find(\Auth::user()->id);
		$this->validate($request, [
			'name' => 'required',
			'username' => 'required||unique:users,username,'.$user->id,
			'email' => 'required|email|unique:users,email,'.$user->id,
			'password' => 'same:confirm-password',
			
		]);

		
		$input = ($request->all());
		if(!empty($input['password'])){ 
			$input['password'] = Hash::make($input['password']);
		}else{
			$input = array_except($input,array('password'));    
		}
		$user->update($input);
		return back();

	}
}
