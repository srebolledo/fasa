<?php
/* Projecttypes Test cases generated on: 2011-01-12 23:01:17 : 1294884677*/
App::import('Controller', 'Projecttypes');

class TestProjecttypesController extends ProjecttypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProjecttypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.projecttype', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.minuta', 'app.participant', 'app.position', 'app.minutas_participant', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject', 'app.indicator', 'app.cartastate', 'app.proyectostate');

	function startTest() {
		$this->Projecttypes =& new TestProjecttypesController();
		$this->Projecttypes->constructClasses();
	}

	function endTest() {
		unset($this->Projecttypes);
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