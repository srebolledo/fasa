<?php
/* Projects Test cases generated on: 2011-02-11 15:02:04 : 1297450444*/
App::import('Controller', 'Projects');

class TestProjectsController extends ProjectsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProjectsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.project', 'app.onereport', 'app.engineer', 'app.filial', 'app.user', 'app.group', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.place', 'app.minuta', 'app.position', 'app.participant', 'app.indicator', 'app.ideasstate', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Projects =& new TestProjectsController();
		$this->Projects->constructClasses();
	}

	function endTest() {
		unset($this->Projects);
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