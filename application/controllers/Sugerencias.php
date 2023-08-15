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
class Sugerencias extends CI_Controller 
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
	public function sugerencias($idModulo){
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
						$idEmpresa =$_SESSION["project"]["info"]["idEmpresa"];
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
					$idPerfil = $_SESSION["project"]["info"]["idPerfil"];
					//valido perfil para enviar a mostrar datos y hacer consultas
					if($idPerfil == 11){
						$idPersona = $_SESSION["project"]["info"]["idPersona"];
						$misSugerencias	      	= $this->logica->misSugerencias($idPersona);
						// var_dump($misSugerencias);die();
					}if($idPerfil < 4){
						$misSugerencias	      	= $this->logica->sugerencias();
					}

					//info Módulo
					$infoModulo	      	   		= $this->logica->infoModulo($idModulo);
					$salida["misSugerencias"]	= $misSugerencias;
					$opc 				   		= "home";
					$salida['titulo']      		= "Matrices";
					$salida['centro'] 	   		= "sugerencias/home";
					$salida['infoModulo']  		= $infoModulo[0];
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
	public function modalSugerencias(){
		$idSugerencia = $_POST["idSugerir"];
		$misSugerencias	      	= $this->logica->sugerenciaID($idSugerencia);
		// var_dump($misSugerencias);die();
		$opc 				   		= "home";
		$salida['titulo']      		= "Mi sugerencia";
		$salida['misSugerencias']   = $misSugerencias[0];
		echo $this->load->view("sugerencias/respuesta",$salida,true);
	}
	public function guardaRespuesta(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			//var_dump($_POST);die();
			$crea = $this->logica->guardaRespuesta($_POST);
			echo json_encode($crea);
		}else{
			header('Location:'.base_url()."login");
		}
	}
}
?>


