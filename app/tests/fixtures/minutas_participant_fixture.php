<?php
/* MinutasParticipant Fixture generated on: 2011-01-12 23:01:12 : 1294886772 */
class MinutasParticipantFixture extends CakeTestFixture {
	var $name = 'MinutasParticipant';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'minuta_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'participant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'minuta_id' => 1,
			'participant_id' => 1
		),
	);
}
?>