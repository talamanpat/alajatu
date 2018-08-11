<?php
/**
 * OrderFixture
 *
 */
class OrderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'correlative' => array('type' => 'integer', 'null' => false, 'default' => null),
		'code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'state' => array('type' => 'integer', 'null' => false, 'default' => null),
		'active' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'dtime_solicitud' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'dtime_confirmacion' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'dtime_cocina' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'dtime_despacho' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'dtime_entrega' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'pay_mode' => array('type' => 'integer', 'null' => true, 'default' => '1'),
		'comments' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'terms_conditions' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'customer_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'motorista_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'proveedor_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ejecutivo_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'create_time' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'id_UNIQUE' => array('column' => 'id', 'unique' => 1),
			'fk_orders_customers1' => array('column' => 'customer_id', 'unique' => 0),
			'fk_orders_ejecutivos1' => array('column' => 'ejecutivo_id', 'unique' => 0),
			'fk_orders_motoristas1' => array('column' => 'motorista_id', 'unique' => 0),
			'fk_orders_proveedores1' => array('column' => 'proveedor_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '52d88eaf-3ad4-4494-bb8a-3385cbdd56cb',
			'correlative' => 1,
			'code' => 'Lorem ipsum dolor sit amet',
			'state' => 1,
			'active' => 1,
			'dtime_solicitud' => '2014-01-17 02:00:15',
			'dtime_confirmacion' => '2014-01-17 02:00:15',
			'dtime_cocina' => '2014-01-17 02:00:15',
			'dtime_despacho' => '2014-01-17 02:00:15',
			'dtime_entrega' => '2014-01-17 02:00:15',
			'pay_mode' => 1,
			'comments' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'terms_conditions' => 1,
			'customer_id' => 'Lorem ipsum dolor sit amet',
			'motorista_id' => 'Lorem ipsum dolor sit amet',
			'proveedor_id' => 'Lorem ipsum dolor sit amet',
			'ejecutivo_id' => 'Lorem ipsum dolor sit amet',
			'create_time' => '2014-01-17 02:00:15'
		),
	);

}
