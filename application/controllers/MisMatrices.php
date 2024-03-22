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
	public function matrices($idModulo,$idEmpresa,$idPeriocidad){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			// if(getPrivilegios()[0]['ver'] == 1){ 
						
					//variables para la consulta
					$idPerfil = $_SESSION["project"]["info"]["idPerfil"];
					$idPersona = $_SESSION["project"]["info"]["idPersona"];
					$infoModulo	   = $this->logica->infoModulo($idModulo);
					//valido perfil para enviar a mostrar datos y hacer consultas
					if($idPerfil == 11){
						if ($idPeriocidad == 0) {
							$periocidad	= $idPeriocidad;
							$infoEmprsa = $this->logicaMis->infoEmpresa($idEmpresa);
							$fechaCaduca = $infoEmprsa[0]["fechaCaducidad"];
							$hoy = date('Y-m-d H:i:s');
							// verifico que la empresa este al dia
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
							$relacion					= $this->logicaMis->consultaRelacion($idEmpresa);
							$inforMiMatriz				= $this->logicaMis->consultaMatricescompradas($idPersona,$idEmpresa);
							$salida['inforMiMatriz']	= $inforMiMatriz;
							$salida['infor']			= $inforMiMatriz["datos"];
							$salida['periocidad']	    = 0;
						} else {
							$periocidad	= $idPeriocidad;
							$infoEmprsa = $this->logicaMis->infoEmpresa($idEmpresa);
							$fechaCaduca = $infoEmprsa[0]["fechaCaducidad"];
							$hoy = date('Y-m-d H:i:s');
							// verifico que la empresa este al dia
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
							$relacion					= $this->logicaMis->consultaRelacion($idEmpresa);
							$inforMiMatriz				= $this->logicaMis->consultaMatricescompradas($idPersona,$idEmpresa);
							$salida['inforMiMatriz']	= $inforMiMatriz;
							$salida['infor']			= $inforMiMatriz["datos"];
							$salida['periocidad']	    = $periocidad;
							$salida['idEmpresa']	    = $idEmpresa;
						}
					}else if($idPerfil == 8){
						$periocidad 				= $idPeriocidad;
						$relacion					= $this->logicaMis->consultaRelacion($idEmpresa);
						$inforMiMatriz				= $this->logicaMis->consultaMatricescompradas($idPersona,$idEmpresa);
						$infoEmpresas 				= $this->logicaMis->infoEmpresa($idEmpresa);
						$matrices = [];
						foreach($inforMiMatriz["datos"] as $matriz){
							array_push($matrices, $matriz["idMatriz"]);
						}
						$salida['inforMiMatriz']	= $inforMiMatriz;
						$salida['infoEmpresas']		= $infoEmpresas[0];
						$salida['infor']			= $inforMiMatriz["datos"];
						$salida['periocidad']	    = $periocidad;
						$salida['idEmpresa']	    = $idEmpresa;
					} else if($idPerfil > 3 || $idPerfil != 11){
						$periocidad = $idPeriocidad;
						$idEmpresa = $_SESSION["project"]["info"]["idEmpresa"];
						$relacion					= $this->logicaMis->consultaRelacion($idEmpresa);
						$tipoEmpresa 				= $relacion[0]["tipoEmpresa"];
						$inforMiMatriz				= $this->logicaMis->consultaMatricecomprada($idEmpresa);
						$salida['inforMiMatriz']	= $inforMiMatriz;
						$salida['infor']			= $inforMiMatriz["datos"];
						$salida['periocidad']	    = $periocidad;
						$salida['idEmpresa']	    = $idEmpresa;
					}
						$opc 				   		= "home";
						$salida['titulo']      		= "Checks";
						$salida['centro'] 	   		= "misMatrices/home";
						$salida['infoModulo']  		= $infoModulo[0];
						$this->load->view("app/index",$salida);
			}else{
				// $opc 				   = "home";
				// $salida['titulo']      = lang("titulo")." - Área Restringida";
				// $salida['centro'] 	   = "error/areaRestringida";
				// $this->load->view("app/index",$salida);
				header('Location:'.base_url()."login");
			}
		// }
		// else{
		//  	header('Location:'.base_url()."login");
		// }
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
	public function informacion($idModulo,$parametro,$idEmpresa,$idPeriocidad){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1){
				$idPerfil = $_SESSION["project"]["info"]["idPerfil"];
				$infoModulo	      	   			= $this->logica->infoModulo($idModulo);
				if( $idPerfil == 11){
					
					$id =$parametro;
					$idEmpresas = $idEmpresa;
					$periocidad = $idPeriocidad;
					$infoUsuario		   			= $_SESSION['project']['info']['nombre'];
					$idPersona						= $_SESSION['project']['info']['idPersona'];
					$infoMatrizRecurrentes			= $this->logMatriz->infoMatrizRecurrentes($id);
					// var_dump($infoMatrizRecurrentes);die();
					$infoMatrices		  			= $this->logMatriz->infoGeneralMatriz();
					$idrecurrente					= $infoMatrizRecurrentes[0]["idMatrizRecurrente"];
					$infoComentarios				= $this->logMatriz->infoComentarios($idrecurrente,$idPersona,$periocidad);
					$acumuloRecurrentes = [];
					foreach($infoMatrizRecurrentes as $infoRmatriz){
						array_push($acumuloRecurrentes,$infoRmatriz["idMatrizRecurrente"]);
					}
					$consultoSi 					= $this->logMatriz->consultoSiDos($periocidad,$idEmpresas,$acumuloRecurrentes);
					$opc 				   			= "home";
					$salida['titulo']      			= "Información de Check";
					$salida['centro'] 	   			= "MatricesCreadas/infoMatriz";
					$salida['infoModulo']  			= $infoModulo[0];
					$salida['infoUsuario'] 			= $infoUsuario[0];
					$salida['infoMatrices'] 		= $infoMatrices[0];
					$salida['idEmpresas'] 			= $idEmpresas;
					$salida['infoMatrizRecurrentes']= $infoMatrizRecurrentes;
					$salida["infoComentarios"] 		= $infoComentarios;
					$salida['consultoSi'] 			= $consultoSi;
					$salida['idPeriocidad'] 		= $idPeriocidad;
					
				 	if($infoComentarios["continuar"] == 1){
				 		$salida["infoComentarios"] 		= $infoComentarios;
				    }else{
				 	   $salida["infoComentarios"] 		= $infoComentarios;
				    }
					$salida["idNuevaMatriz"] 		= $id;
					$this->load->view("app/index",$salida);

				}else if($idPerfil == 8){
					$nuevaMatriz = $parametro;
					$idEmpresas = $idEmpresa;
					$periocidad = $idPeriocidad;
					$infoUsuario		   			= $_SESSION['project']['info']['nombre'];
					$idPersona						= $_SESSION['project']['info']['idPersona'];
					$infoMatrizRecurrentes			= $this->logMatriz->infoMatrizRecurrentes($nuevaMatriz);
					$idResponsable 					= $infoMatrizRecurrentes[0]["idResponsable"];
					$informacionCheck				= $this->logMatriz->informacionCheck($idResponsable,$nuevaMatriz,$idEmpresas,$periocidad);
					$acumuloRecurrentes = [];
					foreach($infoMatrizRecurrentes as $infoRmatriz){
						array_push($acumuloRecurrentes,$infoRmatriz["idMatrizRecurrente"]);
					}
					$consultoSi 					= $this->logMatriz->consultoSiDos($periocidad,$idEmpresas,$acumuloRecurrentes);
					if($informacionCheck["continuar"] == 1){
						$idPersonaCheck 				= $informacionCheck["datos"][0]["idPersona"];
						$informacionPersona				= $this->logMatriz->infoPersona($idPersonaCheck);
						$infoComentarios				= $this->logMatriz->infoComentarios($nuevaMatriz,$idPersonaCheck,$periocidad);
						$salida['informacionCheck'] 	= $informacionCheck;
						$salida['informacionPersona'] 	= $informacionPersona[0];
						$salida["infoComentarios"] 		= $infoComentarios;
						$salida["idPeriocidad"] 		= $periocidad;
						$salida["periocidad"] 			= $periocidad;
						$salida['idEmpresas'] 			= $idEmpresas;
					}else{
						$infoComentarios["datos"] = "";
						$informacionCheck ="";
				 	   	$salida["infoComentarios"] 		= $infoComentarios;
						$salida['informacionCheck'] 	= $informacionCheck;
						$salida["idPeriocidad"] 		= $periocidad;
						$salida['idEmpresas'] 			= $idEmpresas;
						$salida["periocidad"] 			= $periocidad;
				    }
					
					$infoMatrices		  			= $this->logMatriz->infoGeneralMatriz();
					$opc 				   			= "home";
					$salida['titulo']      			= "Información de check";
					$salida['centro'] 	   			= "MatricesCreadas/infoMatriz";
					$salida['infoModulo']  			= $infoModulo[0];
					$salida['infoUsuario'] 			= $infoUsuario[0];
					$salida['infoMatrices'] 		= $infoMatrices[0];
					$salida['idEmpresas'] 			= $idEmpresas;
					$salida['idResponsable'] 		= $idResponsable;
					$salida['infoMatrizRecurrentes']= $infoMatrizRecurrentes;
					$salida["idNuevaMatriz"] 		= $nuevaMatriz;
					$salida["periocidad"] 			= $periocidad;
					$salida['consultoSi'] 			= $consultoSi;
					$salida["idPeriocidad"] 		= $periocidad;
					$salida["periocidad"] 			= $periocidad;
					$this->load->view("app/index",$salida);
				}else if($idPerfil > 3 && $idPerfil != 11 && $idPerfil != 8){
					$periocidad = $idPeriocidad;
					$id =$parametro;
					$infoUsuario		   			= $_SESSION['project']['info']['nombre'];
					$idPersona						= $_SESSION['project']['info']['idPersona'];
					$infoMatrizRecurrentes			= $this->logMatriz->infoMatrizRecurrentesDos($id,$idPerfil);
					$infoMatrices		  			= $this->logMatriz->infoGeneralMatriz();
					$idrecurrente					= $infoMatrizRecurrentes[0]["idMatrizRecurrente"];
					$infoComentarios				= $this->logMatriz->infoComentarios($id,$idPersona,$periocidad);
					$acumuloRecurrentes = [];
					foreach($infoMatrizRecurrentes as $infoRmatriz){
						array_push($acumuloRecurrentes,$infoRmatriz["idMatrizRecurrente"]);
					}
					$consultoSi 					= $this->logMatriz->consultoSi($periocidad,$idPerfil,$acumuloRecurrentes);
					// var_dump($consultoSi);die();
					$opc 				   			= "home";
					$salida['titulo']      			= "Información de check";
					$salida['infoModulo']  			= $infoModulo[0];
					$salida['consultoSi'] 			= $consultoSi;
					$salida['infoMatrices'] 		= $infoMatrices;
					$salida['infoMatrizRecurrentes']= $infoMatrizRecurrentes;
					$salida["id"] 					= $id;
					$salida["idPerfil"] 			= $idPerfil;
					$salida["periocidad"] 			= $periocidad;
					$salida["idPeriocidad"] 			= $periocidad;
					if($infoComentarios["continuar"] == 1){
					 	$salida["infoComentarios"] 		= $infoComentarios;
					}else if($infoComentarios["continuar"] == 0){
						$salida["infoComentarios"] 		= $infoComentarios;
					}
					$salida['centro'] 	   			= "MatricesCreadas/infoMatriz";
					$this->load->view("app/index",$salida);
				}
				
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
	//agrega nuevo checkeo
	public function nuevocheck(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			// var_dump($_POST);die();
			$procesoCrea = $this->logMatriz->creaCheckeo($_POST);
			echo json_encode($procesoCrea);
		}else{
			header('Location:'.base_url()."login");
		}
	}
	public function consultaMatrices(){
		$idPersona = $_SESSION["project"]["info"]["idPersona"];
		$idEmpresa = $_SESSION["project"]["info"]["idEmpresa"];
		$inforMiMatriz = $this->logicaMis->consultaMatricescompradas($idPersona, $idEmpresa);
		$infoMatrices = $this->logicaMis->infoMatrices();
		$opc = "home";
		$salida['titulo'] = "Check Creados";
		$salida['inforMiMatriz'] = $inforMiMatriz;
		$salida['infoMatrices'] = $infoMatrices;
		$salida['centro'] = "misMatrices/creadas";
		$this->load->view("app/index",$salida);
	}
	//consulta matrices creadas
	public function matricesCreadas(){
			$infoMatriceslike = "";
			if (isset($_POST["buscar"])){
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
			$salida['titulo'] = "Check Creados";
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
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//verificar si la empresa ya cuenta con las matrices.
	public function getMatricesEmpresa(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$proceso = $this->logicaMis->getMatricesEmpresa($_POST);
			echo json_encode($proceso); 
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//formulario de sugerir matriz
	public function sugerirMatriz(){
			$opc 				   		= "home";
			$salida['titulo']      		= "Sugerir nuevo check";
			echo $this->load->view("misMatrices/sugerir",$salida,true);
	}
	//sugerir matriz
	public function sugerirItem(){
		$idMatriz 					= $_POST["idMatriz"];
		$infoMatriz 				= $this->logicaMis->infoMatrize($idMatriz);
		$opc 				   		= "home";
		$salida['titulo']      		= "Sugerir Item interno";
		// var_dump($infoMatriz);die();
		$salida['infoMatriz']      	= $infoMatriz;
		echo $this->load->view("misMatrices/sugerirItem",$salida,true);
	}
	public function eliminaMatrizComprada(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$proceso = $this->logicaMis->eliminaMatrizComprada($_POST);
			echo json_encode($proceso); 
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//cargador de archivos
	public function cargaFoto(){	
		$idEmpresa= "";
		extract($_POST);
		if(isset($_FILES) && $_FILES[$caja]['name'] != ""){
			// @mkdir('assets/uploads/files/'.$idTienda,0777);
			$idEmpresa 			 = $_SESSION['project']['info']['idEmpresa'];
			$config['upload_path'] 	 = 'assets/uploads/files/'.$idEmpresa.'/';
	        $config['allowed_types'] = 'jpg|png|pdf|jpeg|doc|docx|xls|xlsx';
	        $config['max_size'] 	 = '10000';
            // $config['max_width']     = 800;
            // $config['max_height']    = 800;
	        $config['encrypt_name']  = TRUE;
	        $file_element_name 		 = $caja;
	        $this->load->library('upload', $config);

	        if(!$this->upload->do_upload($file_element_name)){//si no carga{
				$salida = array("mensaje"=>lang("text19.6"),
								"continuar"=>0,
								"idTienda"=>$idEmpresa,
								"urlCompleta"=>"",
								"foto"=>"",
								"datos"=>"");  
	        } else {//si carga
				
	            $data 					= $this->upload->data();
				//inserto la foto en la tabla de fotos temporales porque es probable que el usuario se arrepienta y no termine de crar el producto, entonces la foto quedara en el server ocupando espacio
				//al ponerla en esta tabla se puede correr un cron revisando que fotos en esta tablano fueron amarradas al producto y borrarlas.
				$fotoTemp		 = $this->logicaMis->insertaFotoTemp(array("foto"=>$data['file_name'],"rutaFoto"=>"assets/uploads/files/".$idEmpresa."/".$data['file_name']));  
	            $salida = array("mensaje"=>lang("text19.7"),
            				    "continuar"=>1,
								"idEmpresa"=>$idEmpresa,
								"urlCompleta"=>base_url()."assets/uploads/files/".$idEmpresa."/".$data['file_name'],
								"foto"=>$data['file_name'],
            				    "datos"=>$data['file_name']);
				echo json_encode($salida);
	        }
	    } else {
			$salida = array("mensaje"=>lang("text19.8"),
							"continuar"=>0,
							"idEmpresa"=>$idEmpresa,
							"urlCompleta"=>"",
							"foto"=>"",
							"datos"=>"");
			echo json_encode($salida);
		}
        // var_dump($salida);die();
	}
	//actualiza checkeo para usuarios
	public function actualizaCheck(){
		if(validaInApp("web")){//esta validación me hará consultas más seguras
			$proceso = $this->logicaMis->actualizaCheck($_POST);
			echo json_encode($proceso); 
		}else{
			header('Location:'.base_url()."login");
		}
	}
	public function home($idModulo, $idEmpresa){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			
			$infoModulo	      	   		= $this->logica->infoModulo($idModulo);
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if($_SESSION["project"]["info"]["idPerfil"] == 8){
				$periocidades = $this->logicaMis->infoPeriocidades($idEmpresa);
				$opc 				   		= "home";
				$salida['titulo']      		= "Periodicidad de checks";
				$salida['centro'] 	   		= "misMatrices/periocidades";
				$salida['infoModulo']  		= $infoModulo[0];
				$salida['periocidades']  	= $periocidades;
				$salida["periodicidad"] 	= $periocidades["datos"];
				$salida["idEmpresa"] 		= $idEmpresa;
				$this->load->view("app/index",$salida);
			}else if($_SESSION["project"]["info"]["idPerfil"] == 11){
				$periocidades = $this->logicaMis->infoPeriocidades($idEmpresa);
				$opc 				   		= "home";
				$salida['titulo']      		= "Periodicidad de checks";
				$salida['centro'] 	   		= "misMatrices/periocidades";
				$salida['infoModulo']  		= $infoModulo[0];
				$salida['periocidades']  	= $periocidades;
				$salida["periodicidad"] 	= $periocidades["datos"];
				$salida["idEmpresa"] 		= $idEmpresa;
				$this->load->view("app/index",$salida);
			}else if($_SESSION["project"]["info"]["idPerfil"] != 8 || $_SESSION["project"]["info"]["idPerfil"] != 11){ // valido perfiles que no necesitan permisos de ver
				if(getPrivilegios()[0]['ver'] == 1){
					//cuando el perfil es diferente a oficial de cumplimiento
					$idPersona = $_SESSION["project"]["info"]["idPersona"];
					$periocidades = $this->logicaMis->periocidades($idPersona,$idEmpresa);
					$opc 				   		= "home";
					$salida['titulo']      		= "Periodicidad de checks";
					$salida['centro'] 	   		= "misMatrices/periocidades";
					$salida['infoModulo']  		= $infoModulo[0];
					$salida['periocidades']  	= $periocidades;
					$salida["periodicidad"] 	= $periocidades["datos"];
					$salida["idEmpresa"] 		= $idEmpresa;
					$this->load->view("app/index",$salida);
				}else{
					$opc 				   = "home";
					$salida['titulo']      = lang("titulo")." - Área Restringida";
					$salida['centro'] 	   = "error/areaRestringida";
					$this->load->view("app/index",$salida);
				}
			}
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//modal periocidad
	public function modalPeriocidad(){
		extract($_POST);
		$editar 			= $_POST["edita"];
		$idRelPeriocidad 	= $_POST["idRelPeriocidad"];
		if($editar == 1){
			$periocidades 			= $this->logicaMis->infoPeriodicidad($idRelPeriocidad);
			// var_dump($periocidades);die();
			$periocidad 			= $this->logMatriz->periodicidad();
			$salida["titulo"] 	 	= "Actualizar periocidad";
			$salida["periodicidad"] = $periocidad;
			$salida["periocidades"] = $periocidades;
			$salida["idRelPeriocidad"] = $periocidades[0]["idRelPeriocidad"];
			$salida["editar"] 	 	= $editar;
			echo $this->load->view("misMatrices/formPeriocidad",$salida,true);
		}else{
			$periocidad 			= $this->logMatriz->periodicidad();
			$periocidades 			="";
			$salida["titulo"] 	 	= "Crear periocidad";
			$salida["periodicidad"] = $periocidad;
			$salida["periocidades"] = $periocidades;
			$salida["idRelPeriocidad"] = "";
			$salida["editar"] 	 	= 0;
			echo $this->load->view("misMatrices/formPeriocidad",$salida,true);
		}
	}
	//crear periocidad
	public function crearRelPeriocidad(){
		if(validaInApp("web")){
			$proceso = $this->logicaMis->crearRelPeriocidad($_POST);
			echo json_encode($proceso); 
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//eliminar periocidad
	public function borraPeriocidad(){
		if(validaInApp("web")){
			$proceso = $this->logicaMis->borraPeriocidad($_POST);
			echo json_encode($proceso); 
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//solicita check a la medida 
	public function solicitarMatriz(){
		$opc 				   		= "home";
		$salida['titulo']      		= "Solicita tu check a la medida";
		echo $this->load->view("misMatrices/solicita",$salida,true);
	}
	//te sugerimos check
	public function sugerimosCheck(){
		$infoMatrices = $this->logicaMis->infoMatrices();
		$idEmpresa = $_SESSION["project"]["info"]["idEmpresa"];
		//var_dump($infoMatrices);die();
		$opc 				   		= "home";
		$salida['titulo']      		= "Te sugerimos check";
		$salida['infoMatrices']		= $infoMatrices;
		$salida['idEmpresa'] 	= $idEmpresa;
		echo $this->load->view("misMatrices/sugerimos",$salida,true);
	}
	//los check creados por empresa
	public function misCreados(){
		if(validaInApp("web")){
			$idEmpresa = $_SESSION["project"]["info"]["idEmpresa"];
			$misMatricesCreadas = $this->logMatriz->misCreados();
			// var_dump($misMatricesCreadas);die();
			$opc 				   		= "home";
			$salida['titulo']      		= "Mis Check Creados";
			$salida['inforMiMatriz']	= $misMatricesCreadas;
			$salida['idEmpresa'] 		= $idEmpresa;
			$salida['centro'] 	   		= "misMatrices/creadosEmpresa";
			$this->load->view("app/index",$salida);
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//la empresa crea su propio check
	public function creoMiCheck(){
		extract($_POST);
		$editar 			= $_POST["edita"];
		if($editar == 1){
			$idNuevaMatriz =$_POST["idNuevaMatriz"];
			$consultoCheck = $this->logicaMis->consultoMiMatrizId($idNuevaMatriz);
			// var_dump($consultoCheck[0]["idNuevaMatriz"]);die();
			$opc 				   		= "home";
			$salida['titulo']      		= "Actualiza check";
			$salida['consultoCheck']    = $consultoCheck;
			$salida['idNuevaMatriz']    = $consultoCheck[0]["idNuevaMatriz"];
			$salida['editar']      		= 1;
		}else{
			$opc 				   		= "home";
			$salida['titulo']      		= "Crear nuevo check";
			$salida['editar']      		= 0;
		}
		echo $this->load->view("misMatrices/creoMiCheck",$salida,true);
	}
	//elimina matriz creada por empresa
	public function borraMatrizCreada(){
		if(validaInApp("web")){
			$proceso = $this->logicaMis->borraMatrizCreada($_POST);
			echo json_encode($proceso); 
		}else{
			header('Location:'.base_url()."login");
		}
	}
	// actualizar matriz creada por empresa
	public function actualizoMiCheck(){
		if(validaInApp("web")){
			$proceso = $this->logicaMis->actualizoMiCheck($_POST);
			echo json_encode($proceso); 
		}else{
			header('Location:'.base_url()."login");
		}
	}
	public function duplicarMatrizCreada(){
		if(validaInApp("web")){
			$proceso = $this->logicaMis->duplicarMatrizCreada($_POST);
			echo json_encode($proceso); 
		}else{
			header('Location:'.base_url()."login");
		}
	}
}
?>