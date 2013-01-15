<?php
/* Histories Test cases generated on: 2012-03-12 09:12:56 : 1331514776*/
App::uses('HistoriesController', 'Controller');

/**
 * TestHistoriesController *
 */
class TestHistoriesController extends HistoriesController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * HistoriesController Test Case
 *
 */
class HistoriesControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.history');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Histories = new TestHistoriesController();
		$this->Histories->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Histories);

		parent::tearDown();
	}

}
