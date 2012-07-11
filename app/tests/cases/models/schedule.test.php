<?php
/* Schedule Test cases generated on: 2010-12-15 14:12:03 : 1292432943*/
App::import('Model', 'Schedule');

class ScheduleTestCase extends CakeTestCase {
	var $fixtures = array('app.schedule', 'app.place', 'app.user', 'app.group', 'app.idea', 'app.company');

	function startTest() {
		$this->Schedule =& ClassRegistry::init('Schedule');
	}

	function endTest() {
		unset($this->Schedule);
		ClassRegistry::flush();
	}

}
?>