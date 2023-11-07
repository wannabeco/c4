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
class Planes extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");//la idea es que este archivo siempre esté ya que aquí se consultan cosas que son muy globales.
        $this->load->model("misMatrices/LogicaMisMatrices", "logicaMis");//aquí se debe llamar la lógica correspondiente al módulo que se esté haciendo.
		$this->load->model("crearMatriz/LogicaMatriz","logMatriz");
		$this->load->model("empresas/LogicaEmpresas","lgEmpresas");//logica
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
	public function planes(){
		$idEmpresa=0;
		$infoPlanes = $this->logica->infoPlanes($idEmpresa);
		// var_dump($infoPlanes);die();
		$opc = "home";
		$salida['titulo'] = "Planes Creados";
		$salida['centro'] = "planes/home";
		$salida['infoPlanes'] = $infoPlanes;
		echo $this->load->view("app/index",$salida,true);
	}
	//modal crea plan
	public function creaPlan(){
		extract($_POST);
		$infoEmpresas		  	= $this->lgEmpresas->infoEmpresas();
		// var_dump($infoEmpresas);die();
		// var_dump($_POST);die();
		if($_POST["idPlan"] == "0"){
			$salida["titulo"] 	 		= "Crear nuevo plan";
			$salida["labelBtn"]  		= "Crear plan";
			$salida["edita"]  			= 0;
			$salida["idPlan"]			= 0;
			$salida["infoEmpresas"]		= $infoEmpresas;
			echo $this->load->view("planes/formCrearPlanes",$salida,true);
		}
		if($_POST["idPlan"] > 0){
			$infoPlanes = $this->logica->infoPlanesid($_POST);
			$salida['titulo'] 		= "Editar plan";
			$salida['infoPlanes'] 	= $infoPlanes[0];
			$salida["edita"]  		= 1;
			$salida["idPlan"]		= $infoPlanes[0]["idPlan"];
			$salida["infoEmpresas"]	= $infoEmpresas;
			// var_dump($infoPlanes);die();
			echo $this->load->view("planes/formCrearPlanes",$salida,true);
		}
	}
	//funcion para crear el plan
	public function creaPlanes(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$crearPlanes = $this->logica->creaPlanes($_POST);
			echo json_encode($crearPlanes); 
		}else{
			header('Location:'.base_url()."login");
		}
			
	}
	//Actualiza plan
	public function actualizaPlan(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$actualizaPlan = $this->logica->actualizaPlan($_POST);
			echo json_encode($actualizaPlan); 
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//eliminaPlan
	public function eliminaPLan(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$eliminaPlan = $this->logica->eliminaPlanes($_POST);
			echo json_encode($eliminaPlan); 
		}else{
			header('Location:'.base_url()."login");
		}
	}
}
?>


