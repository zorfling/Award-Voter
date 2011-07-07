<?php

namespace app\controllers;

use \lithium\security\Auth;
use \lithium\util\Set;
use \app\models\User;
use \app\models\Vote;
use \app\models\Award;

use li3_flash_message\extensions\storage\FlashMessage;

class AdminController extends \lithium\action\Controller {

	public function __construct($config) {
		parent::__construct($config);

		if (!Auth::check('admin')) {
			$this->redirect('/users/login/admin/');
		}
		$this->_render['layout'] = 'admin';
	}

	public function index() {

	}

	public function user($function = 'list') {
		switch (strtolower($function)) {
			case 'list':
				$data = User::all();
				break;

			case 'add':
				if ($this->request->data) {
					$user = User::create($this->request->data);
					$success = $user->save();
					if ($success) {
						FlashMessage::write('User added!');
					}
				}
				return compact('user', 'function', 'success');
				break;

			case 'edit':
				$data = User::find('all', array('conditions' => array('id' => (int)$this->request->params['args'][1]), 'limit' => 1));
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

	public function round($roundId = 1) {
		// Get votes
		$awards = Award::all();
		foreach ($awards as $award) {
			$votes[$award->award_id]['title'] = $award->name;
			$votes[$award->award_id]['data'] = Vote::all(array('conditions' => array('round_id' => $roundId, 'award_id' => $award->award_id), 'fields' => array('votee_user_id', 'count(*) as count'), 'group' => 'votee_user_id', 'order' => 'count DESC'));
		}

		$userResults = User::all();

		foreach($userResults as $user) {
			$users[$user->id] = $user->getFullName();
		}

		return compact('votes', 'users');
	}

}
