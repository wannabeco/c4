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
class crearMatriz extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");
        $this->load->model("admin/LogicaAdmin", "logicaAdmin");
        $this->load->model("crearMatriz/LogicaMatriz","logMatriz");
       	$this->load->helper('language');
    	$this->lang->load('spanish');
		$this->load->database();
		$this->load->library('grocery_CRUD');
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
	public function crearParametrosMatriz($idModulo)	
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
				$salida['centro'] 	   = "crearMatriz/home";
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
	public function creaNuevaMatriz($idModulo)	
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
				$infoModulo	      	   		= $this->logica->infoModulo($idModulo);
				$infoTipoEmpresa			= $this->logMatriz->infoTipoEmpresa();
				$opc 				   		= "home";
				$salida['titulo']      		= lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   		= "crearMatriz/index";
				$salida['infoModulo']  		= $infoModulo[0];
				$salida['infoTipoEmpresa']  = $infoTipoEmpresa;
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
	public function parametrosMatriz($idModulo)	
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
				$infoModulo	      	   		= $this->logica->infoModulo($idModulo);
				$infoProceso				= $this->logMatriz->infoProceso();
				$infoFuenteRiesgo			= $this->logMatriz->infoFuenteRiesgo();
				$infoFactorEspecifico		= $this->logMatriz->infoFactorEspecifico();
				$infoDescripcionR			= $this->logMatriz->infoDescripcionR();
				$infoCausas					= $this->logMatriz->infoCausas();
				$infoTipoRiesgo				= $this->logMatriz->infoTipoRiesgo();
				$infoRiesgoAsociado			= $this->logMatriz->infoRiesgoAsociado();
				$infoConsecuencias			= $this->logMatriz->infoConsecuencias();
				$infoTipoEmpresa			= $this->logMatriz->infoTipoEmpresa();
				$opc 				   			= "home";
				$salida['titulo']      			= lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   			= "crearMatriz/index";
				$salida['infoModulo']  			= $infoModulo[0];
				$salida['infoProceso']  		= $infoProceso;
				$salida['infoFuenteRiesgo']  	= $infoFuenteRiesgo;
				$salida['infoFactorEspecifico'] = $infoFactorEspecifico;
				$salida['infoDescripcionR']  	= $infoDescripcionR;
				$salida['infoCausas']  			= $infoCausas;
				$salida['infoTipoRiesgo']  		= $infoTipoRiesgo;
				$salida['infoRiesgoAsociado']  	= $infoRiesgoAsociado;
				$salida['infoConsecuencias']  	= $infoConsecuencias;
				$salida['infoTipoEmpresa']  	= $infoTipoEmpresa;
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
	//Descripcion de riesgos
	public function descripcionRiesgo($idModulo)	
	{
		//ini_set("display_errors",'1');
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
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_descripcion_riesgos');
					$crud->set_subject('descripción de riesgo');
					//$crud->set_subject('Office');
					$crud->required_fields('descripcionRiesgos','estado');
					$crud->display_as('descripcionRiesgos','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('descripcionRiesgos','estado');
					$crud->fields('descripcionRiesgos','estado');
					$crud->unset_texteditor('descripcionRiesgos');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Descripción de riesgo";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
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
	//tipo de riesgos
	public function tipoRiesgo($idModulo)	
	{
		//ini_set("display_errors",'1');
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
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_tipo_riesgo');
					$crud->set_subject('tipo de riesgo');
					//$crud->set_subject('Office');
					$crud->required_fields('descripcionTipoRiesgo','estado');
					$crud->display_as('descripcionTipoRiesgo','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('descripcionTipoRiesgo','estado');
					$crud->fields('descripcionTipoRiesgo','estado');
					$crud->unset_texteditor('descripcionTipoRiesgo');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Tipo de riesgo";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
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
	//riesgos Asociados
	public function riesgoAsociado($idModulo)	
	{
		//ini_set("display_errors",'1');
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
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_riesgos_asociados');
					$crud->set_subject('riesgos asociados');
					//$crud->set_subject('Office');
					$crud->required_fields('descripcionRiesgos','estado');
					$crud->display_as('descripcionRiesgos','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('descripcionRiesgos','estado');
					$crud->fields('descripcionRiesgos','estado');
					$crud->unset_texteditor('descripcionRiesgos');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Riesgos asociados";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
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
	//consecuencias
	public function consecuencias($idModulo)	
	{
		//ini_set("display_errors",'1');
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
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_consecuencias');
					$crud->set_subject('consecuencias');
					//$crud->set_subject('Office');
					$crud->required_fields('descripcionConsecuencias','estado');
					$crud->display_as('descripcionConsecuencias','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('descripcionConsecuencias','estado');
					$crud->fields('descripcionConsecuencias','estado');
					$crud->unset_texteditor('descripcionConsecuencias');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Consecuencias";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
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
	//procesos
	public function procesos($idModulo)	
	{
		//ini_set("display_errors",'1');
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
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_procesos');
					$crud->set_subject('procesos');
					//$crud->set_subject('Office');
					$crud->required_fields('descripcionProcesos','estado');
					$crud->display_as('descripcionProcesos','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('descripcionProcesos','estado');
					$crud->fields('descripcionProcesos','estado');
					$crud->unset_texteditor('descripcionProcesos');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Procesos";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
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
	//procesos
	public function tipoEmpresa($idModulo)	
	{
		//ini_set("display_errors",'1');
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
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_tipo_empresa');
					$crud->set_subject('tipo empresa');
					//$crud->set_subject('Office');
					$crud->required_fields('TipoEmpresa','estado');
					$crud->display_as('TipoEmpresa','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('TipoEmpresa','estado');
					$crud->fields('TipoEmpresa','estado');
					$crud->unset_texteditor('TipoEmpresa');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Tipo empresas";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
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
	//fuente Riesgo
	public function fuenteRiesgo($idModulo)	
	{
		//ini_set("display_errors",'1');
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
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_fuente_riesgo');
					$crud->set_subject('fuente de riesgo');
					//$crud->set_subject('Office');
					$crud->required_fields('descripcionFuenteRiesgos','estado');
					$crud->display_as('descripcionFuenteRiesgos','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('descripcionFuenteRiesgos','estado');
					$crud->fields('descripcionFuenteRiesgos','estado');
					$crud->unset_texteditor('descripcionFuenteRiesgos');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Fuente de riesgo";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
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
	//Factor Especifico
	public function factorEspecifico($idModulo)	
	{
		//ini_set("display_errors",'1');
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
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_factor_especifico');
					$crud->set_subject('factor especifico');
					//$crud->set_subject('Office');
					$crud->required_fields('descripcionFactorEspecifico','estado');
					$crud->display_as('descripcionFactorEspecifico','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('descripcionFactorEspecifico','estado');
					$crud->fields('descripcionFactorEspecifico','estado');
					$crud->unset_texteditor('descripcionFactorEspecifico');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Factor especifico";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
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
	//causas
	public function causas($idModulo)	
	{
		//ini_set("display_errors",'1');
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
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_causas');
					$crud->set_subject('causas');
					//$crud->set_subject('Office');
					$crud->required_fields('descripcionCausa','estado');
					$crud->display_as('descripcionCausa','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('descripcionCausa','estado');
					$crud->fields('descripcionCausa','estado');
					$crud->unset_texteditor('descripcionCausa');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Causas";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
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
	//entidades
	public function entidades($idModulo)	
	{
		//ini_set("display_errors",'1');
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
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_entidades');
					$crud->set_subject('entidades');
					//$crud->set_subject('Office');
					$crud->required_fields('nombreEntidades','estado');
					$crud->display_as('nombreEntidades','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('nombreEntidades','estado');
					$crud->fields('nombreEntidades','estado');
					$crud->unset_texteditor('nombreEntidades');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Entidades";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
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
	//frecuencia de ejecucion
	public function fejecucion($idModulo)	
	{
		//ini_set("display_errors",'1');
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
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_frecuencia_ejecucion');
					$crud->set_subject('frecuencia de ejecución');
					//$crud->set_subject('Office');
					$crud->required_fields('nombreFrecuencaiEjecucion','estado');
					$crud->display_as('nombreFrecuencaiEjecucion','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('nombreFrecuencaiEjecucion','estado');
					$crud->fields('nombreFrecuencaiEjecucion','estado');
					$crud->unset_texteditor('nombreFrecuencaiEjecucion');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Frecuencia de ejecución";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
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
	public function aplicaccsm($idModulo)	
	{
		//ini_set("display_errors",'1');
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
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_ccsm');
					$crud->set_subject('aplica para ccsm');
					//$crud->set_subject('Office');
					$crud->required_fields('nombreCcsm','estado');
					$crud->display_as('nombreCcsm','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('nombreCcsm','estado');
					$crud->fields('nombreCcsm','estado');
					$crud->unset_texteditor('nombreCcsm');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Aplica para ccsm";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
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
	//cuando aplique
	public function cuandoAplique($idModulo)	
	{
		//ini_set("display_errors",'1');
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
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_cuando_aplique');
					$crud->set_subject('cuando aplique');
					//$crud->set_subject('Office');
					$crud->required_fields('nombreCuandoAplique','estado');
					$crud->display_as('nombreCuandoAplique','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('nombreCuandoAplique','estado');
					$crud->fields('nombreCuandoAplique','estado');
					$crud->unset_texteditor('nombreCuandoAplique');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Cuando aplique";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
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
	//metodologia de control
	public function metodoControl($idModulo){
		//ini_set("display_errors",'1');
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1){ 
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_metodo_control');
					$crud->set_subject('metodologia de control');
					//$crud->set_subject('Office');
					$crud->required_fields('nombreMetodoControl','estado');
					$crud->display_as('nombreMetodoControl','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('nombreMetodoControl','estado');
					$crud->fields('nombreMetodoControl','estado');
					$crud->unset_texteditor('nombreMetodoControl');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Metodologia de control";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
				$salida['infoModulo']  = $infoModulo[0];
				$this->load->view("app/index",$salida);
			}
			else{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}
		else{
			header('Location:'.base_url()."login");
		}
	}
	//tabla Periodicidad
	public function Periodicidad($idModulo){
		//ini_set("display_errors",'1');
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1){ 
				try{
					$crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('app_periodicidad');
					$crud->set_subject('metodologia de control');
					//$crud->set_subject('Office');
					$crud->required_fields('nombrePeriodicidad','estado');
					$crud->display_as('nombrePeriodicidad','Nombre');
					$crud->set_relation('estado','app_estados','nombreEstado');
					$crud->columns('nombrePeriodicidad','estado');
					$crud->fields('nombrePeriodicidad','estado');
					$crud->unset_texteditor('nombrePeriodicidad');
					$crud->unset_clone();
						
						$output = $crud->render();
						
					}catch(Exception $e){
						show_error($e->getMessage().' --- '.$e->getTraceAsString());
					}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Metodologia de control";
				$salida['output'] 	   = $output;
				$salida['centro'] 	   = 'admin/centroEstandarMa';
				$salida['infoModulo']  = $infoModulo[0];
				$this->load->view("app/index",$salida);
			}
			else{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}
		else{
			header('Location:'.base_url()."login");
		}
	}
	//crear matriz
	public function creaLaMatriz(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			
			$procesoEmpresa = $this->logMatriz->creaLaMatriz($_POST);
			echo json_encode($procesoEmpresa);
		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 
            echo json_encode($respuesta); 
		}
	}
	//crear la nueva matriz
	public function creaLaNuevaMatriz(){
		if(validaInApp("web")){//esta validación me hará consultas más segura	
			$procesoEmpresa = $this->logMatriz->creaNuevaMatriz($_POST);
			echo json_encode($procesoEmpresa);
		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 
            echo json_encode($respuesta); 
		}
	}
	//prametrizacion de matrices
	public function parametrizaciones(){
		extract($_POST);
		$edita = $_POST["edita"];
		$id = $_POST["idNuevaMatriz"];

		$entidades				= $this->logMatriz->entidades();
		$frecuenciaejecucion    = $this->logMatriz->frecuenciaejecucion();
		$cuandoAplique   	 	= $this->logMatriz->cuandoAplique();
		$responsable   	 		= $this->logMatriz->responsable();
		$aplicaCcsm   	 		= $this->logMatriz->aplicaCcsm();
		$metodoControl   	 	= $this->logMatriz->metodoControl();
		$periodicidad   	 	= $this->logMatriz->periodicidad();
		$estados   	 			= $this->logMatriz->estados();
		

		if($edita == 1){
			$infoMatriz				= $this->logMatriz->infoMatrizporID($id);
			$salida["titulo"] 	 	= "Editar Parametro";
			$salida["datos"]  	 	= $infoMatriz;
			$salida["infoMatriz"] 	= $infoMatriz;
			$salida["edita"]  	 	= 1;
			$salida["labelBtn"]  	= "Editar matriz";
		}
		else{
			$infoMatriz					= $this->logMatriz->infoNuevaMatriz($id);
			$info = $infoMatriz;
			$salida["titulo"] 	 		= "Parametrizacion";
			$salida["datos"] 	 		= array();
			$salida["edita"]  	 		= 0;
			$salida["labelBtn"]  		= "Crea parametros";
			$salida["infoMatriz"]   	= $info;
		}
		$salida["estados"]   	    	= $estados;
		$salida["entidades"]   			= $entidades;
		$salida["frecuenciaejecucion"]  = $frecuenciaejecucion;
		$salida["cuandoAplique"]   		= $cuandoAplique;
		$salida["responsable"]   		= $responsable;
		$salida["aplicaCcsm"]   		= $aplicaCcsm;
		$salida["metodoControl"]   		= $metodoControl;
		$salida["periodicidad"]   		= $periodicidad;
		$salida["id"]   				= $id;
		echo $this->load->view("MatricesCreadas/formControl",$salida,true);
	}
	//actualiza matriz
	//prametrizacion de matrices
	public function actualizaMatriz(){
		extract($_POST);
		$id = $_POST["idNuevaMatriz"];
		$informacionMatriz				= $this->logMatriz->informacionMatriz($id);
		$infoTipoEmpresa			= $this->logMatriz->infoTipoEmpresa();
		if($informacionMatriz[0]["dirigida"] == 2){
			$relacion					= $this->logMatriz->relacionEspecifica($id);
			$salida["relaciones"]   		= $relacion;
		}
		$dirigida						= $this->logMatriz->dirigida();
		$estados   	 					= $this->logMatriz->estados();
		$salida["titulo"] 	 			= "Actualizacón de matriz";
		$salida["informacionMatriz"]   	= $informacionMatriz;
		$salida["estados"]   	    	= $estados;
		$salida["dirigida"]   			= $dirigida;
		$salida["infoTipoEmpresa"]   	= $infoTipoEmpresa;
		$salida["id"]   				= $id;
		echo $this->load->view("MatricesCreadas/formMatriz",$salida,true);
	}
	//formulario de checkeo
	public function formCheck(){
		extract($_POST);
		$idPerfil = $_SESSION["project"]["info"]["idPerfil"];
		$id 						= $_POST["idNuevaMatriz"];
		$idPerdona 					= $_SESSION['project']['info']['idPersona'];
		$fecha 						= date("F j, Y");
		$infoUsuario				= $this->logMatriz->infoUsuario($idPerdona);
		$infoMatrizRecurrentes		= $this->logMatriz->infoMatrizRecurrentes($id);
		//var_dump($infoMatrizRecurrentes);die();
		$salida["titulo"] 	 		= "Formulario de checkeo";
		$salida['infoUsuario']		= $infoUsuario;
		$salida['fecha']			= $fecha;
		$salida['idNuevaMatriz']	= $idNuevaMatriz;
		$salida['informacion']		= $infoMatrizRecurrentes[0];
		echo $this->load->view("MatricesCreadas/formCheck",$salida,true);
	}
	//tipo de matrices
	public function infoTipoMatriz(){
		if(validaInApp("web")){
			$informacionMatriz	= $this->logMatriz->informacionMatrizDos($_POST);
			echo json_encode($informacionMatriz);
		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 
            echo json_encode($respuesta); 
		}
	}


	//crea parametros en la matriz
	public function crearParametros(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			if($_POST["edita"] == 1){

				$proceso = $this->logMatriz->actualizaParametros($_POST);
				echo json_encode($proceso);
			}
			else{
				$proceso = $this->logMatriz->crearParametros($_POST);
				echo json_encode($proceso);
			}
		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 
            echo json_encode($respuesta); 
		}
	}
	//se asignan Tipos de empresas
	public function asigTiposEmpresa(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras

				$proceso = $this->logMatriz->asigTiposEmpresa($_POST);
				echo json_encode($proceso);

		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 
            echo json_encode($respuesta); 
		}
	}
	//actualizo matriz general
	public function actualizaMatrizGeneral(){
		if(validaInApp("web")){
			$proceso = $this->logMatriz->actualizaMatrizGeneral($_POST);
			echo json_encode($proceso);

		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
							"continuar"=>0,
							"datos"=>""); 
			echo json_encode($respuesta); 
		}
	}
	//elimina relacion de matrices
	public function eliminaRelacion(){
		if(validaInApp("web")){
			$proceso = $this->logMatriz->eliminaRelacion($_POST);
			echo json_encode($proceso);

		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
							"continuar"=>0,
							"datos"=>""); 
			echo json_encode($respuesta); 
		}
	}
	public function agregaRelacion(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
				$proceso = $this->logMatriz->asigTiposEmpresa($_POST);
				echo json_encode($proceso);

		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 
            echo json_encode($respuesta); 
		}
	}
}
?>