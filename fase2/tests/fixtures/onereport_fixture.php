<?php
/* Onereport Fixture generated on: 2011-01-12 00:01:36 : 1294801776 */
class OnereportFixture extends CakeTestFixture {
	var $name = 'Onereport';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'engineer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'folio' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'fecha' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'emsefor_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'unity_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'sap' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'participant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indicator_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'resumen' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'state_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'cartastate_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'proyectostate_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'proyectofecha' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'observacion' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'projecttype_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'engineer_id' => 1,
			'folio' => 1,
			'fecha' => '2011-01-12',
			'emsefor_id' => 1,
			'unity_id' => 1,
			'sap' => 1,
			'participant_id' => 1,
			'indicator_id' => 1,
			'resumen' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'state_id' => 1,
			'cartastate_id' => 1,
			'proyectostate_id' => 1,
			'proyectofecha' => '2011-01-12',
			'observacion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'projecttype_id' => 1
		),
	);
}
?>