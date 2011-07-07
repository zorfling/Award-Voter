<?php

namespace app\controllers;

use lithium\security\Auth;

class UsersController extends \lithium\action\Controller {

	public function login() {

		if (Auth::check('customer', $this->request)) {
			return $this->redirect('Awards::vote');
		} else if (Auth::check('admin', $this->request)) {
			return $this->redirect('Admin::round');
		}

	}

	public function logout() {
		Auth::clear('customer');
		Auth::clear('admin');
		$this->redirect('/');
	}

}