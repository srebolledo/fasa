<?php
/* MinutasTsubject Fixture generated on: 2011-01-12 22:01:17 : 1294882697 */
class MinutasTsubjectFixture extends CakeTestFixture {
	var $name = 'MinutasTsubject';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'minuta_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'tsubject_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'minuta_id' => 1,
			'tsubject_id' => 1
		),
	);
}
?>