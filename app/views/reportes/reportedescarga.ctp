<?php
	
	$xls->setActiveSheetIndex(0);
	if ($reporte == 1):
		$xls->getActiveSheet()->SetCellValue('A1', 'Correlativo');
		$xls->getActiveSheet()->SetCellValue('b1', 'Correlativo');
		$xls->getActiveSheet()->SetCellValue('c1', 'Filial');	
		if($ingenieros){
		$xls->getActiveSheet()->SetCellValue('d1', 'Nombre de ingeniero');
		$xls->getActiveSheet()->SetCellValue('e1', 'Fecha');
		$xls->getActiveSheet()->SetCellValue('f1', 'Unidad');
		$xls->getActiveSheet()->SetCellValue('g1', 'Razón social');
		$xls->getActiveSheet()->SetCellValue('h1', 'Código SAP');
		$xls->getActiveSheet()->SetCellValue('i1', 'Nombre de fantasía');
		$xls->getActiveSheet()->SetCellValue('j1', 'Sigla');
		$xls->getActiveSheet()->SetCellValue('k1', 'Nombre del trabajador');
		$xls->getActiveSheet()->SetCellValue('l1', 'Cargo del trabajador');
		$xls->getActiveSheet()->SetCellValue('m1', 'Indicador');
		$xls->getActiveSheet()->SetCellValue('n1', 'Resumen de la idea');
		$xls->getActiveSheet()->SetCellValue('o1', 'Estado de la idea');
		$xls->getActiveSheet()->SetCellValue('p1', 'Estado de la carta');
		$xls->getActiveSheet()->SetCellValue('q1', 'Estado del proyecto');
		$xls->getActiveSheet()->SetCellValue('r1', 'Fecha de inicio del proyecto');
		$xls->getActiveSheet()->SetCellValue('s1', 'Fecha de finalización del proyecto');
		$xls->getActiveSheet()->SetCellValue('t1', 'Observación');
		$xls->getActiveSheet()->SetCellValue('u1', 'Fecha de último cambio');

		
		}
		else{
		$xls->getActiveSheet()->SetCellValue('d1', 'Fecha');
		$xls->getActiveSheet()->SetCellValue('e1', 'Unidad');
		$xls->getActiveSheet()->SetCellValue('f1', 'Razón social');
		$xls->getActiveSheet()->SetCellValue('g1', 'Código SAP');
		$xls->getActiveSheet()->SetCellValue('h1', 'Nombre de fantasía');
		$xls->getActiveSheet()->SetCellValue('i1', 'Sigla');
		$xls->getActiveSheet()->SetCellValue('j1', 'Nombre del trabajador');
		$xls->getActiveSheet()->SetCellValue('k1', 'Cargo del trabajador');
		$xls->getActiveSheet()->SetCellValue('l1', 'Indicador');
		$xls->getActiveSheet()->SetCellValue('m1', 'Resumen de la idea');
		$xls->getActiveSheet()->SetCellValue('n1', 'Estado de la idea');
		$xls->getActiveSheet()->SetCellValue('o1', 'Estado de la carta');
		$xls->getActiveSheet()->SetCellValue('p1', 'Estado del proyecto');
		$xls->getActiveSheet()->SetCellValue('q1', 'Fecha de inicio del proyecto');
		$xls->getActiveSheet()->SetCellValue('r1', 'Fecha de finalización del proyecto');
		$xls->getActiveSheet()->SetCellValue('s1', 'Observación');
		$xls->getActiveSheet()->SetCellValue('t1', 'Fecha de último cambio');
		}
	$i=1;
	$j=2;
	foreach($onereports as $onereport){
		$xls->getActiveSheet()->SetCellValue('a'.$j,$i);
		$xls->getActiveSheet()->SetCellValue('b'.$j,$onereport['Onereport']['id']);
		$xls->getActiveSheet()->SetCellValue('c'.$j,$filials[$onereport['Engineer']['filial_id']]);

		if($ingenieros){
		$xls->getActiveSheet()->SetCellValue('d'.$j,$onereport['Engineer']['nombre']);
		$xls->getActiveSheet()->SetCellValue('e'.$j,$onereport['Onereport']['fecha']);
		$xls->getActiveSheet()->SetCellValue('f'.$j,$onereport['Unity']['nombre']);
		$xls->getActiveSheet()->SetCellValue('g'.$j,$onereport['Emsefor']['nombre_real']);
		$xls->getActiveSheet()->SetCellValue('h'.$j,$onereport['Emsefor']['lugar']);
		$xls->getActiveSheet()->SetCellValue('i'.$j,$onereport['Emsefor']['nombre']);
		$xls->getActiveSheet()->SetCellValue('j'.$j,$onereport['Onereport']['cuadrilla']);
		$xls->getActiveSheet()->SetCellValue('k'.$j,$onereport['Onereport']['trabajador']);
		$xls->getActiveSheet()->SetCellValue('l'.$j,$onereport['Position']['nombre']);		
		$xls->getActiveSheet()->SetCellValue('m'.$j,$onereport['Indicator']['nombre']);
		$xls->getActiveSheet()->SetCellValue('n'.$j,$onereport['Onereport']['resumen']);
		$xls->getActiveSheet()->SetCellValue('o'.$j,$onereport['Ideasstate']['nombre']);
		$xls->getActiveSheet()->SetCellValue('p'.$j,$onereport['Cartastate']['nombre']);
		$xls->getActiveSheet()->SetCellValue('q'.$j,$onereport['Proyectostate']['nombre']);
		if($onereport['Onereport']['proyectofecha'] != '0000-00-00') $xls->getActiveSheet()->SetCellValue('r'.$j,$onereport['Onereport']['proyectofecha']);
		else $xls->getActiveSheet()->SetCellValue('r'.$j,'-');
		
		if($onereport['Onereport']['proyectofechafin'] != '0000-00-00')$xls->getActiveSheet()->SetCellValue('s'.$j,$onereport['Onereport']['proyectofecafin']);
		else $xls->getActiveSheet()->SetCellValue('s'.$j,'-');
		$xls->getActiveSheet()->SetCellValue('t'.$j,$onereport['Onereport']['observacion']);
		if(array_key_exists('created',$onereport['Onereporthistory'][0]))$xls->getActiveSheet()->SetCellValue('u'.$j,$onereport['Onereporthistory'][0]['created']);
		else 		$xls->getActiveSheet()->SetCellValue('u'.$j,'-');


		$j++;$i++;		
	
	}
	else{
		$xls->getActiveSheet()->SetCellValue('d'.$j,$onereport['Onereport']['fecha']);
		$xls->getActiveSheet()->SetCellValue('e'.$j,$onereport['Unity']['nombre']);
		$xls->getActiveSheet()->SetCellValue('f'.$j,$onereport['Emsefor']['nombre_real']);
		$xls->getActiveSheet()->SetCellValue('g'.$j,$onereport['Emsefor']['lugar']);
		$xls->getActiveSheet()->SetCellValue('h'.$j,$onereport['Emsefor']['nombre']);
		$xls->getActiveSheet()->SetCellValue('i'.$j,$onereport['Onereport']['cuadrilla']);
		$xls->getActiveSheet()->SetCellValue('j'.$j,$onereport['Onereport']['trabajador']);
		$xls->getActiveSheet()->SetCellValue('k'.$j,$onereport['Position']['nombre']);		
		$xls->getActiveSheet()->SetCellValue('l'.$j,$onereport['Indicator']['nombre']);
		$xls->getActiveSheet()->SetCellValue('m'.$j,$onereport['Onereport']['resumen']);
		$xls->getActiveSheet()->SetCellValue('n'.$j,$onereport['Ideasstate']['nombre']);
		$xls->getActiveSheet()->SetCellValue('o'.$j,$onereport['Cartastate']['nombre']);
		$xls->getActiveSheet()->SetCellValue('p'.$j,$onereport['Proyectostate']['nombre']);
		if($onereport['Onereport']['proyectofecha'] != '0000-00-00') $xls->getActiveSheet()->SetCellValue('q'.$j,$onereport['Onereport']['proyectofecha']);
		else $xls->getActiveSheet()->SetCellValue('q'.$j,'-');
		
		if($onereport['Onereport']['proyectofechafin'] != '0000-00-00')$xls->getActiveSheet()->SetCellValue('r'.$j,$onereport['Onereport']['proyectofechafin']);
		else $xls->getActiveSheet()->SetCellValue('r'.$j,'-');
		$xls->getActiveSheet()->SetCellValue('s'.$j,$onereport['Onereport']['observacion']);
		if(array_key_exists('created',$onereport['Onereporthistory'][0]))$xls->getActiveSheet()->SetCellValue('t'.$j,$onereport['Onereporthistory'][0]['created']);
		else 		$xls->getActiveSheet()->SetCellValue('t'.$j,'-');

		$j++;$i++;		
	
	}
	}


	endif;

	
	if($reporte == 2):
	$xls->getActiveSheet()->SetCellValue('A1', 'Correlativo');
	$xls->getActiveSheet()->SetCellValue('b1', 'Correlativo');

	if($ingenieros){
	$xls->getActiveSheet()->SetCellValue('c1', 'Nombre de ingeniero');
	$xls->getActiveSheet()->SetCellValue('d1', 'Fecha');
	$xls->getActiveSheet()->SetCellValue('e1', 'Actividad');
	$xls->getActiveSheet()->SetCellValue('f1', 'Razón social');
	$xls->getActiveSheet()->SetCellValue('g1', 'Código SAP');
	$xls->getActiveSheet()->SetCellValue('h1', 'Nombre de fantasía');
	$xls->getActiveSheet()->SetCellValue('i1', 'Participantes programados');
	$xls->getActiveSheet()->SetCellValue('j1', 'Participantes');
	$xls->getActiveSheet()->SetCellValue('k1', 'Sigla');
	$xls->getActiveSheet()->SetCellValue('l1', 'Unidad');
	$xls->getActiveSheet()->SetCellValue('m1', 'Contacto');
	$xls->getActiveSheet()->SetCellValue('n1', 'Lugar de reunión');
	$xls->getActiveSheet()->SetCellValue('o1', 'Estado de planificación');
	$xls->getActiveSheet()->SetCellValue('p1', 'Tema a tratar');
	}
	else{
	$xls->getActiveSheet()->SetCellValue('c1', 'Fecha');
	$xls->getActiveSheet()->SetCellValue('d1', 'Actividad');
	$xls->getActiveSheet()->SetCellValue('e1', 'Razón social');
	$xls->getActiveSheet()->SetCellValue('f1', 'Código SAP');
	$xls->getActiveSheet()->SetCellValue('g1', 'Nombre de fantasía');
	$xls->getActiveSheet()->SetCellValue('h1', 'Participantes programados');
	$xls->getActiveSheet()->SetCellValue('i1', 'Participantes');
	$xls->getActiveSheet()->SetCellValue('j1', 'Sigla');
	$xls->getActiveSheet()->SetCellValue('k1', 'Unidad');
	$xls->getActiveSheet()->SetCellValue('l1', 'Contacto');
	$xls->getActiveSheet()->SetCellValue('m1', 'Lugar de reunión');
	$xls->getActiveSheet()->SetCellValue('n1', 'Estado de planificación');
	$xls->getActiveSheet()->SetCellValue('o1', 'Tema a tratar');
	}
	$i=1;
	$j=2;
	foreach($tworeports as $tworeport){
		$xls->getActiveSheet()->SetCellValue('a'.$j,$i);
		$xls->getActiveSheet()->SetCellValue('b'.$j,$filials[$tworeport['Engineer']['filial_id']]);
		if($ingenieros){
		$xls->getActiveSheet()->SetCellValue('c'.$j,$tworeport['Engineer']['nombre']);
		$xls->getActiveSheet()->SetCellValue('d'.$j,$tworeport['Tworeport']['fecha']);
		$xls->getActiveSheet()->SetCellValue('e'.$j,$tworeport['Activity']['nombre']);
		$xls->getActiveSheet()->SetCellValue('f'.$j,$tworeport['Emsefor']['nombre_real']);
		$xls->getActiveSheet()->SetCellValue('g'.$j,$tworeport['Emsefor']['lugar']);
		$xls->getActiveSheet()->SetCellValue('h'.$j,$tworeport['Emsefor']['nombre']);
		$xls->getActiveSheet()->SetCellValue('i'.$j,$tworeport['Tworeport']['participantes']);
		$xls->getActiveSheet()->SetCellValue('j'.$j,$tworeport['Tworeport']['participantes_reales']);
		$xls->getActiveSheet()->SetCellValue('k'.$j,$tworeport['Tworeport']['cuadrilla']);
		$xls->getActiveSheet()->SetCellValue('l'.$j,$tworeport['Unity']['nombre']);
		$xls->getActiveSheet()->SetCellValue('m'.$j,$tworeport['Tworeport']['contacto']);
		$xls->getActiveSheet()->SetCellValue('n'.$j,$tworeport['Place']['nombre']);
		$xls->getActiveSheet()->SetCellValue('o'.$j,$tworeport['State']['nombre']);
		$xls->getActiveSheet()->SetCellValue('p'.$j,$tworeport['Tworeport']['tema']);
		}
		else{
		$xls->getActiveSheet()->SetCellValue('c'.$j,$tworeport['Tworeport']['fecha']);
		$xls->getActiveSheet()->SetCellValue('d'.$j,$tworeport['Activity']['nombre']);
		$xls->getActiveSheet()->SetCellValue('e'.$j,$tworeport['Emsefor']['nombre_real']);
		$xls->getActiveSheet()->SetCellValue('f'.$j,$tworeport['Emsefor']['lugar']);
		$xls->getActiveSheet()->SetCellValue('g'.$j,$tworeport['Emsefor']['nombre']);
		$xls->getActiveSheet()->SetCellValue('h'.$j,$tworeport['Tworeport']['participantes']);
		$xls->getActiveSheet()->SetCellValue('i'.$j,$tworeport['Tworeport']['participantes_reales']);
		$xls->getActiveSheet()->SetCellValue('j'.$j,$tworeport['Tworeport']['cuadrilla']);
		$xls->getActiveSheet()->SetCellValue('k'.$j,$tworeport['Unity']['nombre']);
		$xls->getActiveSheet()->SetCellValue('l'.$j,$tworeport['Tworeport']['contacto']);
		$xls->getActiveSheet()->SetCellValue('m'.$j,$tworeport['Place']['nombre']);
		$xls->getActiveSheet()->SetCellValue('n'.$j,$tworeport['State']['nombre']);
		$xls->getActiveSheet()->SetCellValue('o'.$j,$tworeport['Tworeport']['tema']);
		}
		$j++;$i++;		
	
	}
	endif;
  ob_end_clean();
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="'.$nombreArchivo."".date('d-m-y H:i:s').'.xls"');
	$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel5');
	ob_end_clean();
	$objWriter->save("php://output");
	
	
?>
