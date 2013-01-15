<?php
App::uses('AppModel', 'Model');
/**
 * CallsSecondStage Model
 *
 * @property Call $Call
 */
class CallsSecondStage extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'calls_second_stage';

	// function beforeSave($options) {
	// 	if (!isset($this->data['CallsSecondStage']['date'])) {
	// 		$this->data['CallsSecondStage']['date'] = date('Y-m-d');
	// 	} else {
	// 		unset($this->data['CallsSecondStage']['date']);
	// 	}
	// 	// if ($this->data['CallsSecondStage']['number_of_order'] == '') {
	// 	// 	unset($this->request->data['CallsSecondStage']);
	// 	// }
	// 	return true;
	// }
}
