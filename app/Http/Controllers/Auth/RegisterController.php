<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\Traits\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = RouteServiceProvider::HOME;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		$validator = Validator::make(
			$data,
			// Rules
			[
				'name' => ['required', 'string', 'max:100'],
				'email' => ['required', 'string', 'max:200', 'email', 'unique:users'],
				'password' => ['required', 'string', 'min:8', 'confirmed'],
			],

			// Messages
			[
				'required'  => 'Поле :attribute не заполнено.',
				'string'  => 'Данные в поле :attribute должны быть строкой.',
				'max'  => 'Превышена максимальная длина строки в поле :attribute.',
				'email.email' => 'Значение в поле :attribute не является корректным.',
				'email.unique' => 'Такой адрес электронной почты уже существует.',
				'password.min'  => 'Кличество символов в поле :attribute должно быть не меньше 8.',
				'confirmed' => 'Не верное повторение пароля.',
			],

			// Attributes
			[
				'name' => 'имя',
				'email' => 'адрес электронной почты',
				'password' => 'пароль',
			],
		);

		if ($validator->fails()) {
			session()->flash('register_error');
		}

		return $validator;
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\Models\User
	 */
	protected function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
		]);
	}
}
