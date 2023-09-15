<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Areas extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("areas/LogicaAreas", "logicaAreas");
       	$this->load->helper('language');
    	$this->lang->load('spanish');
    }
	public function getAreas()	
	{
		if(validaInApp("web"))//esta validación me hará consultas más seguras
		{
			$respuesta = $this->logicaAreas->getAreas();
		}
		else
		{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 

		}
        echo json_encode($respuesta); 
	}
	public function creaNuevaArea()
	{
		if(validaInApp("web"))//esta validación me hará consultas más seguras
		{
			$respuesta = $this->logicaAreas->creaNuevaArea($_POST);
		}
		else
		{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 

		}
        echo json_encode($respuesta);
	}
	public function borrarArea()
	{
		if(validaInApp("web"))//esta validación me hará consultas más seguras
		{
			$respuesta = $this->logicaAreas->borrarArea($_POST);
		}
		else
		{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 

		}
        echo json_encode($respuesta);
	}
}
?>