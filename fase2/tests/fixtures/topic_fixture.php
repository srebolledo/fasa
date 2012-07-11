<?php
/* Topic Fixture generated on: 2010-12-16 12:12:13 : 1292513653 */
class TopicFixture extends CakeTestFixture {
	var $name = 'Topic';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'schedule_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'numero' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'titulo' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'tiempo' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'schedule_id' => 1,
			'numero' => 1,
			'titulo' => 'Lorem ipsum dolor sit amet',
			'tiempo' => 1,
			'created' => '2010-12-16 12:34:13'
		),
	);
}
?>