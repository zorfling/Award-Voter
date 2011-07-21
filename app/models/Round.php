<?php

namespace app\models;

class Round extends \lithium\data\Model {

	protected $_meta = array('key' => 'round_id');

	public static function db() {
		return static::_connection()->connection;
	}
}