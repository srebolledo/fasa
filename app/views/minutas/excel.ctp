<?php
	$this->layout = 'ajax'; //Para que aparezca el layout en blanco
	$worksheets = '';
$rows = '';
/*foreach($data as $key=>$row){
   $cells = '';
   foreach($row as $cell){
      //creates a cell
      $cells .= $xls->Cell($cell);
   }
   //creates a row
   $rows .= $xls->row($cells);
}*/
//Creates stylesheet named First Sheet
$worksheets .= $xls->worksheet('First Sheet', $rows);
//Creates stylesheet named Second Sheet
$worksheets .= $xls->worksheet('Second Sheet', $rows);

// If you print the output to the screen set the proper headers
$xls->setHeader('myExcel.xls');
echo $xls->workbook($worksheets);

//Alternatively you can store the content into file 
//file_put_contents('path-to-storage/myExcel.xls', $worksheets);

?>
