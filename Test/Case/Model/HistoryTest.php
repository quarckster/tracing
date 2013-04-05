<?php
/* History Test cases generated on: 2012-03-12 09:52:45 : 1331517165*/
App::uses('History', 'Model');

/**
 * History Test Case
 *
 */
class HistoryTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.history', 'app.call', 'app.calls_detail', 'app.incident', 'app.detail');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->History = ClassRegistry::init('History');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->History);

		parent::tearDown();
	}

}
