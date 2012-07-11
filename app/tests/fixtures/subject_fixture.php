<?php
/* Subject Fixture generated on: 2010-12-16 12:12:08 : 1292513648 */
class SubjectFixture extends CakeTestFixture {
	var $name = 'Subject';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'fecha' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'schedule_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'nombre' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1,
			'fecha' => '2010-12-16',
			'schedule_id' => 1,
			'created' => '2010-12-16 12:34:08'
		),
	);
}
?>