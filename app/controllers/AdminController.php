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
			$this->redirect('/users/login/');
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
					// Filter should have done this but we'll do it here for now
					$this->request->data['password'] = \lithium\util\String::hash($this->request->data['password']);
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
				// Get users
				$users = User::all(array('conditions' => array('is_admin' => false)));

				$success = false;
				if ($this->request->data) {
					$round = Round::create($this->request->data);
					$success = $round->save();

					$roundId = mysql_insert_id(Round::db());

					// Clear round users
					RoundUser::remove(array('round_id' => $roundId));

					// Add round users
					foreach ($this->request->data['round_users'] as $roundUser) {
						if (is_numeric($roundUser)) {
							$roundUserData['round_id'] = $roundId;
							$roundUserData['user_id'] = $roundUser;
							$roundUserData['weight'] = $this->request->data['round_user_weight_'.$roundUser];
							$newRoundUser = RoundUser::create($roundUserData);
							$success = $success && $newRoundUser->save();
						}
					}

					if ($success) {
						FlashMessage::write('Round added!');
					}
					$this->redirect('/admin/round/');
				}
				return compact('round', 'function', 'success', 'users');
				break;

			case 'edit':
				$roundId = (int)$this->request->params['args'][1];

				$data = Round::find('all', array('conditions' => array('round_id' => $roundId), 'limit' => 1));
				$round = $data->first();

				// Get users
				$users = User::all(array('conditions' => array('is_admin' => false)));
				$roundUsersRS = RoundUser::all(array('conditions' => array('round_id' => $roundId), 'order' => array('first_name', 'surname')));

				// Get round users into the correct format
				$roundUsers = array();
				foreach ($roundUsersRS as $roundUser) {
					$roundUsers[$roundUser->user_id] = $roundUser->weight;
				}

				$success = false;

				if ($this->request->data) {
					$success = $round->save($this->request->data);

					// Clear round users
					RoundUser::remove(array('round_id' => $roundId));

					// Add round users
					foreach ($this->request->data['round_users'] as $roundUser) {
						if (is_numeric($roundUser)) {
							$roundUserData['round_id'] = $roundId;
							$roundUserData['user_id'] = $roundUser;
							$roundUserData['weight'] = $this->request->data['round_user_weight_'.$roundUser];
							$newRoundUser = RoundUser::create($roundUserData);
							$success = $success && $newRoundUser->save();
						}
					}

					if ($success) {
						FlashMessage::write('Round updated!');
					}
					$this->redirect('/admin/round/');
				}

				$round->password = '';

				return compact('success', 'function', 'round', 'users', 'roundUsers');
				break;

			case 'delete':
				$roundId = (int)$this->request->params['args'][1];

				if ($this->request->data) {
					if ($this->request->data['round_id']) {
						$round = Round::find('all', array('conditions' => array('round_id' => (int)$this->request->data['round_id']), 'limit' => 1));
						$round->first()->delete();

						$votes = Vote::find('all', array('conditions' => array('round_id' => (int)$this->request->data['round_id'])));
						foreach($votes as $vote) {
							$vote->delete();
						}

						$users = RoundUser::find('all', array('conditions' => array('round_id' => (int)$this->request->data['round_id'])));
						foreach($users as $user) {
							$user->delete();
						}

						FlashMessage::write('Round deleted!');
						$this->redirect('/admin/round/');
					} else {
						FlashMessage::write('Check the box to delete the round');
					}
				}

				return compact('function', 'roundId');

				break;

			case 'clear':
				$roundId = (int)$this->request->params['args'][1];

				if ($this->request->data) {
					if ($this->request->data['round_id']) {
						$votes = Vote::find('all', array('conditions' => array('round_id' => (int)$this->request->data['round_id'])));

						foreach($votes as $vote) {
							$vote->delete();
						}

						FlashMessage::write('Round votes cleared!');
						$this->redirect('/admin/round/');
					} else {
						FlashMessage::write('Check the box to clear the round');
					}
				}

				return compact('function', 'roundId');

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
				$roundUsers = RoundUser::all(array('conditions' => array('round_id' => $roundId)));

				foreach ($roundUsers as $user) {
					$roundUserArray[$user->user_id]	= $user;
				}

				$hasVoted = array();

				// Get votes
				$awards = Award::all();
				foreach ($awards as $award) {
					$votesArray = array();
					$votes[$award->award_id]['title'] = $award->name;
					$votesData = Vote::all(array('conditions' => array('round_id' => $roundId, 'award_id' => $award->award_id), 'fields' => array('voter_user_id', 'votee_user_id')));

					foreach($votesData as $vote) {
						$hasVoted[$vote->voter_user_id] = 1;

						if (!isset($votesArray[$vote->votee_user_id]['votes'])) {
							$votesArray[$vote->votee_user_id]['votes'] = 1;
						} else {
							$votesArray[$vote->votee_user_id]['votes']++;
						}

						if (!isset($votesArray[$vote->votee_user_id]['weightedVotes'])) {
							$votesArray[$vote->votee_user_id]['weightedVotes'] = 1 * $roundUserArray[$vote->voter_user_id]->weight;
						} else {
							$votesArray[$vote->votee_user_id]['weightedVotes'] += (1 * $roundUserArray[$vote->voter_user_id]->weight);
						}
					}

					$votes[$award->award_id]['data'] = $votesArray;
				}

				$stillToVoteArray = array();
				foreach ($roundUsers as $roundUser) {
					if (!isset($hasVoted[$roundUser->user_id])) {
						$stillToVoteArray[] = $users[$roundUser->user_id]->getFullName();
					}
				}

				$stillToVote = implode(', ', $stillToVoteArray);

				return compact('function', 'votes', 'users', 'round', 'stillToVote');
				break;
				
			case 'comments':
				$userId = (int)$this->request->params['args'][2];
				
				$user = User::first(array('conditions' => array('id' => $userId)));
				
				$votes = Vote::all(array('conditions' => array('votee_user_id' => $userId)));
				
				return compact('function', 'roundId', 'user', 'votes');
				break;
		}
	}

}
