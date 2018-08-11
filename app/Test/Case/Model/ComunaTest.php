<?php
App::uses('Comuna', 'Model');

/**
 * Comuna Test Case
 *
 */
class ComunaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.comuna',
		'app.customer',
		'app.proveedore'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Comuna = ClassRegistry::init('Comuna');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Comuna);

		parent::tearDown();
	}

}
