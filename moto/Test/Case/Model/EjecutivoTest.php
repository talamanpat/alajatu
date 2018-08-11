<?php
App::uses('Ejecutivo', 'Model');

/**
 * Ejecutivo Test Case
 *
 */
class EjecutivoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ejecutivo',
		'app.user',
		'app.admin',
		'app.motorista',
		'app.proveedor',
		'app.comuna',
		'app.customer',
		'app.order',
		'app.record',
		'app.product',
		'app.category',
		'app.products_order',
		'app.proveedore'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Ejecutivo = ClassRegistry::init('Ejecutivo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ejecutivo);

		parent::tearDown();
	}

}
