<?php

use \Illuminate\Support\MessageBag;

/**
 * Class UserController
 */
class UserController extends BaseController
{
	/**
	 * show login form
	 *
	 * @return mixed
	 */
	public function getLoginForm()
	{
		return View::make('user.login');
	}

	/**
	 * show register form
	 *
	 * @return mixed
	 */
	public function getRegisterForm()
	{
		return View::make('user.register');
	}

	/**
	 * logout the current user and redirect to the home page
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getLogout()
	{
		Auth::logout();
		return Redirect::route('user.login.form');
	}

	/**
	 * login user and redirect to logged in landing page
	 */
	public function postLogin()
	{
		if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')], (bool) Input::get('rememberMe'))) {
			return Redirect::route('deliveries.active');
		} else {
			$errors = new MessageBag(array('Login failed.'));
			return Redirect::back()
				->withInput()
				->with('errors', $errors);
		}
	}

	/**
	 * register user and redirect to login form / or login instantly
	 */
	public function postRegister()
	{
		$email = Input::get('email');
		$password = Input::get('password');

		$validator = $this->getUserDataValidator($email, $password, Input::get('password_confirmation'));
		$messageBag = $validator->getMessageBag();

		if ($validator->passes()) {
			$user = new User();
			try {
				$user->register($email, $password);
				$successMessageBag = new MessageBag();
				$successMessageBag->add('success', 'Registration complete!');

				Log::info('Registration successful of email: ' . $email);

				// TODO: Implement login

				return Redirect::route('user.register.form') // TODO: Change to redirect to overview page
					->with('messages', $successMessageBag);
			} catch (\LogicException $ex) {
				$messageBag->add('user_exists', 'Could not register user, seems to be already existing.');
				Log::error('User tried to register although already having id #' . $user->id . '.');
			}
		}

		Log::info('Errors occured during registration of email: ' . $email);
		return Redirect::route('user.register.form')
			->withErrors($messageBag)
			->withInput(Input::all());
	}

	/**
	 * Validates user data (email and password) for both login and registration.
	 *
	 * @param string $email
	 * @param string $password
	 * @param string $passwordConfirmation [optional] In case the user is registering and should confirm his password.
	 * @return \Illuminate\Validation\Validator
	 */
	private function getUserDataValidator($email, $password, $passwordConfirmation = null)
	{
		Validator::extend('ffhemail', function($attribute, $value, $parameters)
		{
			return (strpos($value, '@fashionforhome') !== false);
		});

		$data = array(
			'email' => $email,
			'password' => $password,
		);

		$rules = array(
			'email' => 'required|email|ffhemail|unique:users',
			'password' => 'required|min:8',
		);

		if ($passwordConfirmation !== null) {
			$data['password_confirmation'] = $passwordConfirmation;
			$rules['password'] .= '|confirmed';
		}

		return Validator::make($data, $rules);
	}
}