<?php
/* Cartastates Test cases generated on: 2011-01-12 23:01:12 : 1294884612*/
App::import('Controller', 'Cartastates');

class TestCartastatesController extends CartastatesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CartastatesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.cartastate', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.minuta', 'app.participant', 'app.position', 'app.minutas_participant', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject', 'app.indicator', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Cartastates =& new TestCartastatesController();
		$this->Cartastates->constructClasses();
	}

	function endTest() {
		unset($this->Cartastates);
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