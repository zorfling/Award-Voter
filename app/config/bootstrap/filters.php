<?php
use app\models\User;

User::applyFilter('save', function($self, $params, $chain){
	$record = $params['entity'];
	$record->password = \lithium\util\String::hash($record->password);

	if (!empty($params['data'])) {
		$record->set($params['data']);
	}
	$params['entity'] = $record;
	return $chain->next($self, $params, $chain);
});

use app\models\Vote;

Vote::applyFilter('save', function($self, $params, $chain){
	$record = $params['entity'];
	$record->created_date = date('c');

	if (!empty($params['data'])) {
		$record->set($params['data']);
	}
	$params['entity'] = $record;
	return $chain->next($self, $params, $chain);
});

