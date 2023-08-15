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
class PagoMatriz extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");//la idea es que este archivo siempre esté ya que aquí se consultan cosas que son muy globales.
        $this->load->model("admin/LogicaEnBlanco", "logicaUsuarios");//aquí se debe llamar la lógica correspondiente al módulo que se esté haciendo.
		$this->load->model("misMatrices/LogicaMisMatrices", "logicaMis");
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
	public function PagoEmpresas(){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
				$idEmpresa = $_SESSION["project"]["info"]["idEmpresa"];
				$infoEmpresa = $this->logicaMis->infoEmpresa($idEmpresa);
				$infoPlanes	= $this->logica->infoPlanes();
				$infoUsuarios = $this->logica->getUsuarioEmpresa($idEmpresa);
				$infoMatrices = $this->logica->getMatricesEmpresas($idEmpresa);
				$relacionPlan = $this->logica->relPlan($idEmpresa);
				if($relacionPlan["continuar"] == 1){
					$adicionalesa = 1;
					$plan["idPlan"] = $relacionPlan["datos"][0]["idPlan"];
					$infoPlanActual = $this->logica->infoPlanesid($plan);
					$salida['nombrePlan'] 	= $infoPlanActual[0]["nombrePlan"];
				}else{
					$adicionalesa = 0;
				}
				$preciosPerfil = array();
				$precioMatrices = array();
				$precioPlanEmpresa = $infoPlanes[0]["precio"];
				// var_dump($precioPlanEmpresa);die();
				foreach ($infoUsuarios["data"] as $Perfiles) {
					if (isset($Perfiles["precioPerfil"]) && $Perfiles["precioPerfil"] > 0 ) {
						array_push($preciosPerfil, $Perfiles["precioPerfil"]);
					}
				}
				foreach ($infoMatrices["data"] as $matrices) {
					if (isset($matrices["precio"])) {
						if($matrices["pago"] == "SI"){
							array_push($precioMatrices, $matrices["precio"]);
						}
					}
				}
				$totalPerfil = array_sum($preciosPerfil);
				$cantPerfiles = count($preciosPerfil);
				$cantMatrices = count($precioMatrices);
				$totalMatrices = array_sum($precioMatrices);
				$adicionales = $totalPerfil+ $totalMatrices;
				//$totalPagarEmpresa = $precioPlanEmpresa+ $totalPerfil+ $totalMatrices;
				$opc 						= "home";
				$salida['titulo'] 	  		= "Pago Empresas";
				$salida['infoEmpresa']  	= $infoEmpresa;
				$salida['infoPlanes']   	= $infoPlanes;
				$salida['infoUsuarios'] 	= $infoUsuarios["count"];
				$salida['infoMatrices'] 	= $infoMatrices["count"];
				$salida['totalPerfil'] 		= $totalPerfil;
				$salida['totalMatrices'] 	= $totalMatrices;
				$salida['adicionales'] 		= $adicionales;
				$salida['cantPerfiles'] 	= $cantPerfiles;
				$salida['adicionalesa'] 	= $adicionalesa;
				$salida['cantMatrices'] 	= $cantMatrices;
				$salida['centro'] 			= "app/homeCaducidad";
				$this->load->view("app/index",$salida);
		}
		else{
			header('Location:'.base_url()."login");
		}
	}
	public function insetCodigo(){
		$data 					= "payu";
		$insetCodigo			= $this->logica->insetCodigo($data);
		echo json_encode($insetCodigo);
	}
	//agrego a la tabla cMatriz temporal, esto para tener control de una compra temporal
	public function insetCmatrizTemporal(){
		if(validaInApp("web")){
			$compraTemporal = $this->logica->insetCmatrizTemporal($_POST);
			echo json_encode($compraTemporal);
		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 
            echo json_encode($respuesta); 
		}
	}
	public function insetCodigoEmpresas(){
		$data 					= "payu";
		$insetCodigo			= $this->logica->insetCodigoEmpresas($data);
		echo json_encode($insetCodigo);
	}
	//se agrega aa tabla de pedidos temporal para comprar empresa.
	public function insetCEmpresaTemporal(){
		if(validaInApp("web")){
			$compraTemporal = $this->logica->insetCEmpresaTemporal($_POST);
			echo json_encode($compraTemporal);
		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 
            echo json_encode($respuesta); 
		}
	}
	//pago mensualidad empresa
	public function pagoMensualidadEmpresa(){
		if(validaInApp("web")){
			$compraTemporal = $this->logica->pagoMensualidadEmpresa($_POST);
			echo json_encode($compraTemporal);
		}
		else{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 
            echo json_encode($respuesta); 
		}
	}
	//consuto datos para informacion de pago oficial de cumplimiento
	public function PagoOficial(){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){

			$infoPlanes	= $this->logica->infoPlanes();
			$precioPlanEmpresa = $infoPlanes[1]["precio"];
			$idPersona 			= $_SESSION["project"]["info"]["idPersona"];
			$EmpresasCompradas 	= $this->logicaMis->infoEmpresasCompradas($idPersona);
			$compradas = array();
			foreach ($EmpresasCompradas as $rels) {
				if (isset($rels)) {
					array_push($compradas, $rels["precioEmpresa"]);
				}
			}
			$totalCompradas = array_sum($compradas);
			$cantCompradas = count($compradas);
			// var_dump($compradas);die();

			//eliminar los que no voy necesitand
			$totalPagarEmpresa = $precioPlanEmpresa+ $totalCompradas;
			$opc 						= "home";
			$salida['titulo'] 	  		= "Pago Empresas";
			$salida['infoPlanes']   	= $infoPlanes;
			$salida['cantCompradas']   	= $cantCompradas;
			$salida['totalCompradas']   = $totalCompradas;
			$salida['totalPagarEmpresa']= $totalPagarEmpresa;
			$salida['EmpresasCompradas']= $EmpresasCompradas;
			$salida['centro'] 			= "app/homeCaducidad";
			$this->load->view("app/index",$salida);
		}
		else{
			header('Location:'.base_url()."login");
		}
	}
	//pago mensualidad oficial de cumplimiento
	public function pagoMensualidadOficial(){
		if(validaInApp("web")){
			$compraTemporal = $this->logica->pagoMensualidadOficial($_POST);
			echo json_encode($compraTemporal);
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