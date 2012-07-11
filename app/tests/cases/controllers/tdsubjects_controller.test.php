<?php
/* Tdsubjects Test cases generated on: 2011-01-12 23:01:30 : 1294884690*/
App::import('Controller', 'Tdsubjects');

class TestTdsubjectsController extends TdsubjectsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TdsubjectsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.tdsubject');

	function startTest() {
		$this->Tdsubjects =& new TestTdsubjectsController();
		$this->Tdsubjects->constructClasses();
	}

	function endTest() {
		unset($this->Tdsubjects);
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