<?php
/*

    ("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por  @orugal
   https://github.com/orugal
*/
class LogicaGeneral  {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("general/BaseDatosGral","dbGeneral");
    } 
    public function getCiudades($where)
    {
        $listaCiudades = $this->ci->dbGeneral->getCiudades($where);
        if(count($listaCiudades) > 0)
        {
            $respuesta = array("mensaje"=>"Listado de ciudades",
                              "continuar"=>1,
                              "datos"=>$listaCiudades);            
        }
        else
        {
            $respuesta = array("mensaje"=>"No existen ciudades",
                              "continuar"=>0,
                              "datos"=>"");    

        }
        return $respuesta;
    }
    //consulto el listado de módulos de base de datos
    public function getModulos()
    {   
        //var_dump($_SESSION['project']['info']);
        $listaModulos        = array();
        $where['r.idPerfil'] = $_SESSION['project']['info']['idPerfil'];
        $where['r.ver']      = 1;
        $where['m.estado']   = 1;
        $modulos             = $this->ci->dbGeneral->getDistCatModuloModulos($where);
        foreach($modulos as $m)
        {
            $modWhereIn[] = $m['idPadre'];
        }
        $modulosReal         = $this->ci->dbGeneral->getModulosIn($modWhereIn);
        //var_dump($modulosReal);
        //recorro las categorias de los módulos
        foreach($modulosReal as $mod)
        {
            $where['r.idPerfil']  = $_SESSION['project']['info']['idPerfil'];
            $where['m.idPadre']   = $mod['idModulo'];
            $where['m.estado']    = 1;
            $where['m.eliminado'] = 0;
            $modulosHijos        = $this->ci->dbGeneral->getModulos($where);
           
            //capturo la info del módulo
            $infoModulo          = $this->ci->dbGeneral->infoModulo(array("idModulo"=>$mod['idModulo']));
            $salidaParcial       = array("idPadre"=>$mod['idModulo'],
                                         "nombreModulo"=>$infoModulo[0]['nombreModulo'],
                                         "icono"=>$infoModulo[0]['icono'],
                                         "modulos"=>$modulosHijos);
            array_push($listaModulos,$salidaParcial);
        }
        return $listaModulos;
    }
    //consulto el listado de módulos de base de datos
    public function getModulosCompletos($padre)
    {
        $listaModulos        = array();
        $where['idPadre']    = $padre;
        //$where['estado']     = 1;
        $where['eliminado']  = 0;
        $modulos             = $this->ci->dbGeneral->infoModulo($where);
        //recorro las categorias de los módulos
        foreach($modulos as $mod)
        {
            $whereH['idPadre']      = $mod['idModulo'];
            //$whereH['estado']     = 1;
            $whereH['eliminado']  = 0;
            $modulosHijos        = $this->ci->dbGeneral->infoModulo($whereH);
            //capturo la info del módulo
            $salidaParcial       = array("idPadre"=>$mod['idModulo'],
                                         "nombreModulo"=>$mod['nombreModulo'],
                                         "urlModulo"=>$mod['urlModulo'],
                                         "icono"=>$mod['icono'],
                                         "estado"=>$mod['estado'],
                                         "eliminado"=>$mod['eliminado'],
                                         "modulos"=>$modulosHijos);
            array_push($listaModulos,$salidaParcial);
        }
        return $listaModulos;
    }
    public function infoModulo($idModulo)
    {
        $infoModulo          = $this->ci->dbGeneral->infoModulo(array("idModulo"=>$idModulo));
        return $infoModulo;
    }
    public function consultaPerfiles()
    {
        $where['estado']    = 1;
        $perfiles          = $this->ci->dbGeneral->consultaPerfiles($where);
        return $perfiles;
    }
    public function consultatiposDoc()
    {
        $where['estado']    = 1;
        $perfiles          = $this->ci->dbGeneral->consultatiposDoc($where);
        return $perfiles;
    }
    public function consultaSexo()
    {
        $where['estado']    = 1;
        $sexo          = $this->ci->dbGeneral->consultaSexo($where);
        return $sexo;
    }
    public function consultaProfesiones()
    {
        $where['estado']    = 1;
        $profesiones          = $this->ci->dbGeneral->consultaProfesiones($where);
        return $profesiones;
    }
    public function consultaCargos()
    {
        $where['estado']    = 1;
        $cargos          = $this->ci->dbGeneral->consultaCargos($where);
        return $cargos;
    }
    public function consultaAreas()
    {
        $where['estado']    = 1;
        $areas          = $this->ci->dbGeneral->consultaAreas($where);
        return $areas;
    }
    public function consultaCiudades()
    {
        $where['ID_PAIS']    = '057';
        $ciudades          = $this->ci->dbGeneral->getCiudades($where);
        return $ciudades;   
    }

    public function consultaEPS()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaEPS($where);
        return $resultado; 
    }
    public function consultaAFP()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaAFP($where);
        return $resultado; 

    }
    public function consultaCesantias()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaCesantias($where);
        return $resultado; 
    }
    public function consultaAseguradoras()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaAseguradoras($where);
        return $resultado; 
    }
    public function consultaOcupaciones()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaOcupaciones($where);
        return $resultado; 
    }
    public function consultaEstadoCivil()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaEstadoCivil($where);
        return $resultado; 
    }
    public function consultaEscolaridad()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaEscolaridad($where);
        return $resultado; 
    }
    public function consultaReligiones()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaReligiones($where);
        return $resultado; 
    }
    public function consultaGrupoEtnico()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaGrupoEtnico($where);
        return $resultado; 
    }
    public function getServicios()
    {
        $where['estado']    = '1';
        $where['especialista']    = '1';
        $resultado          = $this->ci->dbGeneral->getServicios($where);
        //var_dump($resultado);
        return $resultado; 
    }
    public function getServiciosQuery($where)
    {
        $resultado          = $this->ci->dbGeneral->getServicios($where);
        //var_dump($resultado);
        return $resultado; 
    }
    public function getPersonas($where)
    {
        $resultado          = $this->ci->dbGeneral->getInfoPersonas($where);
        //var_dump($resultado);
        return $resultado; 
    }
    public function getPersonasCruce($where)
    {
        $resultado          = $this->ci->dbGeneral->getInfoPersonasCruce($where);
        //var_dump($resultado);
        return $resultado; 
    }
    public function consultaCieDiez($where,$like)
    {
        $resultado          = $this->ci->dbGeneral->consultaCieDiez($where,$like);
        //var_dump($resultado);
        return $resultado; 
    }
    public function especialistasServicio($post)
    {
        extract($post);
        $where['rs.idServicio']    = $idServicio;
        $where['p.estado']         = '1';
        $resultado          = $this->ci->dbGeneral->especialistasServicio($where);
        return $resultado; 
    }

    public function consultaPerfilesPersist($id)
    {
        $salidaPerf = array();
        $where['estado']     = 1;
        $where['eliminado']  = 0;
        $perfiles            = $this->ci->dbGeneral->consultaPerfiles($where);
        //recorro los perfiles y verifico 
        foreach($perfiles as $per)
        {
            $wherePerfiles['idModulo']  =   $id;
            $wherePerfiles['idPerfil']  =   $per['idPerfil'];
            //verifico los privilegios si el perfil tiene asignado este módulo
            $relacionPerfMod    =   $this->ci->dbGeneral->consultaRelacionPerfil($wherePerfiles);
            //var_dump($relacionPerfMod[0]);
            $dataRecorre = array("idPerfil"=>$per['idPerfil'],
                                 "nombrePerfil"=>$per['nombrePerfil'],
                                 "ver"=>(count($relacionPerfMod) > 0)?$relacionPerfMod[0]['ver']:"0",
                                 "crear"=>(count($relacionPerfMod) > 0)?$relacionPerfMod[0]['crear']:"0",
                                 "editar"=>(count($relacionPerfMod) > 0)?$relacionPerfMod[0]['editar']:"0",
                                 "borrar"=>(count($relacionPerfMod) > 0)?$relacionPerfMod[0]['borrar']:"0");
            array_push($salidaPerf,$dataRecorre);
        }
        //var_dump($salidaPerf);
        return $salidaPerf;
    }
    //get tipo empresa
    public function getTipoEmpresa()
    {
        $where['estado']    = '1';
        $where['eliminado']    = '0';
        $resultado          = $this->ci->dbGeneral->getTipoEmpresa($where);
        //var_dump($resultado);
        return $resultado; 
    }
    //se obtienen todas las empresas
    public function getEmpresas()
    {
        $where['estado']    = '1';
        $where['eliminado']    = '0';
        $resultado          = $this->ci->dbGeneral->getEmpresas($where);
        //var_dump($resultado);
        return $resultado; 
    }
    //inserta registro a la base de datos con datos de pagos, mientras termina la transaccion
    public function insetCodigo($data){
        $dataInserta['idEmpresa']       = $_SESSION['project']['info']['idEmpresa'];
        $dataInserta['codigoPago']      = substr(md5(uniqid()), 0, 16);
        $dataInserta['estadoPago']      = 0;
        $dataInserta['proveedor']       = $data;
        $dataInserta['ip']              = getIP();
        $dataInserta['fechaPago']       = date('Y-m-d H:m:s');
        $dataInserta['nombrePersona']   = $_SESSION['project']['info']['nombre']."".$_SESSION['project']['info']['apellido'];
        $resultado = $this->ci->dbGeneral->insetCodigo($dataInserta);
        $respuesta = array("mensaje"=>"data insert",
                            "continuar"=>1,
                            "datos"=>$resultado);   
        return $respuesta;
    }
    //guarda matriz en compra temporal
    public function insetCmatrizTemporal($datos) {
        extract($datos);
        $tipo = $datos["tipo"];
        $array = json_decode($tipo, true);
        foreach ($array as $tipos) {
            $dataInserta["idPago"]          = $datos["idPago"];
            $dataInserta["idMatriz"]        = $tipos["id"];
            $dataInserta["nombreMatriz"]    = $tipos["nombre"];
            $dataInserta["precioMatriz"]    = $tipos["precio"];
            $dataInserta["idPersona"]       = $_SESSION['project']['info']['idPersona'];
            $dataInserta["idEmpresa"]       = $_SESSION['project']['info']['idEmpresa'];
            $resultado = $this->ci->dbGeneral->insertCmatriz($dataInserta);
        }
        if($resultado > 0){
            $respuesta = array("mensaje"=>"Se ha creado.",
                    "continuar"=>1,
                    "datos"=>$resultado);
        }
        else{
            $respuesta = array("mensaje"=>"no se ha creado.",
                    "continuar"=>0,
                    "datos"=>"");
        }
        return $respuesta;
    }
    public function compraMatrizTemporal($idPago){
        $where["t.idPago"] = $idPago;
        $resultado          = $this->ci->dbGeneral->compraMatrizTemporal($where);
        //var_dump($resultado);
        return $resultado; 
    }
    //inserta codigo de compra de cumplimiento a empresa
    public function insetCodigoEmpresas($data){
        $dataInserta['idPersona']       = $_SESSION['project']['info']['idPersona'];
        $dataInserta['proveedor']       = $data;
        $dataInserta['ip']              = getIP();
        $dataInserta['estadoPago']      = 0;
        $dataInserta['codigoPago']      = substr(md5(uniqid()), 0, 16);
        $dataInserta['fechaPago']       = date('Y-m-d H:m:s');
        $resultado = $this->ci->dbGeneral->insetCodigoEmpresas($dataInserta);
        $respuesta = array("mensaje"=>"data insert",
                            "continuar"=>1,
                            "datos"=>$resultado);   
        return $respuesta;
    }
    //añade pedido temporal de empresas
    public function insetCEmpresaTemporal($datos) {
        extract($datos);
        $tipo = $datos["tipo"];
        $array = json_decode($tipo, true);
        foreach ($array as $tipos) {
            $dataInserta["idPago"]           = $datos["idPago"];
            $dataInserta["idEmpresa"]        = $tipos["id"];
            $dataInserta["nombreEmpresa"]    = $tipos["nombre"];
            $dataInserta["precioEmpresa"]    = $tipos["precio"];
            $dataInserta["idPersona"]        = $_SESSION['project']['info']['idPersona'];
            $resultado = $this->ci->dbGeneral->insetCEmpresaTemporal($dataInserta);
        }
        if($resultado > 0){
            $respuesta = array("mensaje"=>"Se ha creado.",
                    "continuar"=>1,
                    "datos"=>$resultado);
        }
        else{
            $respuesta = array("mensaje"=>"no se ha creado.",
                    "continuar"=>0,
                    "datos"=>"");
        }
        return $respuesta;
    }
    //consulta pedido temporal de empresas
    public function compraEmpresaTemporal($idPago){
        $where["e.idPago"] = $idPago;
        $resultado          = $this->ci->dbGeneral->compraEmpresaTemporal($where);
        //var_dump($resultado);
        return $resultado; 
    }
    //sugiere matrices
    public function sugiereMatriz($datos){
        $dataInserta["idUsuario"]       = $_SESSION['project']['info']['idPersona'];
        $dataInserta["idEmpresa"]       = $_SESSION['project']['info']['idEmpresa'];
        $dataInserta["emailUsuario"]    = $datos["email"];
        $dataInserta["descripcion"]     = $datos["descripcion"];
        $dataInserta["solicitud"]       = $datos["solicitud"];
        $emailUsuario = $datos["email"];
        $descripcion  = $datos["descripcion"];
        $tipoSolicitud = $datos["solicitud"];
        if($datos["matriz"] != ""){
            $dataInserta["nombredeMatriz"]  = $datos["matriz"];
        }
        $dataInserta["fechaSugerencia"] = date('Y-m-d H:m:s');
        $resultado          = $this->ci->dbGeneral->sugiereMatriz($dataInserta);
        //var_dump($resultado);
        if($resultado > 0){
            $email = "desarrollo@wannabe.com.co, kyo20052@gmail.com, msoto@pensiero.com.co, jternera@c4consultinghub.com, jcampo@c4consultinghub.com";
            if($tipoSolicitud == 0){
                $asuntoMensaje  = "Sugerencia.";
                $mensajeenviar  = "<h2>Sugerencia de nuevo check</h2> <br>";
            }if($tipoSolicitud == 1){
                $asuntoMensaje  = "Check a la medida.";
                $mensajeenviar  = "<h2>Solicitud de check a la medida.</h2> <br>";
            }if($tipoSolicitud == 2){
                $asuntoMensaje  = "Soloicitud item interno.";
                $mensajeenviar  = "<h2>Solicitud item interno</h2> <br>";
            }
            $mensajeenviar  .= "<p>Email de usuario: ".$emailUsuario."</p> <br>";
            $mensajeenviar  .= "<p>Descripción: ".$descripcion."</p> <br>";
            $mensaje        = plantillaMail($mensajeenviar);
            $envioMail      = sendMail($email,$asuntoMensaje,$mensaje);


            $respuesta = array("mensaje"=>"La sugerencia, se ha creado correctamente.",
                    "continuar"=>1,
                    "datos"=>$resultado);
        }
        else{
            $respuesta = array("mensaje"=>"no se ha creado la sugerencia.",
                    "continuar"=>0,
                    "datos"=>"");
        }
        return $respuesta;
    }
    //se obtiene todas las sugerencias por id de empresa
    public function misSugerencias($idPersona){
        $where['idUsuario'] = $idPersona;
        $resultado         = $this->ci->dbGeneral->misSugerencias($where); 
        return $resultado;
    }
    //sugerencia por id sugerencia
    public function sugerenciaID($idSugerencia){
        $where['idSugiere'] = $idSugerencia;
        $resultado         = $this->ci->dbGeneral->sugerenciaID($where); 
        return $resultado;
    }
    // se obtiene todas las sugerencias para los administradores
    public function sugerencias(){
        $resultado         = $this->ci->dbGeneral->sugerencias(); 
        return $resultado;
    }
    //actualiza sugerencia con la respuesta
    public function guardaRespuesta($datos){
        $dataActualiza["respuesta"]         = $datos["respuesta"];
        $dataActualiza["fechaRespuesta"]    = date('Y-m-d H:m:s');
        $dataActualiza["estaRespuesta"]     = 1;
        $dataActualiza["emailRespuesta"]    = $_SESSION['project']['info']['email'];
        $where['idSugiere']                 = $datos["idSugiere"];
        $empresas                           = $this->ci->dbGeneral->guardaRespuesta($dataActualiza, $where);
            if($empresas > 0){
                $respuesta = array("mensaje"=>"la respuesta se actualizo correctamente.",
                "continuar"=>1,
                "datos"=>"");
            }else{
                $respuesta = array("mensaje"=>"No fue posible agregar la respuesta.",
                "continuar"=>1,
                "datos"=>"");
            }
        return $respuesta;
    }
    //consulta planes
    public function infoPlanes(){
        $where["elimina"] = 0;
        $resultado         = $this->ci->dbGeneral->infoPlanes($where); 
        return $resultado;
    }
    //consultoPlanes id
    public function infoPlanesid($idPlan){
        $where["idPlan"] = $idPlan["idPlan"];
        $resultado         = $this->ci->dbGeneral->infoPlanes($where); 
        return $resultado;
    }
    //crea palnes
    public function creaPlanes($datos){
        $resultado         = $this->ci->dbGeneral->creaPlanes($datos);
        if($resultado > 0 ){
            $respuesta = array("mensaje"=>"El plan se ha creado correctamente.",
                "continuar"=>1,
                "datos"=>"");
        }
        else{
            $respuesta = array("mensaje"=>"El plan no ha creado.",
                "continuar"=>0,
                "datos"=>"");

        } 
        return $respuesta;
    }
    //actualiza plan
    public function actualizaPlan($datos){
        // var_dump($datos);die();
        $dataActualiza["nombrePlan"]  = $datos["nombrePlan"];
        $dataActualiza["tituloPlan"]  = $datos["tituloPlan"];
        $dataActualiza["descripcion"]  = $datos["descripcion"];
        $dataActualiza["precio"]  = $datos["precio"];
        $dataActualiza["dirigido"]  = $datos["dirigido"];
        $dataActualiza["promocion"]  = $datos["promocion"];
        $dataActualiza["fechaInicio"]  = $datos["fechaInicio"];
        $dataActualiza["fechaFinaliza"]  = $datos["fechaFinaliza"];
        $dataActualiza["estado"]  = $datos["estado"];
        $dataActualiza["canMatrices"]  = $datos["canMatrices"];
        $dataActualiza["canUsuarios"]  = $datos["canUsuarios"];
        $dataActualiza["mesCobraYear"]  = $datos["mesCobraYear"];
        $where['idPlan']           = $datos["idPlan"];
        $empresas                  = $this->ci->dbGeneral->actualizaPlan($dataActualiza, $where);
        if($empresas > 0){
            $respuesta = array("mensaje"=>"El plan se actualizo correctamente.",
            "continuar"=>1,
            "datos"=>"");
        }else{
            $respuesta = array("mensaje"=>"No fue posible actualizar el plan, por favor intentolo Nuevamente.",
            "continuar"=>0,
            "datos"=>"");
        }
    return $respuesta;
    }
    //elimina planes
    public function eliminaPlanes($idPlan){
        $dataActualiza["elimina"]  = 1;
        $where['idPlan']           = $idPlan["idPlan"];
        $empresas                  = $this->ci->dbGeneral->actualizaPlan($dataActualiza, $where);
        if($empresas > 0){
            $respuesta = array("mensaje"=>"El plan se elimino correctamente.",
            "continuar"=>1,
            "datos"=>"");
        }else{
            $respuesta = array("mensaje"=>"No fue posible eliminar el plan.",
            "continuar"=>1,
            "datos"=>"");
        }
    return $respuesta;
    }
    // informacion de cantidad de matrices por empresa
    public function getMatricesEmpresas($idEmpresa){
        $where["c.idEmpresa"]        = $idEmpresa;
        $where["c.estado"]            = 1;
        $where["c.eliminado"]        = 0;
        $matrices                  = $this->ci->dbGeneral->getMatricesEmpresas($where);
        // var_dump($matrices["count"]);die();
        return $matrices;
    }
    // informacion de cantidad de usuarios por empresa
    public function getUsuarioEmpresa($idEmpresa){
        $where["idEmpresa"]        = $idEmpresa;
        $where["p.eliminado"]        = 0;
        $personas                  = $this->ci->dbGeneral->getUsuarioEmpresa($where);
        if($personas > 0){
            $respuesta = $personas;
        }else{
            $respuesta = array("mensaje"=>"No hay informacion.",
            "continuar"=>0,
            "datos"=>"");
        }
    return $respuesta;
    }
    //informacion de empresa.
    public function infoEmpresa($idEmpresa){
        $where["idEmpresa"] = $idEmpresa;
        $resultado         = $this->ci->dbGeneral->getInfoEmpresa($where); 
        return $resultado;
    }
    //pago de matrices
    public function pagoMatriz($datos){
        $where['codigoPago']              = $datos["codigoPago"];
        $dataActualiza['email']           = $datos['email'];
        $dataActualiza['estadoPago']      = $datos['estadoPago'];
        $dataActualiza['formaPago']       = $datos['formaPago'];
        $dataActualiza['transactionid']   = $datos['transactionid'];
        $dataActualiza['referencia_pol']  = $datos['referencia_pol'];
        $dataActualiza['valor']           = $datos['valor'];
        $dataActualiza['moneda']          = $datos['moneda'];
        $dataActualiza['entidad']         = $datos['entidad'];
        $dataActualiza['fechaPago']       = date("Y-m-d H:i:s");
        $dataActualiza['ip']              = getIP();
        $pagoMatriz                       = $this->ci->dbGeneral->pagoMatriz($dataActualiza, $where);
            if($pagoMatriz > 0){
                $where['codigoPago'] = $datos["codigoPago"];
                $PagodeMatriz = $this->ci->dbGeneral->PagodeMatriz($where);
                if($PagodeMatriz[0]["estadoPago"] == 4 || $PagodeMatriz[0]["estadoPago"] == 998){
                    $idPago["idPago"] = $PagodeMatriz[0]["idPago"];
                    $mTemporal = $this->ci->dbGeneral->mTemporal($idPago);
                    foreach($mTemporal as $matrices){
                        $dataInserta["idMatriz"]    = $matrices["idMatriz"];
                        $dataInserta["idEmpresa"]   = $matrices["idEmpresa"];
                        $dataInserta["idPersona"]   = $matrices["idPersona"];
                        $dataInserta["pago"]        = "SI";
                        $dataInserta["fechaPago"]   = $PagodeMatriz[0]["fechaPago"];
                        $MatricesCompradas          = $this->ci->dbGeneral->MatricesCompradas($dataInserta);
                    }
                    if($MatricesCompradas > 0){
                        $respuesta = array("mensaje"=>"Matriz agregada correctamente.",
                                "continuar"=>1,
                                "datos"=>$MatricesCompradas);
                    }
                }
                else if($PagodeMatriz[0]["estadoPago"] == 6 || $PagodeMatriz[0]["estadoPago"] == 104 || $PagodeMatriz[0]["estadoPago"] == 999){
                    $respuesta = array("mensaje"=>"pago rechazado.",
                                "continuar"=>0,
                                "datos"=>"");
                }
                return $respuesta;
            }
    }
    //pago empresas por oficial de cumplimiento
    public function pagoEmpresaO($datos){
        $where['codigoPago']              = $datos["codigoPago"];
        $dataActualiza['email']           = $datos['email'];
        $dataActualiza['estadoPago']      = $datos['estadoPago'];
        $dataActualiza['formaPago']       = $datos['formaPago'];
        $dataActualiza['transactionid']   = $datos['transactionid'];
        $dataActualiza['referencia_pol']  = $datos['referencia_pol'];
        $dataActualiza['valor']           = $datos['valor'];
        $dataActualiza['moneda']          = $datos['moneda'];
        $dataActualiza['entidad']         = $datos['entidad'];
        $dataActualiza['fechaPago']       = date("Y-m-d H:i:s");
        $dataActualiza['ip']              = getIP();
        $pagoEmpresa                       = $this->ci->dbGeneral->pagoEmpresaO($dataActualiza,$where);
            if($pagoEmpresa > 0){
                $where['codigoPago'] = $datos["codigoPago"];
                $pagoEmpresa = $this->ci->dbGeneral->pagoEmpresa($where);
                if($pagoEmpresa[0]["estadoPago"] == 4 || $pagoEmpresa[0]["estadoPago"] == 998){
                    $idPago["idPago"] = $pagoEmpresa[0]["idPagoEmpresa"];
                    $emTemporal = $this->ci->dbGeneral->emTemporal($idPago);
                    // var_dump($emTemporal);die();
                    foreach($emTemporal as $empresa){
                        $dataInserta["idEmpresa"]   = $empresa["idEmpresa"];
                        $dataInserta["idPersona"]   = $empresa["idPersona"];
                        $dataInserta["idPagoEmpresa"] = $empresa["idPago"];
                        $dataInserta["precioEmpresa"] = $empresa["precioEmpresa"];
                        $dataInserta["fecha"]       = $pagoEmpresa[0]["fechaPago"];
                        $EmpresasCompradas          = $this->ci->dbGeneral->reslEmpresasOf($dataInserta);
                    }
                    if($EmpresasCompradas > 0){
                        $respuesta = array("mensaje"=>"la empresa fue agregada correctamente.",
                                "continuar"=>1,
                                "datos"=>$EmpresasCompradas);
                    }
                    $respuesta = array("mensaje"=>"Por favor comuniquese con el administrador.",
                                "continuar"=>1,
                                "datos"=>$EmpresasCompradas);
                }else if($pagoEmpresa[0]["estadoPago"] == 6 || $pagoEmpresa[0]["estadoPago"] == 104 || $pagoEmpresa[0]["estadoPago"] == 999){
                    $respuesta = array("mensaje"=>"pago rechazado.",
                                "continuar"=>0,
                                "datos"=>"");
                }
                return $respuesta;
            }
    }
    //consultaciudades empresa
    public function consultaCiudadesEm($departamento)
    {
        $where['ID_DPTO']    = $departamento;
        $where['ID_PAIS']    = '057';
        $ciudades          = $this->ci->dbGeneral->getCiudades($where);
        return $ciudades;   
    }
    //consulto departamentos
    public function consultaDepartamentos()
    {
        $where['ID_PAIS']    = '057';
        $ciudades          = $this->ci->dbGeneral->getDepartamentos($where);
        return $ciudades;   
    }
    //agrego pago de mensualidad empresa
    public function pagoMensualidadEmpresa($data){
        $dataInserta['idEmpresa']       = $data["dataEmpresa"];
        $dataInserta['idPersona']       = $_SESSION['project']['info']['idPersona'];
        $dataInserta['proveedor']       = $data["proveedor"];
        $dataInserta['ip']              = getIP();
        $dataInserta['estadoPago']      = 0;
        $dataInserta['codigoPago']      = substr(md5(uniqid()), 0, 16);
        $dataInserta['fechaPago']       = date('Y-m-d H:m:s');
        $resultado = $this->ci->dbGeneral->pagoMensualidadEmpresa($dataInserta);
        $respuesta = array("mensaje"=>"data insert",
                            "continuar"=>1,
                            "datos"=>$resultado);   
        return $respuesta;
    }
    //consulto pago mensualidad empresa a realizar
    public function pagoEmpresaMesC($dato){
        $where["idPagoMesEmpresas"] = $dato;
        $resultado         = $this->ci->dbGeneral->pagoEmpresaMesC($where); 
        return $resultado;
    }
    //registro pago empresa mensual
    public function pagoMempersa($datos){
        //var_dump($datos);die();
        $where['codigoPago']              = $datos["codigoPago"];
        $dataActualiza['email']           = $datos['email'];
        $dataActualiza['estadoPago']      = $datos['estadoPago'];
        $dataActualiza['formaPago']       = $datos['formaPago'];
        $dataActualiza['transactionid']   = $datos['transactionid'];
        $dataActualiza['referencia_pol']  = $datos['referencia_pol'];
        $dataActualiza['valor']           = $datos['valor'];
        $dataActualiza['moneda']          = $datos['moneda'];
        $dataActualiza['entidad']         = $datos['entidad'];
        $dataActualiza['fechaPago']       = date("Y-m-d H:i:s");
        $dataActualiza['ip']              = getIP();
        $pagoEmpresa                      = $this->ci->dbGeneral->pagoMempresa($dataActualiza,$where);
        if($pagoEmpresa > 0){
            $where['codigoPago'] = $datos["codigoPago"];
            $verificoPago = $this->ci->dbGeneral->pagoEmpresaMesC($where);
            if($verificoPago[0]["estadoPago"] == 4 || $verificoPago[0]["estadoPago"] == 998){
                $donde['idEmpresa']                 = $verificoPago[0]["idEmpresa"];
                $dataActualizar['fechaInicioPlan']   = date("Y-m-d H:i:s");
                $hoy                                = date('Y-m-d');
                $mes                                = date('Y-m-d', strtotime('+1 month', strtotime($hoy)));
                $dataActualizar['fechaCaducidad']    = $mes;
                $actualizoEmpresa = $this->ci->dbGeneral->actualizoEmpresa($dataActualizar,$donde);
                if($actualizoEmpresa > 0){
                    $respuesta = array("mensaje"=>"se agregaron datos de la empresa.",
                            "continuar"=>1,
                            "datos"=>$actualizoEmpresa);
                }
                $respuesta = array("mensaje"=>"Por favor comuniquese con el administrador.",
                            "continuar"=>0,
                            "datos"=>$actualizoEmpresa);
            }
            if($verificoPago[0]["estadoPago"] == 6 || $verificoPago[0]["estadoPago"] == 104 || $verificoPago[0]["estadoPago"] == 999){
                $respuesta = array("mensaje"=>"pago rechazado.",
                            "continuar"=>0,
                            "datos"=>"");
            }
            return $respuesta;
        }
    }
    //agrego pago de mensualidad oficial de cumplimiento
    public function pagoMensualidadOficial($data){
        $idPersona = $_SESSION['project']['info']['idPersona'];
        $consultoMembresia                  = $this->ci->dbGeneral->consultoMembresia($idPersona);
        if(count($consultoMembresia) > 0){
            $dataAc['paquete']           = "Mensual";
            $dataAc['estadoFunciona']    = "Normal";
            $dataAc['fechaIngreso']      = date('Y-m-d H:m:s');
            $actualizoMembresia          = $this->ci->dbGeneral->actualizoMembresiaOficial($dataAc,$idPersona);
            // var_dump($actualizoMembresia);die();
        }else{
            $dataMembresia['idPersona']         = $_SESSION['project']['info']['idPersona'];
            $dataMembresia['paquete']           = "Mensual";
            $dataMembresia['estadoFunciona']    = "Normal";
            $dataMembresia['fechaIngreso']        = date('Y-m-d H:m:s');
            $insertoMembresia   = $this->ci->dbGeneral->infoMembresiaOficial($dataMembresia);
        }
        $dataInserta['idPersona']       = $_SESSION['project']['info']['idPersona'];
        $dataInserta['email']           = $_SESSION['project']['info']['email'];
        $dataInserta['proveedor']       = $data["proveedor"];
        $dataInserta['ip']              = getIP();
        $dataInserta['estadoPago']      = 0;
        $dataInserta['codigoPago']      = substr(md5(uniqid()), 0, 16);
        $dataInserta['fechaPago']       = date('Y-m-d H:m:s');
        $resultado = $this->ci->dbGeneral->pagoMensualidadOficial($dataInserta);
        $respuesta = array("mensaje"=>"data insert",
                            "continuar"=>1,
                            "datos"=>$resultado);   
        return $respuesta;
    }
    //consulto los datos de pago que el oficial va a realizar
    public function infoPagoMesOficial($dato){
        $where["idPagoMesOficial"]= $dato;
        $resultado          = $this->ci->dbGeneral->infoPagoMesOficial($where);
        return $resultado;
    }
    //repuesta pago oficial de cumplimiento
    public function pagoMoficial($datos){
        $where['codigoPago']              = $datos["codigoPago"];
        $dataActualiza['email']           = $datos['email'];
        $dataActualiza['estadoPago']      = $datos['estadoPago'];
        $dataActualiza['formaPago']       = $datos['formaPago'];
        $dataActualiza['transactionid']   = $datos['transactionid'];
        $dataActualiza['referencia_pol']  = $datos['referencia_pol'];
        $dataActualiza['valor']           = $datos['valor'];
        $dataActualiza['moneda']          = $datos['moneda'];
        $dataActualiza['entidad']         = $datos['entidad'];
        $dataActualiza['fechaPago']       = date("Y-m-d H:i:s");
        $dataActualiza['ip']              = getIP();
        $pagoOficial                      = $this->ci->dbGeneral->pagoMoficial($dataActualiza,$where);
        if($pagoOficial > 0){
            $where['codigoPago'] = $datos["codigoPago"];
            $verificoPago = $this->ci->dbGeneral->infoPagoMesOficial($where);
            if($verificoPago[0]["estadoPago"] == 4 || $verificoPago[0]["estadoPago"] == 998){
                $donde['idPersona']                 = $verificoPago[0]["idPersona"];
                $dataActualizar['fechaInicioMes']   = date("Y-m-d H:i:s");
                $hoy                                = date('Y-m-d');
                $mes                                = date('Y-m-d', strtotime('+1 month', strtotime($hoy)));
                $dataActualizar['fechaCaducidad']   = $mes;
                $dataActualizar['codigoPago']       = $datos["codigoPago"];
                $actualizoEmpresa = $this->ci->dbGeneral->actualizoMembresiaOficial($dataActualizar,$donde);
                if($actualizoEmpresa > 0){
                    $respuesta = array("mensaje"=>"se agregaron datos de la empresa.",
                            "continuar"=>1,
                            "datos"=>$actualizoEmpresa);
                }
                $respuesta = array("mensaje"=>"Por favor comuniquese con el administrador.",
                            "continuar"=>0,
                            "datos"=>$actualizoEmpresa);
            }
            if($verificoPago[0]["estadoPago"] == 6 || $verificoPago[0]["estadoPago"] == 104 || $verificoPago[0]["estadoPago"] == 999){
                $respuesta = array("mensaje"=>"pago rechazado.",
                            "continuar"=>0,
                            "datos"=>"");
            }
            return $respuesta;
        }
    }
    //consulta relacion de empresa y plan obtenido
    public function relPlan($idEmpresa){
        $where["idEmpresa"]= $idEmpresa;
        $resultado          = $this->ci->dbGeneral->relPlan($where);
        if(count($resultado) > 0){
                $respuesta = array("mensaje"=>"se realizo consulta.",
                        "continuar"=>1,
                        "datos"=>$resultado);
        }else{
            $respuesta = array("mensaje"=>"No hay datos.",
                        "continuar"=>0,
                        "datos"=>"");
        }
        return $respuesta;
    }
    //pago empresa anual
    public function pagoAempersa($datos){
        //var_dump($datos);die();
        $where['codigoPago']              = $datos["codigoPago"];
        $dataActualiza['email']           = $datos['email'];
        $dataActualiza['estadoPago']      = $datos['estadoPago'];
        $dataActualiza['formaPago']       = $datos['formaPago'];
        $dataActualiza['transactionid']   = $datos['transactionid'];
        $dataActualiza['referencia_pol']  = $datos['referencia_pol'];
        $dataActualiza['valor']           = $datos['valor'];
        $dataActualiza['moneda']          = $datos['moneda'];
        $dataActualiza['entidad']         = $datos['entidad'];
        $dataActualiza['fechaPago']       = date("Y-m-d H:i:s");
        $dataActualiza['ip']              = getIP();
        $pagoEmpresa                      = $this->ci->dbGeneral->pagoMempresa($dataActualiza,$where);
        if($pagoEmpresa > 0){
            $where['codigoPago'] = $datos["codigoPago"];
            $verificoPago = $this->ci->dbGeneral->pagoEmpresaMesC($where);
            if($verificoPago[0]["estadoPago"] == 4 || $verificoPago[0]["estadoPago"] == 998){
                $donde['idEmpresa']                 = $verificoPago[0]["idEmpresa"];
                $hoy                                = date('Y-m-d');
                $dataActualizar['fechaInicioPlan']  = $hoy;
                $mes                                = date('Y-m-d', strtotime('+1 year', strtotime($hoy)));
                $dataActualizar['fechaCaducidad']   = $mes;
                $actualizoEmpresa = $this->ci->dbGeneral->actualizoEmpresa($dataActualizar,$donde);
                if($actualizoEmpresa > 0){
                    $respuesta = array("mensaje"=>"se agregaron datos de la empresa.",
                            "continuar"=>1,
                            "datos"=>$actualizoEmpresa);
                }
                $respuesta = array("mensaje"=>"Por favor comuniquese con el administrador.",
                            "continuar"=>0,
                            "datos"=>$actualizoEmpresa);
            }
            if($verificoPago[0]["estadoPago"] == 6 || $verificoPago[0]["estadoPago"] == 104 || $verificoPago[0]["estadoPago"] == 999){
                $respuesta = array("mensaje"=>"pago rechazado.",
                            "continuar"=>0,
                            "datos"=>"");
            }
            return $respuesta;
        }
    }
    //consulta relacion de empresa y plan obtenido
    public function infoPlanesrel($datos){
        $where["idEmpresa"] = $datos;
        $resultado          = $this->ci->dbGeneral->relPlan($where);
        // var_dump($resultado);die();
        if(count($resultado) > 0){
                $respuesta = array("mensaje"=>"se realizo consulta.",
                        "continuar"=>1,
                        "datos"=>$resultado);
        }else{
            $respuesta = array("mensaje"=>"no hay resultado.",
                        "continuar"=>0,
                        "datos"=>$resultado);
        }
        return $respuesta;
    }
    //si relacion de empresa con plan no existe, la creo
    public function creoPlanesrel($idEmpresa,$usuariosPlan,$checksPlan,$plan){
        $dataInserta["idEmpresa"]   = $idEmpresa;
        $dataInserta["idPlan"]      = $plan;
        $dataInserta["canUsuarios"] = $usuariosPlan;
        $dataInserta["canChecks"]   = $checksPlan;
        $resultado          = $this->ci->dbGeneral->creoPlanesrel($dataInserta);
        // var_dump($resultado);die();
        if($resultado > 0){
                $respuesta = array("mensaje"=>"se realizo consulta.",
                        "continuar"=>1,
                        "datos"=>$resultado);
        }else{
            $respuesta = array("mensaje"=>"algo salio mal.",
                        "continuar"=>0,
                        "datos"=>"");
        }
        return $respuesta;
    }
    //actualizo la relacion de plan con empresa
    public function actualizoPlanesrel($idEmpresa,$usuariosPlan,$checksPlan,$plan){
        $where["idEmpresa"]   = $idEmpresa;
        $dataInserta["idPlan"]      = $plan;
        $dataInserta["canUsuarios"] = $usuariosPlan;
        $dataInserta["canChecks"]   = $checksPlan;
        $resultado          = $this->ci->dbGeneral->actualizoPlanesrel($dataInserta,$where);
        if($resultado > 0){
                $respuesta = array("mensaje"=>"se actualizo.",
                        "continuar"=>1,
                        "datos"=>$resultado);
        }else{
            $respuesta = array("mensaje"=>"algo salio mal.",
                        "continuar"=>0,
                        "datos"=>"");
        }
        return $respuesta;
    }
}