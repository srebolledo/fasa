<?php
/* Tsubjects Test cases generated on: 2011-01-12 23:01:35 : 1294884695*/
App::import('Controller', 'Tsubjects');

class TestTsubjectsController extends TsubjectsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TsubjectsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.tsubject');

	function startTest() {
		$this->Tsubjects =& new TestTsubjectsController();
		$this->Tsubjects->constructClasses();
	}

	function endTest() {
		unset($this->Tsubjects);
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