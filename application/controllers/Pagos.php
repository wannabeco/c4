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
class Pagos extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");//la idea es que este archivo siempre esté ya que aquí se consultan cosas que son muy globales.
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
    
    //pop para pago payu
    public function procesoPagoOnline(){
        // define('payu_apikey', '4Vj8eK4rloUd272L48hsrarnUA');
        define('payu_id_mercado', '508029');
        define('payu_id_cuenta', '512321');


        $accion = $_GET["pago"];
        if($accion == "empresa"){
            $idPago = $_GET["idPago"];
            $compraTemporal				= $this->logica->compraEmpresaTemporal($idPago);
            $salida['titulo']           = "Pasarela de pago";
            $salida['centro']           = "registro/pagoOnline";
            $salida['pagoRealizar']     = "Pago de empresas";
            $salida['proveedor']        = "payu";
            $salida['compraTemporal']   = $compraTemporal;
            $salida['codigoPago']       = $compraTemporal[0]["codigoPago"];
            $salida['nombreTransaccion']  = "Compra de empresas.";
            $salida['payu_apikey']  = "4Vj8eK4rloUd272L48hsrarnUA";
            $this->load->view("registro/indexPago",$salida);    
        }
        else if($accion == "matrices"){
            $idPago = $_GET["idPago"];
            $compraTemporal				= $this->logica->compraMatrizTemporal($idPago);
            $salida['titulo']           = "Pasarela de pago";
            $salida['centro']           = "registro/pagoOnline";
            $salida['proveedor']        = "payu";
            $salida['pagoRealizar']     = "Pago de matrices";
            $salida['compraTemporal']   = $compraTemporal;
            $salida['codigoPago']       = $compraTemporal[0]["codigoPago"];
            $salida['nombreTransaccion']  = "Compra de matriz.";
            $salida['payu_apikey']  = "4Vj8eK4rloUd272L48hsrarnUA";
            $this->load->view("registro/indexPago",$salida);    
        }  
        //pago mensualidad de empresa 
        else if($accion == "Mensualidad empresas"){
            $idPago             = $_GET["idPago"];
            $idPlan["idPlan"] = $_GET["idPLan"];
            $duracion = $_GET["duracion"];
            $idEmpresa          = $_SESSION["project"]["info"]["idEmpresa"];
            $infoPlanes	        = $this->logica->infoPlanesid($idPlan);
            $compraTemporal     = $this->logica->pagoEmpresaMesC($idPago);
            $infoUsuarios       = $this->logica->getUsuarioEmpresa($idEmpresa);
            $infoMatrices       = $this->logica->getMatricesEmpresas($idEmpresa);
            $infoPlanEmrpesa    = $this->logica->infoPlanesrel($idEmpresa);
            if($infoPlanEmrpesa["continuar"] == 1){
                $plan = $_GET["idPLan"];
                $usuariosPlan = $infoPlanes[0]["canUsuarios"];
                $checksPlan = $infoPlanes[0]["canMatrices"];
                $actualizo = $this->logica->actualizoPlanesrel($idEmpresa,$usuariosPlan,$checksPlan,$plan);
            }
            else{
                $plan = $_GET["idPLan"];
                $usuariosPlan = $infoPlanes[0]["canUsuarios"];
                $checksPlan = $infoPlanes[0]["canMatrices"];
                $creaPlanrelEmpresa  = $this->logica->creoPlanesrel($idEmpresa,$usuariosPlan,$checksPlan,$plan);
            }
            $preciosPerfil      = array();
            $precioMatrices     = array();

            if($duracion == "year"){
                $precioPlanEmpresa  = $infoPlanes[0]["precio"]*$infoPlanes[0]["mesCobraYear"];
            }if($duracion == "mes"){
                $precioPlanEmpresa  = $infoPlanes[0]["precio"];
            }
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
            if(count($preciosPerfil) > $infoPlanes[0]["canUsuarios"]){
                $totalPerfil = array_sum($preciosPerfil);
                $cantPerfiles = count($preciosPerfil);
            }else{
                $totalPerfil = 0;
                $cantPerfiles = 0;
            }
            if(count($precioMatrices) > $infoPlanes[0]["canMatrices"]){
                $cantMatrices = count($precioMatrices);
                $totalMatrices = array_sum($precioMatrices);
            }
            else{
                $cantMatrices = 0;
                $totalMatrices = 0;
            }
            $adicionales        = $totalPerfil+ $totalMatrices;
            $totalPagarEmpresa  = $precioPlanEmpresa+ $totalPerfil+ $totalMatrices;
            $salida['titulo']           = "Pasarela de pago";
            $salida['centro']           = "registro/pagoOnline";
            $salida['proveedor']        = "payu";
            $salida['pagoRealizar']     = "Pago plan empresa";
            $salida['compraTemporal']   = $compraTemporal;
            $salida['codigoPago']       = $compraTemporal[0]["codigoPago"];
            if($duracion == "year"){
                $salida['nombreTransaccion'] = "Compra membresia anual empresa.";
            }if($duracion == "mes"){
                $salida['nombreTransaccion'] = "Compra membresia mensual empresa.";
            }
            $salida['infoPlanes']   	= $infoPlanes;
            $salida['infoUsuarios'] 	= $infoUsuarios["count"];
            $salida['infoMatrices'] 	= $infoMatrices["count"];
            $salida['totalPerfil'] 		= $totalPerfil;
            $salida['totalMatrices'] 	= $totalMatrices;
            $salida['totalPagarEmpresa']= $totalPagarEmpresa;
            $salida['adicionales'] 		= $adicionales;
            $salida['cantPerfiles'] 	= $cantPerfiles;
            $salida['cantMatrices'] 	= $cantMatrices;
            $salida['precioPlanEmpresa']= $precioPlanEmpresa;
            $salida['payu_apikey']      = "4Vj8eK4rloUd272L48hsrarnUA";
            $this->load->view("registro/indexPago",$salida);    
        }
        // mensualidad oficial de cumplimiento
        else if($accion == "Mensualidad Oficial"){
            $idPago             = $_GET["idPago"];
            $dataPago           = $this->logica->infoPagoMesOficial($idPago);
            $infoPlanes	        = $this->logica->infoPlanes();
			$precioPlanEmpresa = "";
			$idPersona 			= $_SESSION["project"]["info"]["idPersona"];
			$EmpresasCompradas 	= $this->logicaMis->infoEmpresasCompradas($idPersona);
			$compradas          = array();
            foreach($infoPlanes as $planes){
				if($planes["dirigido"]  == 1){
					$precioPlanEmpresa = $planes["precio"];
				}
			}
			foreach ($EmpresasCompradas as $rels) {
				if (isset($rels)) {
					array_push($compradas, $rels["precioEmpresa"]);
				}
			}
			$totalCompradas = array_sum($compradas);
			$cantCompradas = count($compradas);
            $totalPagarEmpresa = $precioPlanEmpresa+ $totalCompradas;
            $salida['titulo']           = "Pasarela de pago";
            $salida['centro']           = "registro/pagoOnline";
            $salida['proveedor']        = "payu";
            $salida['pagoRealizar']     = "Pago plan oficial de cumplimiento";
            $salida['codigoPago']       = $dataPago[0]["codigoPago"];
            $salida['nombreTransaccion']= "Compra mensualidad oficial.";
            $salida['compraTemporal']   = "";
            $salida['infoPlanes']   	= $infoPlanes;
            $salida['precioPlanEmpresa']= $precioPlanEmpresa;
            $salida['cantCompradas']    = $cantCompradas;
            $salida['totalCompradas']    = $totalCompradas;
            $salida['totalPagarEmpresa']= $totalPagarEmpresa;
            $salida['payu_apikey']  = "4Vj8eK4rloUd272L48hsrarnUA";
            $this->load->view("registro/indexPago",$salida);    
        } 

    }
    //confirmacion de pago
	public function confirmacionPago()
    {
        extract($_POST);
        $descripcion = $_POST["descripcion"];
        //debo actualizar la informacon del pedido con lo que me retorno payu
        if($descripcion == "Compra de matriz."){
            $dataInserta['estadoPago']      = $state_pol;
            $dataInserta['transactionid']   = $transaction_id;
            $dataInserta['reference_pol']   = $reference_pol;
            $dataInserta['valor']           = $value;
            $dataInserta['moneda']          = $currency;
            $dataInserta['entidad']         = $payment_method;
            $dataInserta['fechaPago']       = date("Y-m-d H:i:s");
            $dataInserta['ip']              = getIP();
            $condicion['codigoPedido']      = $reference_sale;
            $pagoMatriz                       = $this->logica->pagoMatriz($dataInserta);
            //envia el mensaje al administrador de la tienda diciendo que el pedido llego
        }
        if($descripcion == "Compra de empresas."){
                $dataInserta['estadoPago']      = $state_pol;
                $dataInserta['transactionid']   = $transaction_id;
                $dataInserta['reference_pol']   = $reference_pol;
                $dataInserta['valor']           = $value;
                $dataInserta['moneda']          = $currency;
                $dataInserta['entidad']         = $payment_method;
                $dataInserta['fechaPago']       = date("Y-m-d H:i:s");
                $dataInserta['ip']              = getIP();
                $condicion['codigoPedido']      = $reference_sale;
                $pagoMatriz               = $this->logica->pagoEmpresaO($dataInserta);
        }
        //compra mensualidad empresa
        if($descripcion == "Compra membresia mensual empresa."){
            $dataInserta['estadoPago']      = $state_pol;
            $dataInserta['transactionid']   = $transaction_id;
            $dataInserta['reference_pol']   = $reference_pol;
            $dataInserta['valor']           = $value;
            $dataInserta['moneda']          = $currency;
            $dataInserta['entidad']         = $payment_method;
            $dataInserta['fechaPago']       = date("Y-m-d H:i:s");
            $dataInserta['ip']              = getIP();
            $condicion['codigoPedido']      = $reference_sale;
            $pagoMatriz               = $this->logica->pagoMempersa($dataInserta);
        }
        //compra mensualidad oficial de cumplimiento
        if($descripcion == "Compra mensualidad oficial."){
            $datos['codigoPago']      = $referenceCode;
            $datos['email']           = $_GET['buyerEmail'];
            $datos['estadoPago']      = $transactionState;
            $datos['formaPago']       = $_GET['lapPaymentMethodType'];
            $datos['transactionid']   = $transactionId;
            $datos['referencia_pol']  = $reference_pol;
            $datos['valor']           = $TX_VALUE;
            $datos['moneda']          = $currency;
            $datos['entidad']         = $lapPaymentMethod;
            $datos['fechaPago']       = date("Y-m-d H:i:s");
            $datos['ip']              = getIP();
            $pagoMatriz               = $this->logica->pagoMoficial($datos);
        }
        if($descripcion == "Compra membresia anual empresa."){
            $dataInserta['estadoPago']      = $state_pol;
            $dataInserta['transactionid']   = $transaction_id;
            $dataInserta['reference_pol']   = $reference_pol;
            $dataInserta['valor']           = $value;
            $dataInserta['moneda']          = $currency;
            $dataInserta['entidad']         = $payment_method;
            $dataInserta['fechaPago']       = date("Y-m-d H:i:s");
            $dataInserta['ip']              = getIP();
            $condicion['codigoPedido']      = $reference_sale;
            $pagoMatriz               = $this->logica->pagoAempersa($dataInserta);
        }
    }
    //confirma pago matrices
    public function pagoMatrices(){
        if(validaInApp("web")){//esta validación me hará consultas más seguras
			var_dump($_POST);die();
			// $procesoElimina = $this->logMatriz->eliminaNuevaMatriz($_POST);
			// echo json_encode($procesoElimina);
		}
		else{
            $respuesta ="nada";
            echo json_encode($respuesta); 
		}
    }
    //confirma pago empresas
    public function pagoEmpresas(){
        if(validaInApp("web")){//esta validación me hará consultas más seguras
			var_dump($_POST);die();
			// $procesoElimina = $this->logMatriz->eliminaNuevaMatriz($_POST);
			// echo json_encode($procesoElimina);
		}
		else{
            $respuesta ="nada";
            echo json_encode($respuesta); 
		}

    }

    //respuesta de pago inmediata
    public function respuestaPago()
    {   
        $payu_apikey = "4Vj8eK4rloUd272L48hsrarnUA";
        extract($_GET);
        $idEmpresa = $_SESSION['project']['info']['idEmpresa'];
        $infoTienda     = $this->logica->infoEmpresa($idEmpresa);
        $descripcion = $_GET['description'];
        $ApiKey             = $payu_apikey;
        $merchant_id        = $_GET['merchantId'];
        $referenceCode      = $_GET['referenceCode'];
        $TX_VALUE           = $_GET['TX_VALUE'];
        $New_value          = number_format($TX_VALUE, 1, '.', '');
        $currency           = $_GET['currency'];
        $estadoTx           = $_GET['lapTransactionState'];
        $transactionState   = $_GET['transactionState'];
        $firma_cadena       = "$ApiKey~$merchant_id~$referenceCode~$TX_VALUE~$currency";
        $firmacreada        = md5($firma_cadena);
        $firma              = $_GET['signature'];
        $reference_pol      = $_GET['reference_pol'];
        $cus                = $_GET['cus'];

        //cuando es compra de matriz
        if($descripcion == "Compra de matriz."){
            if($_GET['transactionState'] == 4){
                $estadoTx = lang("trans_aprobada");
                $claseLabel = "label-success";
            }
            if($_GET['transactionState'] == 6){
                $estadoTx = lang("trans_rechazada");
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 7){
                $estadoTx = lang("trans_pendiente");
                $claseLabel = "label-primary";
            }
            if($_GET['transactionState'] == 104){
                $estadoTx = "Error";
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 999){
                $estadoTx = "Pago no realizado";
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 000){
                $estadoTx = "Esperando Pago";
                $claseLabel = "label-warning";
            }
            if($_GET['transactionState'] == 998){
                $estadoTx = "Pago realizado";
                $claseLabel = "label-success";
            }
                $datos['codigoPago']      = $referenceCode;
                $datos['email']           = $_GET['buyerEmail'];
                $datos['estadoPago']      = $transactionState;
                $datos['formaPago']       = $_GET['lapPaymentMethodType'];
                $datos['transactionid']   = $transactionId;
                $datos['referencia_pol']  = $reference_pol;
                $datos['valor']           = $TX_VALUE;
                $datos['moneda']          = $currency;
                $datos['entidad']         = $lapPaymentMethod;
                $datos['fechaPago']       = date("Y-m-d H:i:s");
                $datos['ip']              = getIP();
                // $mensajeMail                      = $_GET['buyerEmail'];
                $pagoMatriz               = $this->logica->pagoMatriz($datos);
        }
        //cuando oficial de cumplimiento compra empresas
        if($descripcion == "Compra de empresas."){
            if($_GET['transactionState'] == 4){
                $estadoTx = lang("trans_aprobada");
                $claseLabel = "label-success";
            }
            if($_GET['transactionState'] == 6){
                $estadoTx = lang("trans_rechazada");
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 7){
                $estadoTx = lang("trans_pendiente");
                $claseLabel = "label-primary";
            }
            if($_GET['transactionState'] == 104){
                $estadoTx = "Error";
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 999){
                $estadoTx = "Pago no realizado";
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 000){
                $estadoTx = "Esperando Pago";
                $claseLabel = "label-warning";
            }
            if($_GET['transactionState'] == 998){
                $estadoTx = "Pago realizado";
                $claseLabel = "label-success";
            }
                $datos['codigoPago']      = $referenceCode;
                $datos['email']           = $_GET['buyerEmail'];
                $datos['estadoPago']      = $transactionState;
                $datos['formaPago']       = $_GET['lapPaymentMethodType'];
                $datos['transactionid']   = $transactionId;
                $datos['referencia_pol']  = $reference_pol;
                $datos['valor']           = $TX_VALUE;
                $datos['moneda']          = $currency;
                $datos['entidad']         = $lapPaymentMethod;
                $datos['fechaPago']       = date("Y-m-d H:i:s");
                $datos['ip']              = getIP();
                $pagoMatriz               = $this->logica->pagoEmpresaO($datos);
        }
        //compra mensualidad empresa
        if($descripcion == "Compra membresia mensual empresa."){
            if($_GET['transactionState'] == 4){
                $estadoTx = lang("trans_aprobada");
                $claseLabel = "label-success";
            }
            if($_GET['transactionState'] == 6){
                $estadoTx = lang("trans_rechazada");
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 7){
                $estadoTx = lang("trans_pendiente");
                $claseLabel = "label-primary";
            }
            if($_GET['transactionState'] == 104){
                $estadoTx = "Error";
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 999){
                $estadoTx = "Pago no realizado";
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 000){
                $estadoTx = "Esperando Pago";
                $claseLabel = "label-warning";
            }
            if($_GET['transactionState'] == 998){
                $estadoTx = "Pago realizado";
                $claseLabel = "label-success";
            }
                $datos['codigoPago']      = $referenceCode;
                $datos['email']           = $_GET['buyerEmail'];
                $datos['estadoPago']      = $transactionState;
                $datos['formaPago']       = $_GET['lapPaymentMethodType'];
                $datos['transactionid']   = $transactionId;
                $datos['referencia_pol']  = $reference_pol;
                $datos['valor']           = $TX_VALUE;
                $datos['moneda']          = $currency;
                $datos['entidad']         = $lapPaymentMethod;
                $datos['fechaPago']       = date("Y-m-d H:i:s");
                $datos['ip']              = getIP();
                $pagoMatriz               = $this->logica->pagoMempersa($datos);
        }
        //mensualidad oficial de cumplimiento
        if($descripcion == "Compra mensualidad oficial."){
            if($_GET['transactionState'] == 4){
                $estadoTx = lang("trans_aprobada");
                $claseLabel = "label-success";
            }
            if($_GET['transactionState'] == 6){
                $estadoTx = lang("trans_rechazada");
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 7){
                $estadoTx = lang("trans_pendiente");
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 104){
                $estadoTx = "Error";
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 999){
                $estadoTx = "Pago no realizado";
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 000){
                $estadoTx = "Esperando Pago";
                $claseLabel = "label-warning";
            }
            if($_GET['transactionState'] == 998){
                $estadoTx = "Pago realizado";
                $claseLabel = "label-success";
            }
                $datos['codigoPago']      = $referenceCode;
                $datos['email']           = $_GET['buyerEmail'];
                $datos['estadoPago']      = $transactionState;
                $datos['formaPago']       = $_GET['lapPaymentMethodType'];
                $datos['transactionid']   = $transactionId;
                $datos['referencia_pol']  = $reference_pol;
                $datos['valor']           = $TX_VALUE;
                $datos['moneda']          = $currency;
                $datos['entidad']         = $lapPaymentMethod;
                $datos['fechaPago']       = date("Y-m-d H:i:s");
                $datos['ip']              = getIP();
                $pagoMatriz               = $this->logica->pagoMoficial($datos);
        }
        //compra mensualidad empresa
        if($descripcion == "Compra membresia anual empresa."){
            if($_GET['transactionState'] == 4){
                $estadoTx = lang("trans_aprobada");
                $claseLabel = "label-success";
            }
            if($_GET['transactionState'] == 6){
                $estadoTx = lang("trans_rechazada");
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 7){
                $estadoTx = lang("trans_pendiente");
                $claseLabel = "label-primary";
            }
            if($_GET['transactionState'] == 104){
                $estadoTx = "Error";
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 999){
                $estadoTx = "Pago no realizado";
                $claseLabel = "label-danger";
            }
            if($_GET['transactionState'] == 000){
                $estadoTx = "Esperando Pago";
                $claseLabel = "label-warning";
            }
            if($_GET['transactionState'] == 998){
                $estadoTx = "Pago realizado";
                $claseLabel = "label-success";
            }
                $datos['codigoPago']      = $referenceCode;
                $datos['email']           = $_GET['buyerEmail'];
                $datos['estadoPago']      = $transactionState;
                $datos['formaPago']       = $_GET['lapPaymentMethodType'];
                $datos['transactionid']   = $transactionId;
                $datos['referencia_pol']  = $reference_pol;
                $datos['valor']           = $TX_VALUE;
                $datos['moneda']          = $currency;
                $datos['entidad']         = $lapPaymentMethod;
                $datos['fechaPago']       = date("Y-m-d H:i:s");
                $datos['ip']              = getIP();
                $pagoMatriz               = $this->logica->pagoAempersa($datos);
        }
        $salida['estadoTx']         =   $estadoTx;
        $salida['ApiKey']           =   $ApiKey;
        $salida['merchant_id']      =   $merchant_id;
        $salida['referenceCode']    =   $referenceCode;
        $salida['TX_VALUE']         =   $TX_VALUE;
        $salida['New_value']        =   $New_value;
        $salida['currency']         =   $currency;
        $salida['transactionState'] =   $transactionState;
        $salida['firma_cadena']     =   $firma_cadena;
        $salida['firmacreada']      =   $firmacreada;
        $salida['firma']            =   $firma;
        $salida['reference_pol']    =   $reference_pol;
        $salida['cus']              =   $cus;
        $salida['extra1']           =   $extra1;
        $salida['pseBank']          =   $pseBank;
        $salida['lapPaymentMethod'] =   $lapPaymentMethod;
        $salida['transactionId']    =   $transactionId;
        $salida['infoTienda']       =   $infoTienda;
        $salida['titulo']      = lang("resp_pago");
        $salida['titulo']      = lang("titulo")." - ".lang("text35");
        $salida['centro']      = "registro/respuestaPago";
        $salida['claseLabel']   = $claseLabel;
		$this->load->view("registro/indexPago",$salida);
    }
}

?>