<?php

namespace app\controllers;

use lithium\security\Auth;

use \app\models\Round;
use \app\models\RoundUser;
use \app\models\User;
use \app\models\Award;
use \app\models\Vote;

use li3_flash_message\extensions\storage\FlashMessage;

class AwardsController extends \lithium\action\Controller {

	protected $_user = array();

	public function __construct($config) {
		parent::__construct($config);
		$result = Auth::check('customer');
		if (!$result) {
			$this->redirect('Users::login');
		}

		$this->_user = $result;

	}

	public function index() {

	}

	public function vote() {
		// Determine current round
		//$round = Round::find('all', array('conditions' => array('round_id' => 1)));

		if ($this->request->data) {
			foreach($this->request->data as $key => $value) {
				$awardId = substr($key, strpos($key, '_')+1);
				$voteeId = $value;

				$vote = Vote::create();

				$vote->round_id = 1;
				$vote->award_id = $awardId;
				$vote->voter_user_id = $this->_user['id'];
				$vote->votee_user_id = $voteeId;

				$success = $vote->save();

				if (!$success) {
					FlashMessage::write('Error occurred whilst voting. Please try again.');
					continue;
				}
			}

			if ($success) {
				FlashMessage::write('Vote successful!');
			}
		}

		$users = User::all(array('conditions' => array('is_admin' => 0), 'order' => array('surname', 'first_name')));
		$awards = Award::all();

		return compact('users', 'awards');


	}

	public function round() {

	}
}
