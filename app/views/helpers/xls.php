<?php
/**
 * This xls helper is based on the one at
 * http://ykyuen.wordpress.com/2009/10/04/cakephp-export-data-to-a-xls-file/
 * actually creates an xml which is openable in Microsoft Excel.
 * Extended by Nik Chankov 
 * Originally written by Yuen Ying Kit @ ykyuen.wordpress.com
 *
 */
class XlsHelper extends AppHelper {
    /**
     * set the header of the http response.
     *
     * @param unknown_type $filename
     */
    function setHeader($filename) {
        header("Pragma: public");
        header("Expires: 0");
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Type: application/force-download");
        header("Content-Type: application/download");;
        header("Content-Disposition: inline; filename=\"".$filename.".xls\"");
    }

    /**
     * Return the workbook
     * @param string $content content of the wrkbook
     * @return string
     */
    function workbook($content) {
        $ret = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $ret .= '<?mso-application progid="Excel.Sheet"?>'."\n";
        $ret .= '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
             xmlns:o="urn:schemas-microsoft-com:office:office"
             xmlns:x="urn:schemas-microsoft-com:office:excel"
             xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
             xmlns:html="http://www.w3.org/TR/REC-html40">
            '."\n";
        $ret .= '<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">'."\n";
        $ret .= "\t".'<Created>'.date('Y').'-'.date('m').'-'.date('d').'T'.date('H').':'.date('i').':'.date('s').'Z</Created>'."\n";
        $ret .= "\t".'<Company>Your company name</Company>'."\n";
        $ret .= "\t".'<Version>1.00</Version>'."\n";
        $ret .= '</DocumentProperties>'."\n";
        $ret .= '<Styles>'."\n";
        $ret .= '<Style ss:ID="Default" ss:Name="Normal">'."\n";
        $ret .= '<Alignment ss:Vertical="Bottom"/>'."\n";
        $ret .= '<Borders/>'."\n";
        $ret .= '<Font/>'."\n";
        $ret .= '<Interior/>'."\n";
        $ret .= '<NumberFormat/>'."\n";
        $ret .= '<Protection/>'."\n";
        $ret .= '</Style>'."\n";
        $ret .= '<Style ss:ID="s23">'."\n";
        $ret .= '<Font x:Family="Swiss" ss:Bold="1"/>'."\n";
        $ret .= '</Style>'."\n";
        $ret .= '</Styles>'."\n";
        $ret .= $content;
        $ret .= '</Workbook>'."\n";
        return $ret;
    }

    /**
     * Add worksheet
     * @param string $name name of the Worksheet
     * @param string $content content of the worlsheet
     * @return string
     */
    function worksheet($name, $content) {
        $ret = "\t".'<Worksheet ss:Name="'.$name.'">'."\n";
        $ret .= "\t\t".'<Table>'."\n";
        $ret .= $content;
        $ret .= "\t\t".'</Table>'."\n";
        $ret .= "\t".'</Worksheet>'."\n";
        return $ret;
    }

    /**
     * Create a row
     * @param string $content content of the worlsheet
     * @return string
     */
    function row($content) {
        $ret = "\t\t\t".'<Row>'."\n";
        $ret .= $content;
        $ret .= "\t\t\t".'</Row>'."\n";
        return $ret;
    }

    /**
     * Create a cell
     * @param mixed $value value of the cell
     * @param string $type type of the cell. For now it can be either String or Number
     * @return string
     */
    function cell($value, $type = 'String') {
        if (is_null($value)) {
            $ret = "\t\t\t\t".'<Cell><Data ss:Type="String"> </Data></Cell>'."\n";
        } else {
            $ret = "\t\t\t\t".'<Cell><Data ss:Type="'.$type.'">'.$value.'</Data></Cell>'."\n";
        }
        return $ret;
    }
    
    /**
     * Create header cell with bold text
     * The function is the same as this->cell, but bolded
     * @param mixed $value value of the cell
     * @param string $type type of the cell. For now it can be either String or Number
     * @return string
     */
    function hcell($value, $type = 'String') {
        if (is_null($value)) {
            $ret = "\t\t\t\t".'<Cell ss:StyleID="s23"><Data ss:Type="String"> </Data></Cell>'."\n";
        } else {
            $ret = "\t\t\t\t".'<Cell ss:StyleID="s23"><Data ss:Type="'.$type.'">'.$value.'</Data></Cell>'."\n";
        }
        return $ret;
    }
}
?>
