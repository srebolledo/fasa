<?php
include_once 'Classes/PHPExcel.php';

class phpexceltoarray{
	
	public function _construct(){
		
		}
	
	static function xls2array($filename) {
		    $objReader = new PHPExcel_Reader_Excel5 ();
		    $objReader->setReadDataOnly ( true );
		    $obj = $objReader->load ( $filename );
		    $cells = $obj->getActiveSheet ()->getCellCollection ();
		    $coords = array ();
		    foreach ( $cells as $cell ) {
		        $value = $obj->getActiveSheet ()->getCell ( $cell )->getValue ();
		        $coord = PHPExcel_Cell::coordinateFromString ( $cell );
		        $col = $coord [1] - 1;
		        $row = PHPExcel_Cell::columnIndexFromString ( $coord [0] ) - 1;
		        $coords [$col] [$row] = $value;
		    }
		    return $coords;
		}
}    


?>
