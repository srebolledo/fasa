<?php
/* MinutasTdsubject Fixture generated on: 2011-01-12 22:01:12 : 1294882692 */
class MinutasTdsubjectFixture extends CakeTestFixture {
	var $name = 'MinutasTdsubject';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'minuta_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'tdsubject_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'minuta_id' => 1,
			'tdsubject_id' => 1
		),
	);
}
?>