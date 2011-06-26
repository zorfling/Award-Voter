<?php

namespace app\controllers;

use \lithium\security\Auth;

class AdminController extends \lithium\action\Controller {

	public function __construct($config) {
		parent::__construct($config);

		if (!Auth::check('admin')) {
			$this->redirect('/users/login/admin/');
		}
	}

	public function index() {

	}

}
