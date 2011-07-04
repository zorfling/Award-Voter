<?php

namespace app\controllers;

use \lithium\security\Auth;
use \lithium\util\Set;
use \app\models\User;

use li3_flash_message\extensions\storage\FlashMessage;

class AdminController extends \lithium\action\Controller {

	public function __construct($config) {
		parent::__construct($config);

		if (!Auth::check('admin')) {
			$this->redirect('/users/login/admin/');
		}
	}

	public function index() {

	}

	public function user($function = 'list') {
		switch (strtolower($function)) {
			case 'list':
				$data = User::all();
				break;

			case 'add':

				break;

			case 'edit':
				$data = User::find('all', array('conditions' => array('id' => 1), 'limit' => 1));
				$user = $data->first();

				$success = false;

				if ($this->request->data) {

					if ($this->request->data['password'] == '') {
						$this->request->data['password'] = $user->password;
					} else {
						// Filter should have done this but we'll do it here for now
						$this->request->data['password'] = \lithium\util\String::hash($this->request->data['password']);
					}

					$success = $user->save($this->request->data);
					if ($success) {
						FlashMessage::write('User updated!');
					}
				}

				$user->password = '';

				return compact('success', 'function', 'user');
				break;

			case 'delete':

				break;
		}

		return compact('function', 'data');
	}

}
