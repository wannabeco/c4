<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH."/libraries/lib_excel/Classes/PHPExcel.php";
class excel extends PHPExcel{
  public function __construct()
  {
    parent::__construct();
  }
  public function importarExcel($archivo)
  {
    	//Cargar PHPExcel library
       // $this->load->library('excel');
    	/*$name   = $archivo['name'];
     	$tname  = $archivo['tmp_name'];*/
     	ini_set('memory_limit', '-1');

        $obj_excel = PHPExcel_IOFactory::load($archivo);       
       	$sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
       	$arr_datos = array();
       	//var_dump($sheetData);
       	return $sheetData;
    }

    public function some_method()
    {
    	echo "hi";
    }

}
?>