<?php
/* Idea Test cases generated on: 2010-12-15 14:12:21 : 1292432721*/
App::import('Model', 'Idea');

class IdeaTestCase extends CakeTestCase {
	var $fixtures = array('app.idea', 'app.user', 'app.group', 'app.schedule');

	function startTest() {
		$this->Idea =& ClassRegistry::init('Idea');
	}

	function endTest() {
		unset($this->Idea);
		ClassRegistry::flush();
	}

}
?>