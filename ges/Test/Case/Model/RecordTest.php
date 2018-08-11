<?php
App::uses('Record', 'Model');

/**
 * Record Test Case
 *
 */
class RecordTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.record',
		'app.customer',
		'app.comuna',
		'app.proveedore',
		'app.order',
		'app.motorista',
		'app.user',
		'app.admin',
		'app.ejecutivo',
		'app.product',
		'app.category',
		'app.products_order'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Record = ClassRegistry::init('Record');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Record);

		parent::tearDown();
	}

}
