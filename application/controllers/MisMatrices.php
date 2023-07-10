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
class MisMatrices extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");//la idea es que este archivo siempre esté ya que aquí se consultan cosas que son muy globales.
        $this->load->model("misMatrices/LogicaMisMatrices", "logicaMis");//aquí se debe llamar la lógica correspondiente al módulo que se esté haciendo.
		$this->load->model("crearMatriz/LogicaMatriz","logMatriz");
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
	public function matrices($idModulo)	
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
			if(getPrivilegios()[0]['ver'] == 1){ 		
					//variables para la consulta
					$idPerfil = $_SESSION["project"]["info"]["idPerfil"];
					$idPersona = $_SESSION["project"]["info"]["idPersona"];
					$idEmpresa =$_SESSION["project"]["info"]["idEmpresa"];

					if($idPerfil == 11){
						//info Módulo
						$infoModulo	      	   		= $this->logica->infoModulo($idModulo);
						$relacion					= $this->logicaMis->consultaRelacion($idEmpresa);
						$inforMiMatriz				= $this->logicaMis->consultaMatricescompradas($idPersona,$idEmpresa);
						$salida['inforMiMatriz']	= $inforMiMatriz;
						$salida['infor']			= $inforMiMatriz["datos"];
					}
					else if($idPerfil < 4 || $idPerfil != 11){
						//info Módulo
						$infoModulo	      	   		= $this->logica->infoModulo($idModulo);
						$relacion					= $this->logicaMis->consultaRelacion($idEmpresa);
						$tipoEmpresa = $relacion[0]["tipoEmpresa"];
						$inforMiMatriz				= $this->logicaMis->consultaMatriz($idPerfil,$tipoEmpresa);
						$salida['inforMiMatriz']	= $inforMiMatriz;
					}
						$opc 				   		= "home";
						$salida['titulo']      		= "Matrices";
						$salida['centro'] 	   		= "misMatrices/home";
						$salida['infoModulo']  		= $infoModulo[0];
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
	//modal informacion de matriz asignada
	public function miMatriz(){
		extract($_POST);
		$id = $_POST["idNuevaMatriz"];
		//$infoMatriz					= $this->logMatriz->infoNuevaMatriz($id);
		$salida["titulo"] 	 		= "Información de obligacón";
		$salida["datos"] 	 		= array();
		$salida["edita"]  	 		= 0;
		$salida["labelBtn"]  		= "Crea parametros";
		//$salida["infoMatriz"]   	= $infoMatriz;
		$salida["id"]   				= $id;
		echo $this->load->view("misMatrices/index",$salida,true);
	}
	//informacion interna de la matriz
	public function informacion($idModulo,$parametro)	
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
				$idPerfil = $_SESSION["project"]["info"]["idPerfil"];
				if( $idPerfil == 11){
					
					//info Módulo
					$id =$parametro;
					$infoModulo	      	   			= $this->logica->infoModulo($idModulo);
					$infoUsuario		   			= $_SESSION['project']['info']['nombre'];
					$idPersona						= $_SESSION['project']['info']['idPersona'];
					$infoMatrizRecurrentes			= $this->logMatriz->infoMatrizRecurrentes($id);
					$infoMatrices		  			= $this->logMatriz->infoGeneralMatriz();
					$idrecurrente					= $infoMatrizRecurrentes[0]["idMatrizRecurrente"];
					$infoComentarios				= $this->logMatriz->infoComentarios($idrecurrente,$idPersona);
					$opc 				   			= "home";
					$salida['titulo']      			= lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
					$salida['centro'] 	   			= "MatricesCreadas/infoMatriz";
					$salida['infoModulo']  			= $infoModulo[0];
					$salida['infoUsuario'] 			= $infoUsuario[0];
					$salida['infoMatrices'] 		= $infoMatrices[0];
					$salida['infoMatrizRecurrentes']= $infoMatrizRecurrentes;
					//$salida["infoComentarios"] 		= $infoComentarios;
					
				 	if($infoComentarios["continuar"] == 1){
				 		$salida["infoComentarios"] 		= $infoComentarios;
				    }else{
				 	   $salida["infoComentarios"] 		= $infoComentarios;
				    }
					$salida["idNuevaMatriz"] 		= $id;
					$this->load->view("app/index",$salida);
				}
				else if($idPerfil > 3 && $idPerfil != 11){
					
					$id =$parametro;
					$infoModulo	      	   			= $this->logica->infoModulo($idModulo);
					$infoUsuario		   			= $_SESSION['project']['info']['nombre'];
					$idPersona						= $_SESSION['project']['info']['idPersona'];
					$infoMatrizRecurrentes			= $this->logMatriz->infoMatrizRecurrentesDos($id,$idPerfil);
					$infoMatrices		  			= $this->logMatriz->infoGeneralMatriz();
					$idrecurrente					=$infoMatrizRecurrentes[0]["idMatrizRecurrente"];
					$infoComentarios				= $this->logMatriz->infoComentarios($idrecurrente,$idPersona);
					$opc 				   			= "home";
					$salida['titulo']      			= lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
					$salida['infoModulo']  			= $infoModulo[0];
					$salida['infoUsuario'] 			= $infoUsuario[0];
					$salida['infoMatrices'] 		= $infoMatrices;
					$salida['infoMatrizRecurrentes']= $infoMatrizRecurrentes;
					$salida["id"] 					= $id;
					$salida["idPerfil"] 			= $idPerfil;
					if($infoComentarios["continuar"] == 1){
					 	$salida["infoComentarios"] 		= $infoComentarios;
					}else if($infoComentarios["continuar"] == 0){
						$salida["infoComentarios"] 		= $infoComentarios;
					}
					$salida['centro'] 	   			= "MatricesCreadas/infoMatriz";
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
	//agrega nuevo checkeo
	public function nuevocheck(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$procesoCrea = $this->logMatriz->creaCheckeo($_POST);
			echo json_encode($procesoCrea);
		}
		else{
			$respuesta="nada";
            echo json_encode($respuesta); 
		}
	}
	public function consultaMatrices(){
		$idPersona = $_SESSION["project"]["info"]["idPersona"];
		$idEmpresa = $_SESSION["project"]["info"]["idEmpresa"];
		$inforMiMatriz = $this->logicaMis->consultaMatricescompradas($idPersona, $idEmpresa);
		$infoMatrices = $this->logicaMis->infoMatrices();
		$opc = "home";
		$salida['titulo'] = "Matrices Creadas";
		$salida['inforMiMatriz'] = $inforMiMatriz;
		$salida['infoMatrices'] = $infoMatrices;
		$salida['centro'] = "misMatrices/creadas";
		$this->load->view("app/index",$salida);
	}
	//consulta matrices creadas
	public function matricesCreadas() {
			$infoMatriceslike = "";
			if (isset($_POST["buscar"])) {
				$buscar = $_POST["buscar"];
				$infoMatriceslike = $this->logicaMis->infoMatriceslike($buscar);
			}
			$idPersona = $_SESSION["project"]["info"]["idPersona"];
			$idEmpresa = $_SESSION["project"]["info"]["idEmpresa"];
			$inforMiMatriz = $this->logicaMis->consultaMatricescompradas($idPersona, $idEmpresa);
			$infoMatrices = [];
			if ($infoMatriceslike > 0){
				$infoMatrices = $infoMatriceslike;
				$response =array(
					"infoMatrices" =>$infoMatrices,
					"inforMiMatriz" =>$inforMiMatriz,
				);
			} else {
				$infoMatrices = $this->logicaMis->infoMatrices();
				$response =array(
					"infoMatrices" =>$infoMatrices,
					"inforMiMatriz" =>$inforMiMatriz,
				);
				echo json_encode($response); 
			}
			$opc = "home";
			$salida['titulo'] = "Matrices Creadas";
			$salida['inforMiMatriz'] = $inforMiMatriz;
			$salida['infoMatrices'] = $infoMatrices;
			$salida['centro'] = "misMatrices/creadas";
			$this->load->view("app/index",$salida);
	}

	//crea las primeras 3 matrices
	public function creaGratis() {
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			// var_dump($_POST);die();
			$proceso = $this->logicaMis->creaGratis($_POST);
			echo json_encode($proceso); 
		}
		else{
			$proceso ="nada";
			echo json_encode($proceso); 
		}
	}
	//verificar si la empresa ya cuenta con las matrices.
	public function getMatricesEmpresa(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$proceso = $this->logicaMis->getMatricesEmpresa($_POST);
			echo json_encode($proceso); 
		}
		else{
			$proceso ="nada";
			echo json_encode($proceso); 
		}
	}
	//formulario de sugerir matriz
	public function sugerirMatriz(){
			$opc 				   		= "home";
			$salida['titulo']      		= "Sugerir nueva matriz";
			echo $this->load->view("misMatrices/sugerir",$salida,true);
	}
}
?>


