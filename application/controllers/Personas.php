<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Personas extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("personas/LogicaPersonas", "logicaPersonas");
       	$this->load->helper('language');
    	$this->lang->load('spanish');
    }
	public function getPersonas()	
	{
		if(validaInApp("web"))//esta validación me hará consultas más seguras
		{
			$respuesta = $this->logicaPersonas->getPersonas();
		}
		else
		{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 

		}
        echo json_encode($respuesta); 
	}
	public function agregaPersona()
	{

	}
}
?>