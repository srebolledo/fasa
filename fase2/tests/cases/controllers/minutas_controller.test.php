<?php
/* Minutas Test cases generated on: 2011-01-17 10:01:07 : 1295270467*/
App::import('Controller', 'Minutas');

class TestMinutasController extends MinutasController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MinutasControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.minuta', 'app.tworeport', 'app.engineer', 'app.filial', 'app.onereport', 'app.emsefor', 'app.unity', 'app.participant', 'app.position', 'app.minutas_participant', 'app.indicator', 'app.state', 'app.cartastate', 'app.proyectostate', 'app.projecttype', 'app.activity', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject');

	function startTest() {
		$this->Minutas =& new TestMinutasController();
		$this->Minutas->constructClasses();
	}

	function endTest() {
		unset($this->Minutas);
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