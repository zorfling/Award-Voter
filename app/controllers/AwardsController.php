<?php

namespace app\controllers;

use lithium\security\Auth;

class AwardsController extends \lithium\action\Controller {

	public function __construct($config) {
		parent::__construct($config);

		if (!Auth::check('customer')) {
			$this->redirect('Users::login');
		}
	}

	public function index() {

	}

	public function vote() {

	}

	public function view() {

	}
}
