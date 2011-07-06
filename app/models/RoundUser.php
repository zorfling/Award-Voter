<?php

namespace app\models;

class RoundUser extends \lithium\data\Model {

	protected $_meta = array('key' => 'round_id');

	public $belongsTo = array(
		'Round' => array(
			'class' => 'Round',
			'key'	=> 'round_id'
		)
	);

}
