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
		'Buscar'=> '/tworeports/buscar',
		'Ver todas' => '/tworeports/ver',
		'Ver planificadas' => '/tworeports/ver/1',
		'Ver realizadas' => '/tworeports/ver/2',
		'Ver no realizadas' => '/tworeports/ver/3',
		'Ver replanificadas' => '/tworeports/ver/4',
	),
	'Ideas' => array(
		'Buscar'=> '/onereports/buscar',
		'Ver todas' => '/onereports/ver',
		'Ver pendientes' => '/onereports/ver/1',
		'Ver aprobadas' => '/onereports/ver/2',
		'Ver rechazadas' => '/onereports/ver/3',
		'Ver reproceso' => '/onereports/ver/4',
	),
	'Proyectos' => array(
		'Buscar'=> '/onereports/buscar/proyectos',
	),
	'Reporte' => array(
		'Ver reporte fase 2 total' => '/reportes/reporte',
		'Volver al sistema de fase 3' => 'http://fasa.inf.udec.cl/',
	),
	
);

