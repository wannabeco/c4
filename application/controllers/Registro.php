<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Registro extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("registro/LogicaRegistro", "logicaReg");
        $this->load->model("general/LogicaGeneral", "logicaGen");
       	$this->load->helper('language');
    	$this->lang->load('spanish');
    }
	public function index()	{
		$this->login();
	}
	public function registroEmpresas(){
		$salida['titulo'] = lang("tituloRegistroEmp");
		$salida['centro'] = "registro/empresas";
		$salida['listaDeptos']	=		getDepartamentos('057',"ARRAY");
		$this->load->view("registro/index",$salida);
	}
	public function registroPersonas(){
		$salida['titulo'] = lang("tituloRegistroEmp");
		$salida['centro'] = "registro/personas";
		$salida['listaDeptos']	=		getDepartamentos('057',"ARRAY");
		$this->load->view("registro/index",$salida);
	}

	//Funciones para el AJAX
	public function getCiudades(){
		if(validaInApp("web")){
			extract($_POST);
			$ciudades =  getCiudades('057',$idDepto,"JSON");
			echo $ciudades;
		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 

            echo json_encode($respuesta); 
		}
	}
	//crea empresa
	public function insertaEmpresas(){
		if(validaInApp("web")){
			$procesoEmpresa = $this->logicaReg->insertaEmpresa($_POST);
			echo json_encode($procesoEmpresa);
		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 
            echo json_encode($respuesta); 
		}
	}
	//inserta persona
	public function insertaPersonas(){
		if(validaInApp("web")){
			$procesoPersona = $this->logicaReg->insertaPersona($_POST);
			echo json_encode($procesoPersona);
		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 

            echo json_encode($respuesta); 
		}
	}
	//se inserta los datos de empresa creada desde el login
	public function insertaEmpresaNueva(){
		if(validaInApp("web")){
			$procesoEmpresa = $this->logicaReg->creaEmpresaNueva($_POST);
			echo json_encode($procesoEmpresa);
		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 
            echo json_encode($respuesta); 
		}
	}
	//crea usuario de oficial de cumplimiento
	public function creaOficial(){
			$procesoEmpresa = $this->logicaReg->creaOficial($_POST);
			echo json_encode($procesoEmpresa);
	}
}
?>