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
class Usuarios extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");
        $this->load->model("admin/LogicaUsuarios", "logicaUsuarios");
		$this->load->model("misMatrices/LogicaMisMatrices", "logicaMis");
       	$this->load->helper('language');
    	$this->lang->load('spanish');
    }
    /*
    * Funcion inicial del módulo de creación de usuarios
    * @author Farez Prieto
    * @date 11 de Noviembre de 2016
    * @param $idModulo Este parámetro siempre lo enviará el menú y siempre se deberá recibir en la función del módulo principal, no olvidar esto.
    * Esta función permite inicializar este módulo, dentro de ella siempre se debe declarar la variable de session $_SESSION['moduloVisitado'] con el $idModulo Pasado por parámetro
    * y a continuación siempre se debe llamar la función del helper llamada getPrivilegios, la función está en el archivo helpers/funciones_helper.php
    * Tenga en cuenta que cada llamado ajax que haga a una plantilla gráfica que incluya botones de ver,editar, crear, borrar debe siempre llamar la función getPrivilegios.
    */
	public function adminUsuarios($idModulo){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1){ 	
				if($_SESSION["project"]["info"]["idPerfil"] == 11){
					$idEmpresa = $_SESSION["project"]["info"]["idEmpresa"];
					$infoEmprsa = $this->logicaMis->infoEmpresa($idEmpresa);
					$fechaCaduca = $infoEmprsa[0]["fechaCaducidad"];
					$hoy = date('Y-m-d H:i:s');
					if($hoy > $fechaCaduca ){
						if($idEmpresa > 0){
							redirect("PagoMatriz/PagoEmpresas");
						}
						if($idEmpresa == 0 ){
							$opc 				   = "home";
							$salida['titulo']      = "Pago Empresa";
							$salida['centro'] 	   = "error/areaRestringida";
							$this->load->view("app/index",$salida);
						}
					}
				}
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "admin/adminUsuarios/home";
				$salida['infoModulo']  = $infoModulo[0];
				$this->load->view("app/index",$salida);
			}else{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}else{
			header('Location:'.base_url()."login");
		}
	}
	public function getUsuarios(){	
		$idPerfil = $_SESSION['project']['info']['idPerfil'];
		if($idPerfil == 1 || $idPerfil == 2 || $idPerfil == 3){
			$usuarios	     = $this->logicaUsuarios->infoUsuario();
			echo json_encode($usuarios);
		}
		if($idPerfil == 11){
			$where = $_SESSION['project']['login']["idGeneral"];
			$dataUsuario	     = $this->logicaUsuarios->getinfoUsuario($where);
			echo json_encode($dataUsuario);
		}
	}
	//realiza el proceso de guardar o eliminar usuarios
	public function procesaUsuarios(){
		$proceso	     = $this->logicaUsuarios->procesaUsuarios($_POST);
		echo json_encode($proceso);
	}

	//realiza el proceso de guardar o eliminar usuarios
	public function borraUsuario(){
		$proceso	     = $this->logicaUsuarios->borraUsuario($_POST);
		echo json_encode($proceso);
	}
	//Genera el usuario y la clave de acceso para el usuario seleccionado
	public function generaDatosAcceso(){
		$proceso	     = $this->logicaUsuarios->generaDatosAcceso($_POST);
		echo json_encode($proceso);
	}

	public function cargaPlantillaCreacionUsuarios(){
		extract($_POST);
		//listados 
		$tiposDoc		  	 = $this->logica->consultatiposDoc(); 
		$sexo		  	 	 = $this->logica->consultaSexo(); 
		$profesiones  	 	 = $this->logica->consultaProfesiones(); 
		$cargos  	 	 	 = $this->logica->consultaCargos(); 
		$perfiles  	 	 	 = $this->logica->consultaPerfiles(); 
		$areas  	 	 	 = $this->logica->consultaAreas(); 
		$ciudades  	 	 	 = $this->logica->consultaCiudades(); 
		$eps 	 	 	 	 = $this->logica->consultaEPS(); 
		$afp 	 	 	 	 = $this->logica->consultaAFP(); 
		$cesantias 	 	 	 = $this->logica->consultaCesantias(); 


		$salida["selects"]   = array("tiposDoc"=>$tiposDoc,
									  "sexo"=>$sexo,
									  "profesiones"=>$profesiones,
									  "perfiles"=>$perfiles,
									  "areas"=>$areas,
									  "cargos"=>$cargos,
									  "ciudades"=>$ciudades,
									  "eps"=>$eps,
									  "afp"=>$afp,
									  "cesantias"=>$cesantias);
		if($edita == 1){
			$infoUsuario	     = $this->logicaUsuarios->infoUsuario($idUsuario);
			$salida["titulo"] 	 = "Editar el usuario ";
			$salida["datos"]  	 = $infoUsuario['datos'][0];
			$salida["idUsuario"] = $idUsuario;
			$salida["edita"]  	 = $edita;
			$salida["labelBtn"]  = "EDITAR USUARIO";
		}else{
			$salida["titulo"] 	 = "Agregar nuevo usuario";
			$salida["datos"] 	 = array();
			$salida["edita"]  	 = $edita;
			$salida["idUsuario"] = $idUsuario;
			$salida["labelBtn"]  = "CREAR USUARIO";
		}
		echo $this->load->view("admin/adminUsuarios/formControl",$salida,true);
	}
	//get departamentos
	public function getDepartamentos(){
		$pais = "057";
		$infodepartamentos	= $this->logicaUsuarios->infodepartamentos($pais);
		echo json_encode($infodepartamentos);
	}
	//consulta ciudades
	public function getCiudades(){
		$pais = "057";
		$departamento 	=	$_POST['departamento'];
		$infociudades	= $this->logicaUsuarios->infociudades($pais,$departamento);
		echo json_encode($infociudades);
	}
	//procesa empresa
	public function procesaEmpresa(){
		$proceso	     = $this->logicaUsuarios->procesaEmpresa($_POST);
		echo json_encode($proceso);
	}
}
?>