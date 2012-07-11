<?php
/* Topics Test cases generated on: 2010-12-16 12:12:14 : 1292513654*/
App::import('Controller', 'Topics');

class TestTopicsController extends TopicsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TopicsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.topic', 'app.schedule', 'app.place', 'app.user', 'app.group', 'app.idea', 'app.company', 'app.state', 'app.minuta', 'app.subject');

	function startTest() {
		$this->Topics =& new TestTopicsController();
		$this->Topics->constructClasses();
	}

	function endTest() {
		unset($this->Topics);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>