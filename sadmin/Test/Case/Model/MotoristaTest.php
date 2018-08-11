<?php
App::uses('Motorista', 'Model');

/**
 * Motorista Test Case
 *
 */
class MotoristaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.motorista',
		'app.user',
		'app.admin',
		'app.ejecutivo',
		'app.order',
		'app.customer',
		'app.comuna',
		'app.proveedore',
		'app.record',
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
		$this->Motorista = ClassRegistry::init('Motorista');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Motorista);

		parent::tearDown();
	}

}
