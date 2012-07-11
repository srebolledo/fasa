<?php
/* Activities Test cases generated on: 2011-01-12 23:01:07 : 1294884607*/
App::import('Controller', 'Activities');

class TestActivitiesController extends ActivitiesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ActivitiesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.activity', 'app.tworeport', 'app.engineer', 'app.filial', 'app.onereport', 'app.emsefor', 'app.unity', 'app.participant', 'app.position', 'app.minuta', 'app.minutas_participant', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject', 'app.indicator', 'app.state', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Activities =& new TestActivitiesController();
		$this->Activities->constructClasses();
	}

	function endTest() {
		unset($this->Activities);
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