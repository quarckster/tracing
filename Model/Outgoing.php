<?php
App::uses('AppModel', 'Model');
/**
 * Outgoing Model
 *
 */
class Outgoing extends AppModel {

	public $actsAs = array('Search.Searchable');
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'outgoings';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'outgoing_num' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'organization' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'executer' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	public $filterArgs = array(
		array('name' => 'executer', 'type' => 'value'),
		array('name' => 'filter', 'type' => 'subquery', 'field' => 'Outgoing.id', 'method' => 'filter'),
		array('name' => 'range_from', 'name2'=>'range_to', 'type' => 'expression', 'method' => 'makeRangeCondition', 'field' => 'Outgoing.date BETWEEN ? AND ?'), 
		array('name' => 'outgoing_num', 'type' => 'value'),
		array('name' => 'cis', 'type' => 'value'),
		array('name' => 'folder', 'type' => 'value'),
		array('name' => 'content', 'type' => 'like'),
		array('name' => 'organization', 'type' => 'like')
	);

	public function makeRangeCondition($data, $field = null) {
		if (is_array($data)) {
			if (!empty($field['name'])) {
				return array($data[$field['name']], $data[$field['name2']]);
			} else {
				$input = $data['range'];
			}
		}
	}

	public function filter($data = array()) {
		if($data['filter'] == 'RKS') {
			$query = $this->getQuery('all', array('fields' => array('Outgoing.id'), 'conditions' => array('Outgoing.outgoing_num LIKE' => '%РКС%')));
		}
		if($data['filter'] == 'API') {
			$query = $this->getQuery('all', array('fields' => array('Outgoing.id'), 'conditions' => array('Outgoing.outgoing_num LIKE' => '%АПИ%')));
		}
		if($data['filter'] == 'IP') {
			$query = $this->getQuery('all', array('fields' => array('Outgoing.id'), 'conditions' => array('Outgoing.outgoing_num LIKE' => '%ИП%')));
		}
		if($data['filter'] == 'KS') {
			$query = $this->getQuery('all', array('fields' => array('Outgoing.id'), 'conditions' => array('Outgoing.outgoing_num REGEXP' => '^[0-9]+КС/[0-9]+$')));
		}
		if($data['filter'] == 'SP') {
			$query = $this->getQuery('all', array('fields' => array('Outgoing.id'), 'conditions' => array('Outgoing.outgoing_num LIKE' => '%СП%')));
		}
		return $query;
	}

	public function beforeSave($options) {
		if (!empty($this->data['Outgoing']['date'])) {
			$this->data['Outgoing']['date'] = date('Y-m-d', strtotime($this->data['Outgoing']['date']));
		}
		return true;
	}
	
	public function afterFind($results) {
	    foreach ($results as $key => $val) {
		if (isset($val['Outgoing']['date'])) {
		    $timestamp = strtotime($results[$key]['Outgoing']['date']);
		    $results[$key]['Outgoing']['date'] = date('d.m.Y', $timestamp);
		}
	    }
	    return $results;
	}
	public function getStatsData($start, $end) {
		$stats = $this->find('count', array('conditions' => array('Outgoing.date BETWEEN ? and ?' => array($start, $end))));
		return $stats;
	}
	
	public function findLastNum() {
		$number['IP'] = $this->find('first', array('order' => array('Outgoing.id DESC'), 'recursive' => -1, 'fields' => array('Outgoing.outgoing_num'), 'conditions' => array('Outgoing.outgoing_num LIKE' => '%ИП%')));
		$number['API'] = $this->find('first', array('order' => array('Outgoing.id DESC'), 'recursive' => -1, 'fields' => array('Outgoing.outgoing_num'), 'conditions' => array('Outgoing.outgoing_num LIKE' => '%АПИ%')));
		$number['KS'] = $this->find('first', array('order' => array('Outgoing.id DESC'), 'recursive' => -1, 'fields' => array('Outgoing.outgoing_num'), 'conditions' => array('Outgoing.outgoing_num REGEXP' => '^[0-9]+КС/[0-9]+$')));
		$number['RKS'] = $this->find('first', array('order' => array('Outgoing.id DESC'), 'recursive' => -1, 'fields' => array('Outgoing.outgoing_num'), 'conditions' => array('Outgoing.outgoing_num LIKE' => '%РКС%')));
		$number['SP'] = $this->find('first', array('order' => array('Outgoing.id DESC'), 'recursive' => -1, 'fields' => array('Outgoing.outgoing_num'), 'conditions' => array('Outgoing.outgoing_num LIKE' => '%СП%')));
		$outgoing_nums = array($number['IP']['Outgoing']['outgoing_num'], $number['API']['Outgoing']['outgoing_num'], $number['KS']['Outgoing']['outgoing_num'], $number['RKS']['Outgoing']['outgoing_num'], $number['SP']['Outgoing']['outgoing_num']);
		return $outgoing_nums;
	}
}
