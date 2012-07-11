<?php
App::import("Vendor","ros/ezpdf");
//App::import("Vendor","class.pdf");

$pdf =& new Cezpdf();
$dir = getcwd();
$pizza = explode("/",$dir);
$ndir = "";
for($i=0;$i<=count($pizza)-2;$i++) $ndir = $ndir."".$pizza[$i]."/";
//echo $ndir;

$pdf->selectFont($ndir.'vendors/ros/fonts/Helvetica.afm');
$pdf->ezText('Hello World!',50);
$pdf->ezImage("/tmp/reunionesporfilial.png",0,400,'center');
$pdf->ezStream();

?>
