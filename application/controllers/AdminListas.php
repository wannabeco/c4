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
class adminListas extends CI_Controller
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");//la idea es que este archivo siempre esté ya que aquí se consultan cosas que son muy globales.
        $this->load->model("admin/LogicaListas", "logicaListas");//aquí se debe llamar la lógica correspondiente al módulo que se esté haciendo.
       	$this->load->helper('language');//mantener siempre.
    	$this->lang->load('spanish');//mantener siempre.
        $this->load->library('Excel',"excel");
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
	public function listadosGlobales($idModulo)	
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
				$salida['centro'] 	   = "admin/adminListas/home";//plantilla que se muestra en la parte central
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


	public function getListas()
	{
		$listas  =  $this->logicaListas->getListas(); 
		echo json_encode($listas);
	}


	public function cargaPlantillaModal()
	{
		extract($_POST);
		//listados 
		if($edita == 1)
		{
			

			$salida["titulo"] 	 = "Editar la lista";
			$salida["edita"]  	 = $edita;
			$salida["labelBtn"]  = "EDITAR LISTA";
		}
		else
		{
			$salida["titulo"] 	 = "Agregar nueva lista";
			$salida["datos"] 	 = array();
			$salida["edita"]  	 = $edita;
			$salida["labelBtn"]  = "CREAR LISTA";
		}
		echo $this->load->view("administrativos/cargaPagos/formControl",$salida,true);
	}

	public function procesaListas()
	{
		if(isset($_FILES) && $_FILES['excelFile']['name'] != "")
		{
			$config['upload_path'] 	 = './res/cargueMasivo';
	        $config['allowed_types'] = 'xls|xlsx';
	        $config['max_size'] 	 = 10240;
	        $config['encrypt_name']  = TRUE;
	        $file_element_name 		 = 'excelFile';

	        $this->load->library('upload', $config);
	        if(!$this->upload->do_upload($file_element_name))
	        {
	            $status = 'error';
	            $msg = $this->upload->display_errors('', '');
	        }
	        else
	        {
	            $data = $this->upload->data();
	            if($data)//carga perfectamente el archivo
	            {
	            	//var_dump($_POST);
	            	$dataExcel 		= $this->excel->importarExcel($data['full_path']);
	            	//ahora debo tomar la data del excel y realizar el cargue.
	            	$dataInsertada	= $this->logicaListas->insertaMasivo($dataExcel,$_POST);		
	                @unlink($data['full_path']);
	                echo json_encode($dataInsertada);
	            }
	            else
	            {
	                @unlink($data['full_path']);
	                $salida = array("mensaje"=>"El archivo ".$data['file_name']." no ha sido cargado",
	                				"continuar"=>0,
	                				"datos"=>$data['file_name']);
	                echo json_encode($salida);
	            }
	            @unlink($_FILES[$file_element_name]);
	        	
	        }
	    }
	    else
	    {
	    	$salida = array("mensaje"=>"Recuerde que debe seleccionar un archivo para poder realizar el cargue. Sólo formatos xls y xlsx",
            				"continuar"=>0,
            				"datos"=>array());
            echo json_encode($salida);
	    }
	}
}
?>