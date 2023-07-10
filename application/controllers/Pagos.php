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
        $accion = $_GET["pago"];
        if($accion == "empresa"){
            $idPago = $_GET["idPago"];
            $compraTemporal				= $this->logica->compraEmpresaTemporal($idPago);
            //var_dump($compraTemporal);die();
            $salida['titulo']           = "Pasarela de pago";
            $salida['centro']           = "registro/pagoOnline";
            $salida['pagoRealizar']     = "Pago de empresas";
            $salida['proveedor']        = "payu";
            $salida['compraTemporal']   = $compraTemporal;
            $salida['codigoPago']       = $compraTemporal[0]["codigoPago"];
            $this->load->view("registro/indexPago",$salida);    
        }
        else if($accion == "matrices"){
            $idPago = $_GET["idPago"];
            $compraTemporal				= $this->logica->compraMatrizTemporal($idPago);
            //var_dump($compraTemporal);die();
            //consulto la info de la tienda
            $salida['titulo']           = "Pasarela de pago";
            $salida['centro']           = "registro/pagoOnline";
            $salida['proveedor']        = "payu";
            $salida['pagoRealizar']     = "Pago de matrices";
            $salida['compraTemporal']   = $compraTemporal;
            $salida['codigoPago']       = $compraTemporal[0]["codigoPago"];
            $this->load->view("registro/indexPago",$salida);    
        }   
    }
    //confirmacion de pago
	public function confirmacionPago()
    {
        extract($_POST);
        //debo actualizar la informacon del pedido con lo que me retorno payu
        $dataInserta['estadoPago']      = $state_pol;
        $dataInserta['transactionid']   = $transaction_id;
        $dataInserta['reference_pol']   = $reference_pol;
        $dataInserta['valor']           = $value;
        $dataInserta['moneda']          = $currency;
        $dataInserta['entidad']         = $payment_method;
        $dataInserta['fechaPago']       = date("Y-m-d H:i:s");
        $dataInserta['ip']              = getIP();
        $condicion['codigoPedido']      = $reference_sale;
        $updatePedido                   = $this->logica->actualizaDatos($dataInserta,$condicion);
        //envia el mensaje al administrador de la tienda diciendo que el pedido llego
        $mensajeMail  = "Confirmación de pago del pedido <strong>".$reference_sale."</strong><br><br>";
        sendMail(_ADMIN_PEDIDOS,"Estado de pago del pedido ".$reference_sale,$mensajeMail);
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





    //respuesta de pago
    public function respuestaPago()
    {   
        extract($_GET);
        var_dump($_GET);die();
        //var_dump($_GET);die();
        // $idTienda = $_SESSION['project']['info']['idTienda'];
        // $infoTienda     = $this->logica->getInfoTiendaNew($idTienda);
        // $mes = $infoTienda['datos'][0]['mesGratis'];
        // $fechaCaducidad = $infoTienda['datos'][0]['fechaCaducidad'];
        // $fehcaActual = date('Y,m,d,H:i:s');
        // $idTransaccion = $_GET['referenceCode'];
        
        // $ApiKey             = $infoTienda['datos'][0]['payu_apikey'];

        // $merchant_id        = $_GET['merchantId'];
        // $referenceCode      = $_GET['referenceCode'];
        // $TX_VALUE           = $_GET['TX_VALUE'];
        // $New_value          = number_format($TX_VALUE, 1, '.', '');
        // $currency           = $_GET['currency'];
        // $transactionState   = $_GET['transactionState'];
        // $firma_cadena       = "$ApiKey~$merchant_id~$referenceCode~$TX_VALUE~$currency";
        // $firmacreada        = md5($firma_cadena);
        // //echo $firmacreada;
        // $firma              = $_GET['signature'];
        // $reference_pol      = $_GET['reference_pol'];
        // $cus                = $_GET['cus'];
        // $extra1             = $_GET['description'];//confirmar con farez
        // $pseBank            = $_GET['pseBank'];
        // $lapPaymentMethod   = $_GET['lapPaymentMethod'];
        // $transactionId      = $_GET['transactionId'];

        // $_GET['transactionState'] == 4;
        // $_GET['transactionState'] == 6;
        // $_GET['transactionState'] == 104;
        // $_GET['transactionState'] == 7;
        // $_GET['transactionState'] == 999;
        // $_GET['transactionState'] == 000;
        // $_GET['transactionState'] == 998 ;

        

        // //var_dump($_GET);die();
        // $salida['estadoTx']         =   $estadoTx;
        // $salida['ApiKey']           =   $ApiKey;
        // $salida['merchant_id']      =   $merchant_id;
        // $salida['referenceCode']    =   $referenceCode;
        // $salida['TX_VALUE']         =   $TX_VALUE;
        // $salida['New_value']        =   $New_value;
        // $salida['currency']         =   $currency;
        // $salida['transactionState'] =   $transactionState;
        // $salida['firma_cadena']     =   $firma_cadena;
        // $salida['firmacreada']      =   $firmacreada;
        // $salida['firma']            =   $firma;
        // $salida['reference_pol']    =   $reference_pol;
        // $salida['cus']              =   $cus;
        // $salida['extra1']           =   $extra1;
        // $salida['pseBank']          =   $pseBank;
        // $salida['lapPaymentMethod'] =   $lapPaymentMethod;
        // $salida['transactionId']    =   $transactionId;
        // $salida['infoTienda']       =   $infoTienda['datos'][0];
        // $salida['titulo']      = lang("resp_pago");
        // $salida['titulo']      = lang("titulo")." - ".lang("text35");
        // $salida['centro']      = "pedidos/respuestaPagoMembresia";
        // $salida['claseLabel']   = $claseLabel;
        
		// $this->load->view("registro/indexPago",$salida);
    }
}
?>