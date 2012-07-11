<?php
/* Engineer Fixture generated on: 2011-01-12 00:01:02 : 1294801742 */
class EngineerFixture extends CakeTestFixture {
	var $name = 'Engineer';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'nombre' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'apellido' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'filial_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'nombre' => 1,
			'apellido' => 1,
			'filial_id' => 1
		),
	);
}
?>