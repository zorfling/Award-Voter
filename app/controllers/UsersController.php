<?php

namespace app\controllers;

use lithium\security\Auth;

class UsersController extends \lithium\action\Controller {

	public function login() {
		if (Auth::check('customer', $this->request)) {
			return $this->redirect('/');
		}
	}

	public function logout() {
		Auth::clear('customer');
		$this->redirect('/');
	}

}