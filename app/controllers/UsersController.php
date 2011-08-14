<?php

namespace app\controllers;

use lithium\security\Auth;

use li3_flash_message\extensions\storage\FlashMessage;

use \app\models\User;

class UsersController extends \lithium\action\Controller {

	public function login() {

		if (Auth::check('frontend', $this->request)) {
			return $this->redirect('Awards::vote');
		} else if (Auth::check('admin', $this->request)) {
			return $this->redirect('Admin::round');
		}

		if ($this->request->data) {
			FlashMessage::write('Unable to login. Please try again.');
		}
	}

	public function logout() {
		Auth::clear('frontend');
		Auth::clear('admin');
		$this->redirect('/');
	}

	public function password() {
		$user = Auth::check('frontend');

		if (!$user) {
			$this->redirect('users::login');
		}


		$user = User::find('all', array('conditions' => array('id' => $user['id'])));

		$user = $user->First();

		if ($this->request->data) {
			if ($this->request->data['password'] == $this->request->data['password_confirm']) {
				// Filter should have done this but we'll do it here for now
				$this->request->data['password'] = \lithium\util\String::hash($this->request->data['password']);
				$success = $user->save($this->request->data);
				if ($success) {
					FlashMessage::write('Password updated!');
				}
				$this->redirect('awards::vote');
			} else {
				FlashMessage::write("Passwords don't match");
				$this->redirect('users::password');
			}
		}
	}

}