<?php
/* Proyectostates Test cases generated on: 2011-01-12 23:01:22 : 1294884682*/
App::import('Controller', 'Proyectostates');

class TestProyectostatesController extends ProyectostatesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProyectostatesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.proyectostate', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.minuta', 'app.participant', 'app.position', 'app.minutas_participant', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject', 'app.indicator', 'app.cartastate', 'app.projecttype');

	function startTest() {
		$this->Proyectostates =& new TestProyectostatesController();
		$this->Proyectostates->constructClasses();
	}

	function endTest() {
		unset($this->Proyectostates);
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