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
		'Buscar'=> '/tworeports/buscar'
	),
	'Ideas' => array(
		'Ver' => '/onereports/',
		'Buscar'=> '/onereports/buscar'
	),
	'Proyectos' => array(
		'Ver' => '/onereports/',
		'Buscar'=> '/onereports/buscar/proyectos',
	),
	'Reporte' => array(
		'Ver reporte total' => '/reportes/reporte',
		'Descargar reporte de ideas' => '/reportes/reporte1descarga',
		'Resumen' => '/reportes/resumen',
		'Descargar resumen' => '/reportes/resumen/1',
		'Volver al sistema de fase 3' => 'http://fasa.inf.udec.cl/',
	),
);

