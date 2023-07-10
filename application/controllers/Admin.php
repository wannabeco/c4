<?php
/*

	("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por @orugal
   https://github.com/orugal
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller 
{
	private $privilegios = array();

	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");
        $this->load->model("admin/LogicaAdmin", "logicaAdmin");
       	$this->load->helper('language');
    	$this->lang->load('spanish');
	}

	
    /*
    * Funcion inicial del módulo de creación de módulos
    * @author Farez Prieto
    * @date 9 de Noviembre de 2016
    * @param $idModulo Este parámetro siempre lo enviará el menú y siempre se deberá recibir en la función del módulo principal, no olvidar esto.
    * Esta función permite inicializar este módulo, dentro de ella siempre se debe declarar la variable de session $_SESSION['moduloVisitado'] con el $idModulo Pasado por parámetro
    * y a continuación siempre se debe llamar la función del helper llamada getPrivilegios, la función está en el archivo helpers/funciones_helper.php
    * Tenga en cuenta que cada llamado ajax que haga a una plantilla gráfica que incluya botones de ver,editar, crear, borrar debe siempre llamar la función getPrivilegios.
    */
	public function adminModulos($idModulo)	
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
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "admin/adminModulos/home";
				$salida['infoModulo']  = $infoModulo[0];
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

	/*
	* Trae todo el listado de módulos para mostrar en la pantalla inicial
	*/
	public function getModulos()
	{
		$salida = array();
		if(validaIngreso())
		{
			//todos los módulos
			$modulos	      = $this->logica->getModulos();
			$salida = array("mensaje"=>"Módulos consultados",
							"continuar"=>1,
							"datos"=>$modulos);
		}
		else
		{
			$salida = array("mensaje"=>"No tiene Acceso a esta zona",
							"continuar"=>0,
							"datos"=>array());
		}
		echo json_encode($salida);
	}
	public function getModulosCompletos()
	{
		$salida = array();
		if(validaIngreso())
		{
			//todos los módulos
			$modulos	      = $this->logica->getModulosCompletos($_POST['padre']);
			$salida = array("mensaje"=>"Módulos consultados",
							"continuar"=>1,
							"datos"=>$modulos);
		}
		else
		{
			$salida = array("mensaje"=>"No tiene Acceso a esta zona",
							"continuar"=>0,
							"datos"=>array());
		}
		echo json_encode($salida);
	}
	/*
	* Agregar categorías de los módulos
	* @author Farez Prieto
	*/
	public function agregarCategoriaModulo()
	{
		$inserta = $this->logicaAdmin->agregarCategoriaModulo($_POST);
		echo json_encode($inserta);
	}
	
	public function editarCategoriaModulo()
	{
		$respuesta = $this->logicaAdmin->editarCategoria($_POST);
		echo json_encode($respuesta);
	}

	/*Carga de la plantilla de edición de los módulos*/
	public function cargaPlantillaCreacionModulos()
	{
		extract($_POST);
		if($edita == 1)
		{
			$infoModulo	      	 = $this->logica->infoModulo($id);
			$perfiles		  	 = $this->logica->consultaPerfilesPersist($id); 
			$salida["titulo"] 	 = "Editar el módulo ".$infoModulo[0]['nombreModulo'];
			$salida["datos"]  	 = $infoModulo[0];
			$salida["padre"]  	 = $padre;
			$salida["edita"]  	 = $edita;
			$salida["idEdita"] 	 = $id;
			$salida["labelBtn"]  = "EDITAR MÓDULO";
			$salida["perfiles"]  = $perfiles;
		}
		else
		{
			$perfiles		  	 = $this->logica->consultaPerfiles(); 
			$salida["titulo"] 	 = "Agregar nuevo módulo";
			$salida["datos"] 	 = array();
			$salida["edita"]  	 = $edita;
			$salida["idEdita"] 	 = "";
			$salida["padre"]  	 = $padre;
			$salida["perfiles"]  = $perfiles;
			$salida["labelBtn"]  = "CREAR MÓDULO";
		}
		echo $this->load->view("admin/adminModulos/creaModulo",$salida,true);
	}
	public function crearModulo()
	{
		$inserta = $this->logicaAdmin->crearModulo($_POST);
		echo json_encode($inserta);
	}

	public function agregarPrivilegio()
	{
		$inserta = $this->logicaAdmin->agregarPrivilegio($_POST);
		echo json_encode($inserta);
	}

	public function editarModulo()
	{
		$inserta = $this->logicaAdmin->editarModulo($_POST);
		echo json_encode($inserta);
	}

	public function estadoCategoriaModulo()
	{
		$inserta = $this->logicaAdmin->estadoCategoriaModulo($_POST);
		echo json_encode($inserta);
	}
}
?>