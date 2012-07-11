<?php
/* ArchivosMinuta Fixture generated on: 2010-11-27 17:11:06 : 1290892326 */
class ArchivosMinutaFixture extends CakeTestFixture {
	var $name = 'ArchivosMinuta';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'correlativo' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'fecha_reunion' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'lugar_reunion' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'version_reporte1' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 3, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'version_reporte2' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 3, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'jefe_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'correlativo' => array('column' => 'correlativo', 'unique' => 1), 'jefe_id' => array('column' => 'jefe_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'correlativo' => 1,
			'fecha_reunion' => '2010-11-27',
			'lugar_reunion' => 'Lorem ipsum dolor sit amet',
			'version_reporte1' => 'L',
			'version_reporte2' => 'L',
			'jefe_id' => 1
		),
	);
}
?>