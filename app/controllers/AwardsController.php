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
		$result = Auth::check('frontend');
		if (!$result) {
			$this->redirect('users::login');
		}

		$this->_user = $result;

	}

	public function index() {

	}

	public function vote($roundId = null) {
		$success = false;

		// Determine current round
		$round = Round::find('first', array('conditions' => array('round_status' => Round::STATUS_ACTIVE, 'round_date' => array(">=" => date('Y-m-d 00:00:00')))));
		
		if (!$roundId && $round != null) $roundId = $round->round_id;
		
		if ($roundId) {

			if ($this->request->data) {
				foreach($this->request->data as $key => $value) {
					// Make sure it's actually the vote
					if (strpos($key, 'award') !== false) {
						
						$awardId = substr($key, strpos($key, '_')+1);
						$voteeId = $value;
						$voterId = $this->_user['id'];
						$comments = $this->request->data['comments_'.$awardId];
			
						// Check if this user has voted
						$result = Vote::count(array(
							'conditions' => array(
								'round_id' => $roundId,
								'award_id' => $awardId,
								'voter_user_id' => $voterId
							)));
						if ($result > 0) {
							FlashMessage::write("You've already voted for this round!");
							break;
						}
						
						if ($voterId == $voteeId) {
							FlashMessage::write("You cannot vote for yourself!");
							break;						
						}
			
			
						$vote = Vote::create();
			
						$vote->round_id = $roundId;
						$vote->award_id = $awardId;
						$vote->voter_user_id = $voterId;
						$vote->votee_user_id = $voteeId;
						$vote->comments = $comments;
			
						$success = $vote->save();
			
						if (!$success) {
							FlashMessage::write('Error occurred whilst voting. Please try again.');
							continue;
						}
					}
				}
		
				if ($success) {
					FlashMessage::write('Vote successful!');
				}
			}
		
			$roundUsers = RoundUser::find('all', array('conditions' => array('round_id' => $roundId)));
		
			foreach ($roundUsers as $roundUser) {
				if ($roundUser->user_id != $this->_user['id']) {
					$userIds[] = $roundUser->user_id;
				}
			}
		
			$users = User::all(array('conditions' => array('is_admin' => 0, 'id' => $userIds), 'order' => array('first_name', 'surname')));
			$awards = Award::all();
		} else {
			$round = null;
			$users = null;
			$awards = null;
		}
		
		return compact('users', 'awards', 'round');
	}

	public function round() {
	}
}
