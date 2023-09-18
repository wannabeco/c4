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
class Administrativos extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");//la idea es que este archivo siempre esté ya que aquí se consultan cosas que son muy globales.
        $this->load->model("administrativos/LogicaAdministrativos", "ladminis");//aquí se debe llamar la lógica correspondiente al módulo que se esté haciendo.
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
	public function cargaPagos($idModulo)	
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
				//traigo los pagos que están cargados
				$infoPagos			   = $this->ladminis->getPagos();
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "administrativos/cargaPagos/home";
				$salida['infoModulo']  = $infoModulo[0];
				$salida['infoPagos']   = $infoPagos;
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
	public function misPagos($idModulo)	
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
				//traigo los pagos que están cargados
				$condicion['idPersona'] = $_SESSION['project']['info']['idPersona'];
				$infoPagos			   = $this->ladminis->getPagos($condicion);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "administrativos/cargaPagos/homePilotos";
				$salida['infoModulo']  = $infoModulo[0];
				$salida['infoPagos']   = $infoPagos;
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
	public function detallePagos($idModulo,$pago)	
	{
		//ini_set("display_errors",1);
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
				//traigo los pagos que están cargados
				$condicion['idPersona'] 	= $_SESSION['project']['info']['idPersona'];
				$condicion['periodoAgrup'] 	= base64_decode($pago);
				$infoPagos			   = $this->ladminis->getPagos($condicion);
				$infoPagosTotal		   = $this->ladminis->getPagosNoGroup($condicion);

				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "administrativos/cargaPagos/homePilotos";
				$salida['infoModulo']  = $infoModulo[0];
				$salida['infoPagos']   = $infoPagos;
				$salida['infoPagosTotal']   = $infoPagosTotal;
				$this->load->view("app/indexBlanco",$salida);
			}
			else
			{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/indexBlanco",$salida);
			}
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}
	public function cargaPlantillaModal()
	{
		extract($_POST);
		//listados 
		if($edita == 1)
		{
			

			$salida["titulo"] 	 = "Editar pagos del usuario";
			$salida["edita"]  	 = $edita;
			$salida["labelBtn"]  = "EDITAR PAGO";
		}
		else
		{
			$salida["titulo"] 	 = "Agregar nuevo listado de pagos";
			$salida["datos"] 	 = array();
			$salida["edita"]  	 = $edita;
			$salida["labelBtn"]  = "CREAR PAGO";
		}
		echo $this->load->view("administrativos/cargaPagos/formControl",$salida,true);
	}

	public function descargaListadoFaltantes()
	{
		$tabla = '';
		if(count($_SESSION['faltantes']) > 0)//si hay
		{
			$tabla .= "<table border='1'>";
				$tabla .= "<tr>";
					$tabla .= "<th>IDENTIFICACION</th>";
					$tabla .= "<th>NOMBRE</th>";
					$tabla .= "<th>ID PAGO</th>";
					$tabla .= "<th>CONCEPTO</th>";
					$tabla .= "<th>VALOR</th>";
				$tabla .= "</tr>";
				foreach ($_SESSION['faltantes'] as $key => $value)
				{
					$tabla .= "<tr>";
						$tabla .= "<td>".$value[0]."</td>";
						$tabla .= "<td>".$value[1]."</td>";
						$tabla .= "<td>".$value[2]."</td>";
						$tabla .= "<td>".$value[3]."</td>";
						$tabla .= "<td>".$value[4]."</td>";
					$tabla .= "</tr>";
				}
			$tabla .= "</table>";
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=pagos-no-insertados.xls");
			echo $tabla;
			die();
		}
		else//no hay nada
		{

		}
	}

	public function procesaListas()
	{
		if(isset($_FILES) && $_FILES['excelFile']['name'] != "")
		{
			$config['upload_path'] 	 = './res/cargueMasivo';
	        $config['allowed_types'] = 'xls|xlsx|csv';
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
	            	/*//var_dump($_POST);
	            	$dataExcel 		= $this->excel->importarExcel($data['full_path']);

	            	//ahora debo tomar la data del excel y realizar el cargue.
	            	$dataInsertada	= $this->ladminis->insertaMasivo($dataExcel,$_POST);		
	                @unlink($data['full_path']);
	               // echo json_encode($dataInsertada);*/
	                ;
					$csv = $data['full_path'];
					$arregloNuevo = array();
					$handle = fopen($csv,"r");
					$cont = 0;
					while (($row = fgetcsv($handle, 1000000, ";")) != FALSE) //get row vales
					{
						if($cont > 0)
						{
							if($row[3] != "")
							{
								$infoPersona 				  = $this->logica->getPersonas(array("nroDocumento"=>$row[0])); 
								if(count($infoPersona) > 0)
								{
									$dataInserta['idPedido']      = 0;
					                $dataInserta['idPersona']     = $infoPersona[0]['idPersona'];
					                $dataInserta['conceptoPago']  = $row[3];
					                $dataInserta['codigoPago']    = $row[2];
					                $dataInserta['valorPago']     = $row[4];
					                $dataInserta['periodoPago']   = $_POST['periodo'];
					                $dataInserta['nombrePeriodo'] = $_POST['nombreLista'];
					                $dataInserta['periodoAgrup']  = eliminaCaracteres($_POST['nombreLista']);
					                $dataInserta['fecha']         = date("Y-m-d H:i:s");
					                $dataInserta['idusuario']     = $_SESSION['project']['info']['idPersona'];
					                //inserto pago a pago
					                $pagoInsert = $this->ladminis->insertaPago($dataInserta);
								}
								else
								{
									//creo un array donde mostraré los usuarios que no se van a crear porque no existen la base de datos de usuarios.
									$arrayNoExiste[] = $row;
								}
							}
						}
						$cont++;
					}

					//acá verifico si hay datos que no se insertaron.
					if(count($arrayNoExiste) > 0)
					{
						$_SESSION['faltantes'] = $arrayNoExiste;
						$salida = array("mensaje"=>"Se ha realizado el cargue de los pagos, pero hay algunos clientes que no estaban creados como usuarios.",
	                				    "continuar"=>1,
	                				    "archivo"=>1,
	                				    "datos"=>array());
	                	echo json_encode($salida);
					}
					else
					{
						$salida = array("mensaje"=>"Se ha realizado el cargue de los pagos de manera existosa.",
	                				    "continuar"=>1,
	                				    "archivo"=>0,
	                				    "datos"=>array());
	                	echo json_encode($salida);
					}
	            }
	            else
	            {
	                @unlink($data['full_path']);
	                $salida = array("mensaje"=>"El archivo ".$data['file_name']." no ha sido cargado",
	                				"continuar"=>0,
	                				"archivo"=>0,
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