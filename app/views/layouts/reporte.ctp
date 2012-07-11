<?php
$fecha = date("d-m-Y");
// Send file headers
/*header("Content-type: text/x-csv");
header("Content-Disposition: attachment;filename=".$nombreArchivo."-".$fecha.".csv");
header("Content-Transfer-Encoding: binary");
header('Pragma: no-cache');
header('Expires: 0');
 //Send the file contents.
set_time_limit(0);*/
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=".$nombreArchivo."-".$fecha.".xls");
header("Content-Transfer-Encoding: binary");


echo $content_for_layout;


?>
