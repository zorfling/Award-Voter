<?php

namespace app\controllers;

use \lithium\security\Auth;
use \lithium\util\Set;
use \app\models\User;
use \app\models\Vote;
use \app\models\Award;
use \app\models\Round;
use \app\models\RoundUser;

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

	public function round($function = 'list', $roundId = 1) {
		switch (strtolower($function)) {
			default:
			case 'list':
				$rounds = Round::all();
				return compact('function', 'rounds');
				break;

			case 'add':
				if ($this->request->data) {
					$round = Round::create($this->request->data);
					$success = $round->save();
					if ($success) {
						FlashMessage::write('Round added!');
					}
					$this->redirect('/admin/round/');
				}
				return compact('round', 'function', 'success');
				break;

			case 'edit':
				$data = Round::find('all', array('conditions' => array('round_id' => (int)$this->request->params['args'][1]), 'limit' => 1));
				$round = $data->first();

				$success = false;

				if ($this->request->data) {

					$success = $round->save($this->request->data);
					if ($success) {
						FlashMessage::write('Round updated!');
					}
					$this->redirect('/admin/round/');
				}

				$round->password = '';

				return compact('success', 'function', 'round');
				break;

			case 'delete':
				$round = Round::find('all', array('conditions' => array('round_id' => (int)$this->request->params['args'][1]), 'limit' => 1));
				$round->first()->delete();

				FlashMessage::write('Round deleted!');
				$this->redirect('/admin/round/');
				break;

			case 'results':
				// Get round
				$round = Round::all(array('conditions' => array('round_id' => $roundId)));
				$round = $round->First();

				// Users
				$usersAll = User::all();

				foreach($usersAll as $user) {
					$users[$user->id] = $user;
				}

				// Round Users
				$roundUsers = RoundUser::all();

				foreach ($roundUsers as $user) {
					$roundUserArray[$user->user_id]	= $user->weight;
				}

				// Get votes
				$awards = Award::all();
				foreach ($awards as $award) {
					$votes[$award->award_id]['title'] = $award->name;
					$votesData = Vote::all(array('conditions' => array('round_id' => $roundId, 'award_id' => $award->award_id), 'fields' => array('voter_user_id', 'votee_user_id')));

					foreach($votesData as $vote) {
						if (!isset($votesArray[$vote->votee_user_id]['votes'])) {
							$votesArray[$vote->votee_user_id]['votes'] = 1;
						} else {
							$votesArray[$vote->votee_user_id]['votes']++;
						}

						if (!isset($votesArray[$vote->votee_user_id]['weightedVotes'])) {
							$votesArray[$vote->votee_user_id]['weightedVotes'] = 1 * $roundUserArray[$vote->voter_user_id];
						} else {
							$votesArray[$vote->votee_user_id]['weightedVotes'] += (1 * $roundUserArray[$vote->voter_user_id]);
						}
					}



					$votes[$award->award_id]['data'] = $votesArray;
				}

				return compact('function', 'votes', 'users', 'round');
				break;
		}
	}

}
