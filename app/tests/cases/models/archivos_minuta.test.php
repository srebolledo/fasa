<?php
/* ArchivosMinuta Test cases generated on: 2010-11-27 17:11:06 : 1290892326*/
App::import('Model', 'ArchivosMinuta');

class ArchivosMinutaTestCase extends CakeTestCase {
	var $fixtures = array('app.archivos_minuta', 'app.jefe', 'app.asegurado', 'app.ingenieros_proyecto', 'app.funciones_proyecto', 'app.funciones_proyectos_ingenieros_proyecto', 'app.funciones_proyectos_jefe');

	function startTest() {
		$this->ArchivosMinuta =& ClassRegistry::init('ArchivosMinuta');
	}

	function endTest() {
		unset($this->ArchivosMinuta);
		ClassRegistry::flush();
	}

}
?>