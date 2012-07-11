<?php
/* Topic Test cases generated on: 2010-12-16 12:12:13 : 1292513653*/
App::import('Model', 'Topic');

class TopicTestCase extends CakeTestCase {
	var $fixtures = array('app.topic', 'app.schedule', 'app.place', 'app.user', 'app.group', 'app.idea', 'app.company', 'app.state', 'app.minuta', 'app.subject');

	function startTest() {
		$this->Topic =& ClassRegistry::init('Topic');
	}

	function endTest() {
		unset($this->Topic);
		ClassRegistry::flush();
	}

}
?>