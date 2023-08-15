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
class PerfilUsuario extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");
        $this->load->model("admin/LogicaUsuarios", "logicaUsuarios");
       	$this->load->helper('language');
    	$this->lang->load('spanish');
    }
    
	public function datosUsuario(){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
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
			$infoUsuario	     = $this->logicaUsuarios->infoUsuario($_SESSION['project']['info']['idPersona']);


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

			$opc 				   = "home";
			$salida['titulo']      = lang("titulo")." - perfil del usuario";
			$salida['centro'] 	   = "admin/perfilUsuario/home";
			$salida['datos']	   = $infoUsuario['datos'][0];
			$this->load->view("app/index",$salida);
		}else{
			header('Location:'.base_url()."login");
		}
	}

	public function cambiafotoPerfil(){
		extract($_POST);
		if(isset($_FILES) && $_FILES['fotoPerfil']['name'] != ""){
			@mkdir('./res/fotos/personas/'.$idUsuarioFoto,"0777");

			$config['upload_path'] 	 = './res/fotos/personas/'.$idUsuarioFoto.'/';
	        $config['allowed_types'] = 'gif|jpg|png';
	        $config['max_size'] 	 = 2048;
            $config['max_width']     = 800;
            $config['max_height']    = 800;
	        $config['encrypt_name']  = TRUE;
	        $file_element_name 		 = 'fotoPerfil';

	        $this->load->library('upload', $config);

	        if(!$this->upload->do_upload($file_element_name)){
	            $status = 'error';
	            $msg = $this->upload->display_errors();
	           // var_dump($msg);
	            $salida = array("mensaje"=>"No se ha podido realizar la carga de la foto de perfil, probablemente la falla sea porque ha superado el tamaño permitido de 2 MB ó no tenga el formato que se necesita: PNG, JPG ó GIF, supere",
            				"continuar"=>0,
            				"datos"=>array());

	        }else{
	            $data = $this->upload->data();

	            $nPost['icono']			=	$data['file_name'];
	            $nPost['idUsuario']		=	$idUsuarioFoto;
	            $nPost['edita']			=	1;

	            //procedo a actualizar la información del usuario
	            $procesoUsuario 	 	=  $this->logicaUsuarios->procesaUsuarios($nPost);

	            if($procesoUsuario > 0){
	            	$salida = array("mensaje"=>"La foto de perfil ha sido actualizada.",
            				"continuar"=>1,
            				"datos"=>array());
	            }else{
	            	$salida = array("mensaje"=>"La foto de perfil no ha podido sido actualizada, intente de nuevo más tarde.",
            				"continuar"=>1,
            				"datos"=>array());
	            }

	            /*
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
	            @unlink($_FILES[$file_element_name]);*/
	        	
	        }
	    }else{
	    	$salida = array("mensaje"=>"Debe seleccionar una foto para su perfil. Sólo formatos PNG, JPG, GIF",
            				"continuar"=>0,
            				"datos"=>array());
	    }
        echo json_encode($salida);
	}

	public function cambioClave()
	{
		$proceso = $this->logicaUsuarios->procesoCambioClave($_POST);
		echo json_encode($proceso);
	}
	//actualización datos de empresa
	public function datosEmpresa(){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){

			$infoEmpresa	     = $this->logicaUsuarios->infoEmpresa($_SESSION['project']['info']['idEmpresa']);
			$idEmpresa = $infoEmpresa["datos"][0]["idEmpresa"];
			$id= json_decode($idEmpresa);
			// var_dump($id);die();
			$ifDepartamento 	 = $infoEmpresa["datos"]["0"]["departamento"];	
			$tiposDoc		  	 = $this->logica->consultatiposDoc(); 
			$sexo		  	 	 = $this->logica->consultaSexo(); 
			$profesiones  	 	 = $this->logica->consultaProfesiones(); 
			$cargos  	 	 	 = $this->logica->consultaCargos(); 
			$perfiles  	 	 	 = $this->logica->consultaPerfiles(); 
			$areas  	 	 	 = $this->logica->consultaAreas(); 
			$departamento  	     = $this->logica->consultaDepartamentos(); 
			$ciudades  	 	 	 = $this->logica->consultaCiudadesEm($ifDepartamento); 
			$eps 	 	 	 	 = $this->logica->consultaEPS(); 
			$afp 	 	 	 	 = $this->logica->consultaAFP(); 
			$cesantias 	 	 	 = $this->logica->consultaCesantias(); 

			// var_dump($infoEmpresa);die();
			$salida["selects"]   = array("tiposDoc"=>$tiposDoc,
										  "sexo"=>$sexo,
										  "profesiones"=>$profesiones,
										  "perfiles"=>$perfiles,
										  "areas"=>$areas,
										  "cargos"=>$cargos,
										  "departamento"=>$departamento,
										  "ciudades"=>$ciudades,
										  "eps"=>$eps,
										  "afp"=>$afp,
										  "cesantias"=>$cesantias);

			$opc 				   = "home";
			$salida['titulo']      = lang("titulo")." - datos de empresa";
			$salida['datos']	   = $infoEmpresa["datos"]["0"];
			$salida['idEmpresa']	= $id;
			$salida['centro'] 	   = "admin/perfilUsuario/empresa";
			$this->load->view("app/index",$salida);
		}else{
			header('Location:'.base_url()."login");
		}
	}
}
?>