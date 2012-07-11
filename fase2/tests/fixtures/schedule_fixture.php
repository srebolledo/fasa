<?php
/* Schedule Fixture generated on: 2010-12-15 14:12:03 : 1292432943 */
class ScheduleFixture extends CakeTestFixture {
	var $name = 'Schedule';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'place_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'create' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'fecha' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'contacto' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'company_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'clase' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'place_id' => 1,
			'user_id' => 1,
			'create' => '2010-12-15 14:09:03',
			'fecha' => '2010-12-15 14:09:03',
			'contacto' => 'Lorem ipsum dolor sit amet',
			'company_id' => 1,
			'clase' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);
}
?>