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
		'Agregar' => '/tworeports/add',
		'Buscar'=> '/tworeports/buscar',
		'Descargar reporte de planificación para fase 3'=>'/reportes/reportedescarga/2',
		'Ver todas' => '/tworeports/ver',
		'Ver planificadas' => '/tworeports/ver/1',
		'Ver realizadas' => '/tworeports/ver/2',
		'Ver no realizadas' => '/tworeports/ver/3',
		'Ver replanificadas' => '/tworeports/ver/4',
	),
	'Ideas' => array(
		'Agregar' => '/onereports/add',
		'Buscar'=> '/onereports/buscar',
		'Descargar todas las ideas (fase 2 y fase 3)'=>'/reportes/reportedescarga/1',
		'Ver todas' => '/onereports/ver',
		'Ver pendientes' => '/onereports/ver/1',
		'Ver aprobadas' => '/onereports/ver/2',
		'Ver rechazadas' => '/onereports/ver/3',
		'Ver reproceso' => '/onereports/ver/4',
	),
	'Proyectos Aprobados' => array(
		'Buscar'=> '/onereports/buscar/proyectos',
	),
	'Reporte' => array(
		'Ver reporte total' => '/reportes/reporte',
		'Ver reporte fase 2' => '/reportes/reporte/2',
		'Ver reporte fase 3' => '/reportes/reporte/3',
		'Histórico fase 2 (31 de mayo de 2011)' => '/fase2/reportes/reporte',

	),
	
);

