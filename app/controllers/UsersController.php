<?php

namespace app\controllers;

use lithium\security\Auth;

class UsersController extends \lithium\action\Controller {

	public function login($type = 'customer') {

		if (Auth::check($type, $this->request)) {
			return $this->redirect('/');
		}
	}

	public function logout($type = 'customer') {
		Auth::clear($type);
		$this->redirect('/');
	}

}