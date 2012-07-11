<?php
/* Subject Test cases generated on: 2010-12-16 12:12:08 : 1292513648*/
App::import('Model', 'Subject');

class SubjectTestCase extends CakeTestCase {
	var $fixtures = array('app.subject', 'app.user', 'app.group', 'app.idea', 'app.schedule', 'app.place', 'app.company', 'app.state', 'app.minuta', 'app.topic');

	function startTest() {
		$this->Subject =& ClassRegistry::init('Subject');
	}

	function endTest() {
		unset($this->Subject);
		ClassRegistry::flush();
	}

}
?>