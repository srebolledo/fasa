<?php
/* Filials Test cases generated on: 2011-01-12 23:01:25 : 1294884625*/
App::import('Controller', 'Filials');

class TestFilialsController extends FilialsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FilialsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.filial', 'app.engineer', 'app.onereport', 'app.emsefor', 'app.tworeport', 'app.activity', 'app.unity', 'app.state', 'app.minuta', 'app.participant', 'app.position', 'app.minutas_participant', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Filials =& new TestFilialsController();
		$this->Filials->constructClasses();
	}

	function endTest() {
		unset($this->Filials);
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