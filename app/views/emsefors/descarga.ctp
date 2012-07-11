<?php
	$xls->setActiveSheetIndex(0);
	$xls->getActiveSheet()->SetCellValue('a1', 'Correlativo');
	$xls->getActiveSheet()->SetCellValue('b1', 'Filial');
	$xls->getActiveSheet()->SetCellValue('c1', 'Código SAP');
	$xls->getActiveSheet()->SetCellValue('d1', 'Nombre real');
	$xls->getActiveSheet()->SetCellValue('e1', 'Nombre de fantasía');
	$xls->getActiveSheet()->SetCellValue('f1', 'Unidad');
	$xls->getActiveSheet()->SetCellValue('g1', 'Trabajadores');
	$i=2;
	foreach($emsefors as $emsefor){
		$xls->getActiveSheet()->SetCellValue('a'.$i, $emsefor['Emsefor']['id']);
		$xls->getActiveSheet()->SetCellValue('b'.$i, $emsefor['Filial']['nombre']);
		$xls->getActiveSheet()->SetCellValue('c'.$i, $emsefor['Emsefor']['lugar']);
		$xls->getActiveSheet()->SetCellValue('d'.$i, $emsefor['Emsefor']['nombre_real']);
		$xls->getActiveSheet()->SetCellValue('e'.$i, $emsefor['Emsefor']['nombre']);
		$xls->getActiveSheet()->SetCellValue('f'.$i, $emsefor['Unity']['nombre']);
		$xls->getActiveSheet()->SetCellValue('g'.$i, $emsefor['Emsefor']['trabajadores']);
		$i++;
	
	}
	
	
	
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