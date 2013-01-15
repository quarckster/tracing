<?php
/* IncidentsRev Test cases generated on: 2012-03-19 08:13:20 : 1332116000*/
App::uses('IncidentsRev', 'Model');

/**
 * IncidentsRev Test Case
 *
 */
class IncidentsRevTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.incidents_rev');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->IncidentsRev = ClassRegistry::init('IncidentsRev');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IncidentsRev);

		parent::tearDown();
	}

}
