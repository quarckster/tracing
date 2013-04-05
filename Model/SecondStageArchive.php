<?php
App::uses('AppModel', 'Model');
/**
 * SecondStageArchive Model
 *
 */
class SecondStageArchive extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'second_stage_archive';

	var $actsAs = array('Search.Searchable');
	var $validate = array(
		'SecondStageArchive_id' => array(
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

	var $filterArgs = array(
		array('name' => 'order_number', 'type' => 'value'),
		array('name' => 'contact_data', 'type' => 'like'),
		array('name' => 'requisites', 'type' => 'like')
	);

	function afterFind($results) {
		foreach ($results as $key => $val) {
			if (isset($val['SecondStageArchive']['receive_date'])) {
				$timestamp = strtotime($results[$key]['SecondStageArchive']['receive_date']);
				$results[$key]['SecondStageArchive']['receive_date'] = date('d.m.Y', $timestamp);
			}
			if (isset($val['SecondStageArchive']['send_date'])) {
				$timestamp = strtotime($results[$key]['SecondStageArchive']['send_date']);
				$results[$key]['SecondStageArchive']['send_date'] = date('d.m.Y', $timestamp);
			}
			if (isset($val['SecondStageArchive']['answer_date'])) {
				$timestamp = strtotime($results[$key]['SecondStageArchive']['answer_date']);
				$results[$key]['SecondStageArchive']['answer_date'] = date('d.m.Y', $timestamp);
			}
			if (isset($val['SecondStageArchive']['send_to_client_date'])) {
				$timestamp = strtotime($results[$key]['SecondStageArchive']['send_to_client_date']);
				$results[$key]['SecondStageArchive']['send_to_client_date'] = date('d.m.Y', $timestamp);
			}
		}
		return $results;
	}
}
