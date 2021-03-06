<?php
App::uses('Proveedor', 'Model');

/**
 * Proveedor Test Case
 *
 */
class ProveedorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.proveedor',
		'app.comuna',
		'app.customer',
		'app.order',
		'app.record',
		'app.proveedore',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Proveedor = ClassRegistry::init('Proveedor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Proveedor);

		parent::tearDown();
	}

}
