<?php
App::uses('AppModel', 'Model');
/**
 * TrainingsContact Model
 *
 */
class TrainingsContact extends AppModel {

	public $validate = array(
			'name' => array(
			'rule' => 'notEmpty'
			),
			'purpose' => array(
			'rule' => 'notEmpty'
			),
			'occupation' => array(
				'rule' => 'notEmpty'
			)
	);

}
