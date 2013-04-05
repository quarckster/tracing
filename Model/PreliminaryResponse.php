<?php
App::uses('AppModel', 'Model');
/**
 * PreliminaryResponse Model
 *
 */
class PreliminaryResponse extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'preliminary_response';

	public $belongsTo = 'SecondStage';

	public function findParentId($second_stage_id) {
		return $this->SecondStage->field('PreliminaryResponse_id', array('id' => $second_stage_id));
	}

	function afterFind($results) {
		foreach ($results as $key => $val) {
			if (isset($val['PreliminaryResponse']['answer_date'])) {
				$timestamp = strtotime($results[$key]['PreliminaryResponse']['answer_date']);
				$results[$key]['PreliminaryResponse']['answer_date'] = date('d.m.Y', $timestamp);
			}
			if (isset($val['PreliminaryResponse']['send_date'])) {
				$timestamp = strtotime($results[$key]['PreliminaryResponse']['send_date']);
				$results[$key]['PreliminaryResponse']['send_date'] = date('d.m.Y', $timestamp);
			}
		}
		return $results;
	}
	public function beforeSave($options) {
		// debug($this->data);
		if (!empty($this->data['PreliminaryResponse']['answer_date'])) {
			$this->data['PreliminaryResponse']['answer_date'] = date('Y-m-d', strtotime($this->data['PreliminaryResponse']['answer_date']));
		}
		if (!empty($this->data['PreliminaryResponse']['send_date'])) {
			$this->data['PreliminaryResponse']['send_date'] = date('Y-m-d', strtotime($this->data['PreliminaryResponse']['send_date']));
		}
		return true;
	}
}
