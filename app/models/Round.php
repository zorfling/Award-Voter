<?php

namespace app\models;

class Round extends \lithium\data\Model {

	protected $_meta = array('key' => 'round_id');

	public $hasMany = array(
		'RoundUsers' => array(
			'class' => 'RoundUsers',
			'key'	=> 'round_id',
			'keys'	=> array('round_id' => 'round_id')
		)
	);

}