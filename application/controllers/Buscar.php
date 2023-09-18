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
class Buscar extends CI_Controller 
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
	public function consultaMatrices(){
		$idPersona = $_SESSION["project"]["info"]["idPersona"];
		$idEmpresa = $_SESSION["project"]["info"]["idEmpresa"];
		$inforMiMatriz = $this->logicaMis->consultaMatricescompradas($idPersona, $idEmpresa);
		$infoPlanesrel = $this->logica->infoPlanesrel($idEmpresa);
		// var_dump($infoPlanesrel);die();
		$infoMatrices = $this->logicaMis->infoMatrices();
		$opc = "home";
		$salida['titulo'] = "Check's Creados";
		$salida['inforMiMatriz']= $inforMiMatriz;
		$salida['infoMatrices']	= $infoMatrices;
		$salida['centro'] 		= "misMatrices/creadas";
		$salida['idEmpresa'] 	= $idEmpresa;
		//$this->load->view("app/index",$salida);
		echo $this->load->view("app/index",$salida,true);
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
			// var_dump($inforMiMatriz);die();
			$matricesCompradas= 0;
			if($inforMiMatriz["datos"] >0){
				$matricesCompradas = count($inforMiMatriz["datos"]);
			}
			$relacionEmpresaPlan = $this->logica->infoPlanesrel($idEmpresa);
			if($relacionEmpresaPlan["datos"] >0){
				$checkcomprar =  $relacionEmpresaPlan["datos"][0]["canChecks"];
			}
			if($checkcomprar > $matricesCompradas){
				$infoMatrices = $this->logicaMis->infoMatrices();
				$inforMiMatriz = array("mensaje"=>"las matrices no fueron consultadas.",
									"continuar"=>0,
									"datos"=>"");
				$response =array(
					"infoMatrices" =>$infoMatrices,
					"inforMiMatriz" =>$inforMiMatriz,
				);
			}else{
				if ($infoMatriceslike > 0){
					$infoMatrices = $infoMatriceslike;
					$response =array(
						"infoMatrices" =>$infoMatrices,
						"inforMiMatriz" =>$inforMiMatriz,
					);
				} else {
					$infoMatrices = [];
					$infoMatrices = $this->logicaMis->infoMatrices();
					$response =array(
						"infoMatrices" =>$infoMatrices,
						"inforMiMatriz" =>$inforMiMatriz,
					);
				}
			}
			//var_dump($response);die();
			echo json_encode($response); 
	}

	//crea las primeras 3 matrices
	public function creaGratis() {
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$proceso = $this->logicaMis->creaGratis($_POST);
			echo json_encode($proceso); 
		}
		else{
			header('Location:'.base_url()."login");
		}
	}
	//verificar si la empresa ya cuenta con las matrices.
	public function getMatricesEmpresa(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$proceso = $this->logicaMis->getMatricesEmpresa($_POST);
			echo json_encode($proceso); 
		}
		else{
			header('Location:'.base_url()."login");
		}
	}
	//formulario de sugerir matriz
	public function sugerirMatriz(){
			$opc 				   		= "home";
			$salida['titulo']      		= "Sugerir nueva matriz";
			echo $this->load->view("misMatrices/sugerir",$salida,true);
	}
	//verificar si la empresa ya cuenta con las matrices.
	public function sugiereMatriz(){
		if(validaInApp("web")){
			// var_dump($_POST);die();
			$proceso = $this->logica->sugiereMatriz($_POST);
			echo json_encode($proceso); 
		}
		else{
			header('Location:'.base_url()."login");
		}
	}
	// busco relacion de empresa con el plan
	public function busquedaRelEmpresaPalan(){
		if(validaInApp("web")){
			$idEmpresa = $_SESSION["project"]["info"]["idEmpresa"];
			$proceso = $this->logica->infoPlanesrel($idEmpresa);
			echo json_encode($proceso); 
		}
		else{
			header('Location:'.base_url()."login");
		}
	}
}
?>


