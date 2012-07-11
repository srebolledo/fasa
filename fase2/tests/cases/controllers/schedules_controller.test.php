<?php
/* Schedules Test cases generated on: 2010-12-16 12:12:49 : 1292513629*/
App::import('Controller', 'Schedules');

class TestSchedulesController extends SchedulesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SchedulesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.schedule', 'app.place', 'app.user', 'app.group', 'app.idea', 'app.company');

	function startTest() {
		$this->Schedules =& new TestSchedulesController();
		$this->Schedules->constructClasses();
	}

	function endTest() {
		unset($this->Schedules);
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