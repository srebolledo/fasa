<?php
/* Unities Test cases generated on: 2011-01-12 23:01:44 : 1294884704*/
App::import('Controller', 'Unities');

class TestUnitiesController extends UnitiesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class UnitiesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.unity', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.state', 'app.minuta', 'app.participant', 'app.position', 'app.minutas_participant', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Unities =& new TestUnitiesController();
		$this->Unities->constructClasses();
	}

	function endTest() {
		unset($this->Unities);
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