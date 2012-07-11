<?php
/* Tworeport Fixture generated on: 2011-01-12 00:01:32 : 1294801832 */
class TworeportFixture extends CakeTestFixture {
	var $name = 'Tworeport';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'engineer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'semana' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'fecha' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'activity_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'emsefor_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'cuadrilla' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'unity_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'contacto' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'lugar' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'state_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'tema' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'engineer_id' => 1,
			'semana' => 1,
			'fecha' => '2011-01-12',
			'activity_id' => 1,
			'emsefor_id' => 1,
			'cuadrilla' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'unity_id' => 1,
			'contacto' => 'Lorem ipsum dolor sit amet',
			'lugar' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'state_id' => 1,
			'tema' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);
}
?>