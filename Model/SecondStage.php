<?php
App::uses('AppModel', 'Model');
/**
 * SecondStage Model
 *
 * @property Result $Result
 * @property PreliminaryResponse $PreliminaryResponse
 */
class SecondStage extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'second_stage';
	var $actsAs = array('Search.Searchable');
	var $validate = array(
		'SecondStage_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Call' => array(
			'className' => 'Call',
			'foreignKey' => 'call_id'
		)
	);

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Result' => array(
			'className' => 'Result',
			'foreignKey' => 'second_stage_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PreliminaryResponse' => array(
			'className' => 'PreliminaryResponse',
			'foreignKey' => 'second_stage_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	var $filterArgs = array(
		array('name' => 'order_number', 'type' => 'value'),
		array('name' => 'filter', 'type' => 'subquery', 'method' => 'filterOrderIn', 'field' => 'SecondStage.id'),
		array('name' => 'order_in', 'type' => 'value'),
		array('name' => 'category', 'type' => 'value')
	);

	public function filterOrderIn($data = array()) {
		if ($data['filter'] == 'not_closed') {
			// $query = $this->getQuery('all',	array(
			// 		'recursive' => -1,
			// 		'conditions' => array('Result.id' => null),
			// 		'joins' => array(array(
			// 			'table' => 'result',
			// 			'alias' => 'Result',
			// 			'type' => 'LEFT',
			// 			'conditions' => array('SecondStage.id = Result.second_stage_id')
			// 			)
			// 		),
			// 		'fields' => array('SecondStage.id')
			// 	)
			// );
			return 'SELECT `SecondStage`.`id` FROM `tracing2`.`second_stage` AS `SecondStage` LEFT JOIN `tracing2`.`result` AS `Result` ON (`Result`.`second_stage_id` = `SecondStage`.`id`) WHERE `Result`.`id` IS NULL';
		}
		if ($data['filter'] == 'without_cis') {
			// $query = $this->getQuery('all', array(
			// 	'fields' => array('SecondStage.id'),
			// 	'recursive' => 0,
			// 	'conditions' => array('OR' => array('PreliminaryResponse.cis' => 0, 'Result.cis' => 0)),
			// 	'joins' => array(array(
			// 			'table' => 'result',
			// 			'alias' => 'Result',
			// 			'type' => 'LEFT',
			// 			'conditions' => array('SecondStage.id = Result.second_stage_id')
			// 			), array(
			// 			'table' => 'preliminary_response',
			// 			'alias' => 'PreliminaryResponse',
			// 			'type' => 'LEFT',
			// 			'conditions' => array('SecondStage.id = PreliminaryResponse.second_stage_id')
			// 			)
			// 		)
			// 	)
			// );
			// return $query;
			return 'SELECT `SecondStage`.`id` FROM `tracing2`.`second_stage` AS `SecondStage`  LEFT JOIN `tracing2`.`result` AS `Result` ON (`Result`.`second_stage_id` = `SecondStage`.`id`)LEFT JOIN `tracing2`.`preliminary_response` AS `PreliminaryResponse` ON (`PreliminaryResponse`.`second_stage_id` = `SecondStage`.`id`) WHERE (`PreliminaryResponse`.`cis` = 0 OR `Result`.`cis` = 0) GROUP BY `SecondStage`.`id`';
		}
	}

	public function afterFind($results) {
		foreach ($results as $key => $val) {
			if (isset($val['SecondStage']['date'])) {
				$timestamp = strtotime($results[$key]['SecondStage']['date']);
				$results[$key]['SecondStage']['date'] = date('d.m.Y', $timestamp);
			}
			if (isset($val['Result']['answer_date'])) {
				$timestamp = strtotime($results[$key]['Result']['answer_date']);
				$results[$key]['Result']['answer_date'] = date('d.m.Y', $timestamp);
			}
		}
		return $results;
	}

	public function beforeSave($options) {
		if (!empty($this->data['SecondStage']['date'])) {
			$this->data['SecondStage']['date'] = date('Y-m-d', strtotime($this->data['SecondStage']['date']));
		}
		if (!empty($this->data['SecondStage']['answer_date'])) {
			$this->data['SecondStage']['answer_date'] = date('Y-m-d', strtotime($this->data['SecondStage']['answer_date']));
		}
		return true;
	}

	public function getStatsData($start, $end) {
		$stats['КЦ'] = $this->find('count', array('conditions' => array('SecondStage.date BETWEEN ? and ?' => array($start, $end), 'order_in' => 'КЦ'), 'recursive' => -1));
		$stats['РХ'] = $this->find('count', array('conditions' => array('SecondStage.date BETWEEN ? and ?' => array($start, $end), 'order_in' => 'РХ'), 'recursive' => -1));
		$stats['Другие РИЦ'] = $this->find('count', array('conditions' => array('SecondStage.date BETWEEN ? and ?' => array($start, $end), 'order_in' => 'Другие РИЦ'), 'recursive' => -1));
		return $stats;
	}
}
