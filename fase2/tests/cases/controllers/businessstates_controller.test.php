<?php
/* Businessstates Test cases generated on: 2011-03-22 09:03:31 : 1300797451*/
App::import('Controller', 'Businessstates');

class TestBusinessstatesController extends BusinessstatesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class BusinessstatesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.businessstate');

	function startTest() {
		$this->Businessstates =& new TestBusinessstatesController();
		$this->Businessstates->constructClasses();
	}

	function endTest() {
		unset($this->Businessstates);
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