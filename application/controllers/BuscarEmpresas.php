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
class BuscarEmpresas extends CI_Controller 
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
	public function consultaEmpresas(){
		if(validaInApp("web")){
			$idPersona = $_SESSION["project"]["info"]["idPersona"];
			$infoMisEmpresas = $this->logicaMis->ConsultaEmpresasCompradas($idPersona);
			$infoEmpresas = $this->logicaMis->infoEmpresas();
			$opc = "home";
			$salida['titulo'] = "Empresas Registradas";
			$salida['infoMisEmpresas'] = $infoMisEmpresas;
			$salida['infoEmpresas'] = $infoEmpresas;
			$salida['centro'] = "empresas/creadas";
			echo $this->load->view("app/index",$salida,true);
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//consulta matrices creadas
	public function empresasCreadas(){
		if(validaInApp("web")){
			$infoEmpresasLike = "";
			if (isset($_POST["buscar"])) {
					$buscar = $_POST["buscar"];
					$infoEmpresasLike = $this->logicaMis->infoEmpresasLike($buscar);
				}
				$idPersona = $_SESSION["project"]["info"]["idPersona"];
				$infoMisEmpresas = $this->logicaMis->ConsultaEmpresasCompradas($idPersona);
				$infoEmpresas = [];
				if ($infoEmpresasLike > 0){
					$infoEmpresas = $infoEmpresasLike;
					$response =array(
						"infoEmpresas" =>$infoEmpresas,
						"infoMisEmpresas" =>$infoMisEmpresas,
					);
				} else {
					$infoEmpresas = $this->logicaMis->infoEmpresas();
					$response =array(
						"infoEmpresas" =>$infoEmpresas,
						"infoMisEmpresas" =>$infoMisEmpresas,
					);
				}
				echo json_encode($response); 
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//crea relacion de las empresas con el oficial de cumplimiento
	public function creaGratisrel() {
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$proceso = $this->logicaMis->creaGratisrel($_POST);
			echo json_encode($proceso); 
		}
		else{
			header('Location:'.base_url()."login");
		}
	}
	//verificar que la empresa no este agregada
	public function getrelEmpresa(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$proceso = $this->logicaMis->getrelEmpresa($_POST);
			echo json_encode($proceso); 
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//verifico que la empresa no cuente con oficial de cumplimiento
	public function relEmpresaPerfiles(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$proceso = $this->logicaMis->relEmpresaPerfiles($_POST);
			echo json_encode($proceso); 
		}else{
			header('Location:'.base_url()."login");
		}
	}
}
?>


