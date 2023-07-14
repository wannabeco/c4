<?php
/*

	("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por @orugal
   https://github.com/orugal

   Este archivo es el controlador que realizara al cuál se harán los llamados desde las url en la página o en los procesos AJAX que se utilicen.
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Empresas extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");//la idea es que este archivo siempre esté ya que aquí se consultan cosas que son muy globales.
		$this->load->model("empresas/LogicaEmpresas","lgEmpresas");
		$this->load->helper('language');//mantener siempre.
    	$this->lang->load('spanish');//mantener siempre.
    }
    /*
    * Funcion inicial del módulo de creación de usuarios
    * @author Farez Prieto
    * @date 17 de Noviembre de 2016
    * @param $idModulo Este parámetro siempre lo enviará el menú y siempre se deberá recibir en la función del módulo principal, no olvidar esto.
    * Esta función permite inicializar este módulo, dentro de ella siempre se debe declarar la variable de session $_SESSION['moduloVisitado'] con el $idModulo Pasado por parámetro
    * y a continuación siempre se debe llamar la función del helper llamada getPrivilegios, la función está en el archivo helpers/funciones_helper.php
    * Tenga en cuenta que cada llamado ajax que haga a una plantilla gráfica que incluya botones de ver,editar, crear, borrar debe siempre llamar la función getPrivilegios.
    */
	public function empresas($idModulo)	
	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso())
		{
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1)
			{ 	
				//var_dump($_SESSION['project']['info']);die();
				//info Módulo
				$infoModulo	      	   	= $this->logica->infoModulo($idModulo);
				//informacion solo para el oficial de cumplimiento
				if($_SESSION['project']['info']['idPerfil'] == 8 && $_SESSION['project']['info']['idEmpresa'] == 0){
					$infoUsuario		   	= $_SESSION['project']['info']['nombre'];
					$infoEmpresas		  	= $this->lgEmpresas->misEmpresas();
					$opc 				   	= "home";
					$salida['titulo']      	= "Empresas Agregadas";
					$salida['centro'] 	   	= "empresas/home";
					$salida['infoModulo']  	= $infoModulo[0];
					$salida['infoUsuario'] 	= $infoUsuario[0];
					$salida['infoEmpresas'] = $infoEmpresas;
					$this->load->view("app/index",$salida);
				}
				if($_SESSION['project']['info']['idPerfil'] == 8 && $_SESSION['project']['info']['idEmpresa'] > 0){
					$idEmpresa = $_SESSION['project']['info']['idEmpresa'];
					$infoUsuario		   	= $_SESSION['project']['info']['nombre'];
					$infoEmpresas		  	= $this->lgEmpresas->infoEmpresa($idEmpresa);
					$opc 				   	= "home";
					$salida['titulo']      	= "Empresas Creadas";
					$salida['centro'] 	   	= "empresas/home";
					$salida['infoModulo']  	= $infoModulo[0];
					$salida['infoUsuario'] 	= $infoUsuario[0];
					$salida['infoEmpresas'] = $infoEmpresas;
					$this->load->view("app/index",$salida);
				}
				if($_SESSION['project']['info']['idPerfil'] < 4){
					$infoUsuario		   	= $_SESSION['project']['info']['nombre'];
					$infoEmpresas		  	= $this->lgEmpresas->infoEmpresas();
					$opc 				   	= "home";
					$salida['titulo']      	= "Empresas Creadas";
					$salida['centro'] 	   	= "empresas/home";
					$salida['infoModulo']  	= $infoModulo[0];
					$salida['infoUsuario'] 	= $infoUsuario[0];
					$salida['infoEmpresas'] = $infoEmpresas;
					$this->load->view("app/index",$salida);
				}
			}
			else
			{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}
	//crear la nueva matriz
	public function eliminaEmpresa(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$procesoElimina = $this->lgEmpresas->eliminaEmpresa($_POST);
			echo json_encode($procesoElimina);
		}
		else{
            echo json_encode($procesoElimina); 
		}
	}
	//panel infromacion de la empresa
	public function empresa($idModulo,$parametro)	
	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso())
		{
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1)
			{ 
				//info Módulo
				$id =$parametro;
				$infoModulo	      	   			= $this->logica->infoModulo($idModulo);
				$infoUsuario		   			= $_SESSION['project']['info']['nombre'];
				$infoEmpresa		  			= $this->lgEmpresas->infoEmpresa($id);
				// $infoPais		  				= $this->lgEmpresas->infopaises();
				// $infoDepartamento		  		= $this->lgEmpresas->infodepartamentos($infoPais);
				// $infoCiudad		  				= $this->lgEmpresas->infociudades($infoPais,$infoDepartamento);
				$opc 				   			= "home";
				$salida['titulo']      			= lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   			= "empresas/index";
				$salida['infoModulo']  			= $infoModulo[0];
				$salida['infoUsuario'] 			= $infoUsuario[0];
				$salida['infoEmpresa'] 			= $infoEmpresa[0];
				
				$this->load->view("app/index",$salida);
			}
			else
			{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}
	//elimina relacionde empresa
	public function eliminaRel(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$procesoElimina = $this->lgEmpresas->eliminaRel($_POST);
			echo json_encode($procesoElimina);
		}
		else{
            echo json_encode($procesoElimina); 
		}
	}
	//formulario relacion de empresa con oficial de cumplimiento
	public function creaRelacion(){
		extract($_POST);
		$infoEmpresas		  	= $this->lgEmpresas->infoEmpresas();
		$opc 				   	= "home";
		$salida["infoEmpresas"] = $infoEmpresas;
		$salida['titulo']      	= "Agregar empresa";
		echo $this->load->view("empresas/creaRelacion",$salida,true);
	}
	//crea relacion de empresa con oficial de cumplimiento
	public function crearRel(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$crea = $this->lgEmpresas->crearRel($_POST);
			echo json_encode($crea);
		}
		else{
            echo json_encode($crea); 
		}
	}
	public function matrices($idModulo,$parametro)	
	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso())
		{
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1)
			{ 
				//info Módulo
				$id =$parametro;
				$infoModulo	      	   			= $this->logica->infoModulo($idModulo);
				$MatricesCompradas		  		= $this->lgEmpresas->infoMatricesCompradas($id);
				$infoEmpresas		  			= $this->lgEmpresas->infoEmpresa($id);
				// var_dump($infoEmpresas[0]);die();
				$opc 				   			= "home";
				$salida['titulo']      			= lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   			= "misMatrices/home";
				$salida['infoModulo']  			= $infoModulo[0];
				$salida['inforMiMatriz']    	= $MatricesCompradas;
				$salida['infor']				= $MatricesCompradas["datos"];
				$salida['infoEmpresas']    		= $infoEmpresas[0];
				$salida["id"]					= $id;
				$this->load->view("app/index",$salida);
			}
			else
			{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}

}
?>