<?php

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
	 * login user and redirect to logged in landing page
	 */
	public function postLogin()
	{
		echo 'login procedure';
		return $this->getLoginForm();
	}

	/**
	 * register user and redirect to login form / or login instantly
	 */
	public function postRegister()
	{
		echo "register procedure";
		return $this->getRegisterForm();
	}
}