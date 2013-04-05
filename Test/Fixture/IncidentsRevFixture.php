<?php
/* IncidentsRev Fixture generated on: 2012-03-19 08:13:20 : 1332116000 */

/**
 * IncidentsRevFixture
 *
 */
class IncidentsRevFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => '', 'key' => 'primary'),
		'user_sid' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'start_date' => array('type' => 'date', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'exp_date' => array('type' => 'date', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'incoming_num' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'organization' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'content' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'number_to' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'version_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'version_created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'changed_by' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'version_id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_sid' => 'Lorem ipsum dolor sit amet',
			'start_date' => '2012-03-19',
			'exp_date' => '2012-03-19',
			'incoming_num' => 'Lorem',
			'organization' => 'Lorem ipsum dolor sit amet',
			'content' => 'Lorem ipsum dolor sit amet',
			'number_to' => 'Lorem ipsum dolor sit a',
			'version_id' => 1,
			'version_created' => '2012-03-19 08:13:20',
			'changed_by' => 'Lorem ipsum dolor sit amet'
		),
	);
}
