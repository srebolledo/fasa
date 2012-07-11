<?php
/* Subjects Test cases generated on: 2010-12-16 12:12:09 : 1292513649*/
App::import('Controller', 'Subjects');

class TestSubjectsController extends SubjectsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SubjectsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.subject', 'app.user', 'app.group', 'app.idea', 'app.schedule', 'app.place', 'app.company', 'app.state', 'app.minuta', 'app.topic');

	function startTest() {
		$this->Subjects =& new TestSubjectsController();
		$this->Subjects->constructClasses();
	}

	function endTest() {
		unset($this->Subjects);
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