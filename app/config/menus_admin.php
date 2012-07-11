<?php

//****************************************
//
//     SIP-SGI Menus Configuration
//
//****************************************

// Array format:
// (array)( 'Item' => (array)( 'SubItem' => 'link' ) | 'link' )
$config['Menus.main'] = array(
	'Planificación' => array(
		'Ver' => '/tworeports/',
		'Descargar reporte de planificación para fase 3'=>'/reportes/reportedescarga/2',
	),
	'Ideas' => array(
		'Ver' => '/onereports/',
		'Descargar todas las ideas (fase 2 y fase 3)'=>'/reportes/reportedescarga/1',
	),
	'Proyectos Aprobados' => array(
		'Ver' =>'/onereports/buscar/proyectos',
		'Asignar'=> '/onereports/asignarIdea'
	),
	'EMSEFOR' => array(
			'Agregar' => '/emsefors/add',
			'Ver' => '/emsefors/buscar',
			'Descargar' => '/emsefors/descarga',

			
	),
	'Reporte' => array(
		'Ver reporte por fecha' =>'/reportes/reportePorFecha',
		'Ver reporte total' => '/reportes/reporte',
		'Ver reporte fase 2' => '/reportes/reporte/2',
		'Ver reporte fase 3' => '/reportes/reporte/3',
		'Histórico fase 2 (31 de mayo de 2011)' => '/fase2/reportes/reporte',
		'Resumen' => '/reportes/resumen',
		'Descargar resumen' => '/reportes/resumen/1'
	),
);

