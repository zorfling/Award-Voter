<?php
namespace app\models;

class User extends \lithium\data\Model {

	public function getFullName($record) {
		return $record->first_name.' '.$record->surname;
	}

}
