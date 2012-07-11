<?php
/* Projectfiles Test cases generated on: 2011-02-11 15:02:59 : 1297450739*/
App::import('Controller', 'Projectfiles');

class TestProjectfilesController extends ProjectfilesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProjectfilesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.projectfile', 'app.project', 'app.projecttype', 'app.onereport', 'app.engineer', 'app.filial', 'app.user', 'app.group', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.place', 'app.minuta', 'app.position', 'app.participant', 'app.indicator', 'app.ideasstate', 'app.cartastate', 'app.proyectostate');

	function startTest() {
		$this->Projectfiles =& new TestProjectfilesController();
		$this->Projectfiles->constructClasses();
	}

	function endTest() {
		unset($this->Projectfiles);
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