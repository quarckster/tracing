<?php
App::uses('AppModel', 'Model');
/**
 * Result Model
 *
 */
class Result extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'result';
	
	public $belongsTo = 'SecondStage';

	function afterFind($results) {
		foreach ($results as $key => $val) {
			if (isset($results['answer_date'])) {
				$timestamp = strtotime($results['answer_date']);
				$results['answer_date'] = date('d.m.Y', $timestamp);
			}
			if (isset($results['send_date'])) {
				$timestamp = strtotime($results['send_date']);
				$results['send_date'] = date('d.m.Y', $timestamp);
			}
			if (isset($results['0']['Result']['send_date'])) {
				$timestamp = strtotime($results['0']['Result']['send_date']);
				$results['0']['Result']['send_date'] = date('d.m.Y', $timestamp);
			}
		}
		return $results;
	}

	public function beforeSave($options) {
		// debug($this->data);
		if (!empty($this->data['Result']['answer_date'])) {
			$this->data['Result']['answer_date'] = date('Y-m-d', strtotime($this->data['Result']['answer_date']));
		}
		if (!empty($this->data['Result']['send_date'])) {
			$this->data['Result']['send_date'] = date('Y-m-d', strtotime($this->data['Result']['send_date']));
		}
		return true;
	}
}
