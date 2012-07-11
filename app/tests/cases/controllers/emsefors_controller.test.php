<?php
/* Emsefors Test cases generated on: 2011-01-23 23:01:24 : 1295834664*/
App::import('Controller', 'Emsefors');

class TestEmseforsController extends EmseforsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EmseforsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.emsefor', 'app.filial', 'app.engineer', 'app.user', 'app.group', 'app.tworeport', 'app.activity', 'app.unity', 'app.onereport', 'app.indicator', 'app.ideasstate', 'app.cartastate', 'app.proyectostate', 'app.projecttype', 'app.state', 'app.minuta');

	function startTest() {
		$this->Emsefors =& new TestEmseforsController();
		$this->Emsefors->constructClasses();
	}

	function endTest() {
		unset($this->Emsefors);
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