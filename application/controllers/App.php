<?php
/*

	("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por  @orugal
   https://github.com/orugal
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class App extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        //$this->load->model("principal/LogicaAreas", "logica");
       	$this->load->helper('language');
    	$this->lang->load('spanish');
    }
	public function index()	
	{	
		if(validaIngreso())
		{
			$opc = "home";
			$salida['titulo'] = lang("titulo");
			$salida['centro'] = "app/home";
			$this->load->view("app/index",$salida);
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}	
	public function menuEmpresa($opc)
	{
		$salida['menu']   = "app/menu";
		$salida['opc']    = $opc;
		return $this->load->view("app/menu",$salida,true);
	}
	public function areas()	
	{
		if(validaIngreso())
		{
			$opc 			  = "areas"	;//persistencia del menú
			$salida['titulo'] = lang("titulo")." - ".lang("tituloArea");
			$salida['centro'] = "app/areas/home";
			$salida['menu']   =  $this->menuEmpresa($opc);
			$this->load->view("app/index",$salida);
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}
	public function personas()	
	{
		if(validaIngreso())
		{
			
			$opc 			  = "personas"	;//persistencia del menú
			$salida['titulo'] = lang("tituloPersonas");
			$salida['centro'] = "app/personas/home";
			$salida['menu']   =  $this->menuEmpresa($opc);
			$this->load->view("app/index",$salida);
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}
	public function proyectos()	
	{
		if(validaIngreso())
		{

			$opc 			  = "proyectos"	;//persistencia del menú
			$salida['titulo'] = lang("titulo");
			$salida['centro'] = "app/tareas/home";
			$salida['menu']   =  $this->menuEmpresa($opc);
			$this->load->view("app/index",$salida);
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}
	public function infoProyecto()	
	{
		if(validaIngreso())
		{
			$opc 			  = "proyectos"	;//persistencia del menú
			$salida['titulo'] = lang("titulo");
			$salida['centro'] = "app/tareas/infoProyecto";
			$salida['menu']   =  $this->menuEmpresa($opc);
			$this->load->view("app/index",$salida);
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}
	public function reportes()	
	{
		if(validaIngreso())
		{
			$opc 			  = "reportes"	;//persistencia del menú
			$salida['titulo'] = lang("titulo");
			$salida['centro'] = "app/home";
			$salida['menu']   =  $this->menuEmpresa($opc);
			$this->load->view("app/index",$salida);
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}
	public function configuracion()	
	{
		if(validaIngreso())
		{
			$salida['titulo'] = lang("titulo");
			$salida['centro'] = "app/home";
			$salida['menu']   =  $this->menuEmpresa();
			$this->load->view("app/index",$salida);
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}
}
?>