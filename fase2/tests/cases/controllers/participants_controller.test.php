<?php
/* Participants Test cases generated on: 2011-01-12 23:01:57 : 1294884657*/
App::import('Controller', 'Participants');

class TestParticipantsController extends ParticipantsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ParticipantsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.participant', 'app.position', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.minuta', 'app.minutas_participant', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Participants =& new TestParticipantsController();
		$this->Participants->constructClasses();
	}

	function endTest() {
		unset($this->Participants);
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