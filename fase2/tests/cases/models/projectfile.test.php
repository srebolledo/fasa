<?php
/* Projectfile Test cases generated on: 2011-02-11 15:02:58 : 1297450738*/
App::import('Model', 'Projectfile');

class ProjectfileTestCase extends CakeTestCase {
	var $fixtures = array('app.projectfile', 'app.project', 'app.projecttype', 'app.onereport', 'app.engineer', 'app.filial', 'app.user', 'app.group', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.place', 'app.minuta', 'app.position', 'app.participant', 'app.indicator', 'app.ideasstate', 'app.cartastate', 'app.proyectostate');

	function startTest() {
		$this->Projectfile =& ClassRegistry::init('Projectfile');
	}

	function endTest() {
		unset($this->Projectfile);
		ClassRegistry::flush();
	}

}
?>