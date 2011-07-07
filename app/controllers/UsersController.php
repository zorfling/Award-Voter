<?php

namespace app\controllers;

use lithium\security\Auth;

class UsersController extends \lithium\action\Controller {

	public function login($type = 'customer') {

		if (Auth::check($type, $this->request)) {
			if ($type == 'customer') {
				return $this->redirect('/Awards/Vote/');
			} else {
				return $this->redirect('/Admin/User/');
			}
		}

	}

	public function logout($type = 'customer') {
		Auth::clear($type);
		$this->redirect('/');
	}

}