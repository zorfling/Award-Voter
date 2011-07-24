<?php

namespace app\models;

class Round extends \lithium\data\Model {

	const STATUS_PENDING = -1;
	const STATUS_ACTIVE = 1;
	const STATUS_CLOSED = 2;

	protected $_meta = array('key' => 'round_id');

	public static function db() {
		return static::_connection()->connection;
	}
}