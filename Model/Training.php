<?php
App::uses('AppModel', 'Model');
/**
 * Training Model
 *
 */
class Training extends AppModel {

	public $actsAs = array('Search.Searchable');

	public $validate = array(
			'user_sid' => array(
			'rule' => 'notEmpty'
			),
			'purpose' => array(
			'rule' => 'notEmpty'
			),
			'number_to' => array(
				'rule1' => array('rule' => 'notEmpty'),
				'rule2'	=> array('rule' => 'numeric', 'message' => 'Здесь должно быть число')
			),
			'organization' => array(
			'rule' => 'notEmpty'
			),
			'address_fact' => array(
			'rule' => 'notEmpty'
			),
			'systems_set' => array(
			'rule' => 'notEmpty'
			),
			'tso' => array(
			'rule' => 'notEmpty'
			),
			'amount' => array(
				'rule1' => array('rule' => 'notEmpty'),
				'rule2'	=> array('rule' => 'numeric', 'message' => 'Здесь должно быть число')
			),
			'competitors' => array(
			'rule' => 'notEmpty'
			)			
	);

	public $hasMany = array(
			'TrainingsComment' => array('className' => 'TrainingsComment',
								'foreignKey' => 'trainings_id',
								'conditions' => array(),
								'fields' => array(),
								'order' => 'TrainingsComment.date DESC',
			),
			'TrainingsContact' => array('className' => 'TrainingsContact',
								'foreignKey' => 'trainings_id',
								'dependent' => true
			),
		);

	public $filterArgs = array(
		array('name' => 'user_sid', 'type' => 'value'),
		array('name' => 'filter', 'type' => 'subquery', 'field' => 'Training.id', 'method' => 'filter'),
		array('name' => 'range_from', 'name2' => 'range_to', 'type' => 'expression', 'method' => 'makeRangeCondition', 'field' => 'Training.date_receipt BETWEEN ? AND ?'), 
		array('name' => 'id', 'type' => 'value'),
		array('name' => 'number_to', 'type' => 'value'),
		array('name' => 'purpose', 'type' => 'like'),
		array('name' => 'town', 'type' => 'like')
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
		if($data['filter'] == 'in_progress') {
			$query = $this->getQuery('all', array('fields' => array('Training.id'), 'conditions' => array('Training.date_training' => null)));
		}		
		if($data['filter'] == 'expired') {
			$query = $this->getQuery('all', array('fields' => array('Training.id'), 'conditions' => array('Training.date_end' => null, 'Training.date_control <' => date('Y-m-d', time()))));
		}
		if($data['filter'] == 'not_completed') {
			$query = $this->getQuery('all', array('fields' => array('Training.id'), 'conditions' => array('Training.date_end' => null, 'Training.date_control >' => date('Y-m-d', time()))));				
		}
		if($data['filter'] == 'urgenеtly') {
			$query = $this->getQuery('all', array('fields' => array('Training.id'), 'conditions' => array('Training.date_end' => null, 'Training.date_control' => date('Y-m-d', time()))));
		}	
		if($data['filter'] == 'completed') {
			$query = $this->getQuery('all', array('fields' => array('Training.id'), 'conditions' => array('Training.date_end <>' => null)));
		}
		if($data['filter'] == 'new') {
			$query = $this->getQuery('all', array('fields' => array('Training.id'), 'conditions' => array('Training.date_control' => null)));
		}		
		return $query;		
	}

	public function beforeSave($options) {
		if (empty($this->data['Training']['date_receipt'])) {
			$this->data['Training']['date_receipt'] = date('Y-m-d H:m', time());
		} else {
			$this->data['Training']['date_receipt'] = date('Y-m-d H:m', strtotime($this->data['Training']['date_receipt']));
		}
		if (!empty($this->data['Training']['date_control'])) {
			$this->data['Training']['date_control'] = date('Y-m-d', strtotime($this->data['Training']['date_control']));
		}
		if (!empty($this->data['Training']['date_training'])) {
			$this->data['Training']['date_training'] = date('Y-m-d', strtotime($this->data['Training']['date_training']));
		}
		if (!empty($this->data['Training']['date_end'])) {
			$this->data['Training']['date_end'] = date('Y-m-d', strtotime($this->data['Training']['date_end']));
		}
		return true;
	}
	
	public function afterFind($results) {
		foreach ($results as $key => $val) {
			if (isset($val['Training']['date_receipt'])) {
				$timestamp = strtotime($results[$key]['Training']['date_receipt']);
				$results[$key]['Training']['date_receipt'] = date('d.m.Y', $timestamp);
			}
			if (isset($val['Training']['date_training'])) {
				$timestamp = strtotime($results[$key]['Training']['date_training']);
				$results[$key]['Training']['date_training'] = date('d.m.Y', $timestamp);
			}
			if (isset($val['Training']['date_control'])) {
				$timestamp = strtotime($results[$key]['Training']['date_control']);
				$results[$key]['Training']['date_control'] = date('d.m.Y', $timestamp);
			}
			if (isset($val['Training']['date_end'])) {
				$timestamp = strtotime($results[$key]['Training']['date_end']);
				$results[$key]['Training']['date_end'] = date('d.m.Y', $timestamp);
			}		
		}
		return $results;
	}
}
