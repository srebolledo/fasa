<?php
/* Onereports Test cases generated on: 2011-01-24 15:01:41 : 1295893121*/
App::import('Controller', 'Onereports');

class TestOnereportsController extends OnereportsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class OnereportsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.onereport', 'app.indicator', 'app.ideasstate', 'app.cartastate', 'app.proyectostate', 'app.projecttype', 'app.tworeport', 'app.engineer', 'app.filial', 'app.user', 'app.group', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.minuta');

	function startTest() {
		$this->Onereports =& new TestOnereportsController();
		$this->Onereports->constructClasses();
	}

	function endTest() {
		unset($this->Onereports);
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