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
class LogicaMisMatrices  {
    private $ci;
    
    //modelos de base de datos a consultar
    public function __construct(){
        $this->ci = &get_instance();
        $this->ci->load->model("general/BaseDatosGral","dbGeneral");
        $this->ci->load->model("misMatrices/BaseDatosMisMatrices","dbmisMatriz");
        $this->ci->load->model("crearMatriz/BaseDatosMatriz","dbMatriz");
    } 
    //informacion del moodulo
    public function consultaMiMatriz($dato,$tipoEmpresa){
        $where["e.idEmpresa"]       = $dato;
        $where["m.eliminado"]       = 0;
        $where["m.estado"]          = 1;
        $where["e.tipoEmpresa"]     = $tipoEmpresa;
        $infoMatriz                 = $this->ci->dbmisMatriz->consultaMiMatriz($where);
        return $infoMatriz;
    }
    //consulta relaciones de matriz
    public function consultaRelacion($dato){
        $where["p.idEmpresa"]         = $dato;
        $where["p.eliminado"]         = 0;
        $where["p.estado"]            = 1;
        $infoMatriz                 = $this->ci->dbmisMatriz->consultaRelacion($where);
        return $infoMatriz;
    }
    //consulto matriz con el responsable
    public function consultaMatriz($dato,$tipoEmpresa){
        $where["r.idResponsable"]   = $dato;
        // $where["a.idTipoEmpresa"]   = $tipoEmpresa;
        $infoMatriz                 = $this->ci->dbmisMatriz->consultaMatriz($where);
        if(count($infoMatriz) > 0){
            $respuesta = array("mensaje"=>"las matrices fueron consultadas.",
                        "continuar"=>1,
                        "datos"=>$infoMatriz);
        }else{
            $respuesta = array("mensaje"=>"las matrices no fueron consultadas.",
                        "continuar"=>0,
                        "datos"=>"");
        }
        return $respuesta;
    }
    //consulta para matrices compradas general
    public function consultaMatricescompradas($idPersona,$idEmpresa){
        if($_SESSION["project"]["info"]["idPerfil"] != 8){
            $where["c.estado"]      = 1;
            $where["c.eliminado"]   = 0;
            $where["c.idPersona"]   = $idPersona;
            $where["c.idEmpresa"]   = $idEmpresa;
            $infoMatriz                 = $this->ci->dbmisMatriz->consultaMatricescompradas($where);
            if(count($infoMatriz) > 0){
                $respuesta = array("mensaje"=>"las matrices fueron consultadas.",
                            "continuar"=>1,
                            "datos"=>$infoMatriz);
            }else{
                $respuesta = array("mensaje"=>"las matrices no fueron consultadas.",
                            "continuar"=>0,
                            "datos"=>"");
            }
        }else if($_SESSION["project"]["info"]["idPerfil"] == 8){
            $where["c.estado"]      = 1;
            $where["c.eliminado"]   = 0;
            $where["c.idEmpresa"]   = $idEmpresa;
            $infoMatriz             = $this->ci->dbmisMatriz->consultaMatricescompradas($where);
            if(count($infoMatriz) > 0){
                $respuesta = array("mensaje"=>"las matrices fueron consultadas.",
                            "continuar"=>1,
                            "datos"=>$infoMatriz);
            }else{
                $respuesta = array("mensaje"=>"las matrices no fueron consultadas.",
                            "continuar"=>0,
                            "datos"=>"");
            }
        }
        return $respuesta;
    }
    //informacion de todas las matrices para poderlas comprar
    public function infoMatrices(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $where['idEmpresa']     = 0;
        $infoMatrices               = $this->ci->dbMatriz->infoNuevaMatriz($where);
        return $infoMatrices;
    }
    //crea relacion de las matrices gratis, apenas se registra la empresa.
    public function creaGratis($datos){
        extract($datos);
        $ids = $datos["id"];
        $array = explode(",", $ids);
        foreach($array as $id){
            $dataIns["idEmpresa"]   = $_SESSION["project"]["info"]["idEmpresa"];
            $dataIns["idPersona"]   = $_SESSION["project"]["info"]["idPersona"];
            $dataIns["idMatriz"]    = $id;
            $dataIns["pago"]        = "NO";
            $dataIns["fechaPago"]   = date("Y-m-d H:i:s");
            $crea           = $this->ci->dbmisMatriz->creaGratis($dataIns);
        }
        if($crea > 0){
            $respuesta = array("mensaje"=>"Las matrices se han agregado correctamente.",
                    "continuar"=>1,
                    "datos"=>"");
        }else{
            $respuesta = array("mensaje"=>"las matrices no fueron agregadas.",
                    "continuar"=>0,
                    "datos"=>"");
        }
        return $respuesta;
    }
    //consulta de mtrices por empresa
    public function getMatricesEmpresa($datos){
        extract($datos);
        $ids = $datos["id"];
        $array = explode(",", $ids);
        $resultados = array(); // Arreglo para almacenar los resultados
        
        foreach ($array as $id) {
            $where["idEmpresa"] = $_SESSION["project"]["info"]["idEmpresa"];
            $where["idMatriz"]  = $id;
            $where["eliminado"]  = 0;
            $infoMatrices = $this->ci->dbmisMatriz->getMatricesEmpresa($where);
            if (!empty($infoMatrices)) {
                $resultados[] = $infoMatrices;
            }
        }
        if (empty($resultados)) {
            $respuesta = array(
                "mensaje" => "No hay matrices relacionadas.",
                "continuar" => 0,
                "datos" => $resultados
            );
        } else {
            $respuesta = array(
                "mensaje" => "Hay matrices que ya se encuentran agregadas. Por favor verifique e intente nuevamente.",
                "continuar" => 1,
                "datos" => $resultados
            );
        }
        return $respuesta;
    }
    //busca matriz por nombre
    public function infoMatriceslike($datos){
        $where["nombreNuevaMatriz"] = $datos;
        $infoMatrices               = $this->ci->dbmisMatriz->infoMatriceslike($where);
        return $infoMatrices;
    }
    //informacion de todas las empresas
    public function infoEmpresas(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $infoEmpresas               = $this->ci->dbmisMatriz->infoEmpresas($where);
        return $infoEmpresas;
    }
    //consulta emrpesas compradas
    public function ConsultaEmpresasCompradas($idPersona){
        $where["c.idPersona"]   = $idPersona;
        $infoMatriz                 = $this->ci->dbmisMatriz->ConsultaEmpresasCompradas($where);
        if(count($infoMatriz) > 0){
            $respuesta = array("mensaje"=>"las matrices fueron consultadas.",
                        "continuar"=>1,
                        "datos"=>$infoMatriz);
        }else{
            $respuesta = array("mensaje"=>"las matrices no fueron consultadas.",
                        "continuar"=>0,
                        "datos"=>"");
        }
        return $respuesta;
    }
    //busca empresa por nombre
    public function infoEmpresasLike($datos){
        $where["nombre"] = $datos;
        $infoMatrices               = $this->ci->dbmisMatriz->infoEmpresasLike($where);
        return $infoMatrices;
    }
    //crea relacion de cumplimiento y empresa
    public function creaGratisrel($datos){
        extract($datos);
        $ids = $datos["id"];
        $array = explode(",", $ids);
        foreach($array as $id){
            $dataIns["idEmpresa"]   = $_SESSION["project"]["info"]["idEmpresa"];
            $dataIns["idPersona"]   = $_SESSION["project"]["info"]["idPersona"];
            $dataIns["idEmpresa"]   = $id;
            $dataIns["fecha"]       = date("Y-m-d H:i:s");
            $crea           = $this->ci->dbmisMatriz->creaGratisrel($dataIns);
        }
        if($crea > 0){
            $respuesta = array("mensaje"=>"Se han agregado correctamente.",
                    "continuar"=>1,
                    "datos"=>"");
        }else{
            $respuesta = array("mensaje"=>"las matrices no fueron agregadas.",
                    "continuar"=>0,
                    "datos"=>"");
        }
        return $respuesta;
    }
    //consulta que no exista relacion
    public function getrelEmpresa($datos){
        extract($datos);
        $ids = $datos["id"];
        $array = explode(",", $ids);
        $resultados = array(); // Arreglo para almacenar los resultados
        
        foreach ($array as $id) {
            $where["idPersona"] = $_SESSION["project"]["info"]["idPersona"];
            $where["idEmpresa"]  = $id;
            $where["eliminado"]  = 0;
            $where["estado"]    = 1;
            $infoMatrices = $this->ci->dbmisMatriz->getrelEmpresa($where);
            if (!empty($infoMatrices)) {
                $resultados[] = $infoMatrices;
            }
        }
        if (empty($resultados)) {
            $respuesta = array(
                "mensaje" => "No hay empresas relacionadas.",
                "continuar" => 0,
                "datos" => $resultados
            );
        } else {
            $respuesta = array(
                "mensaje" => "Hay empresas que ya se encuentran agregadas. Por favor verifique e intente nuevamente.",
                "continuar" => 1,
                "datos" => $resultados
            );
        }
        
        return $respuesta;
    }
    //informacion de matriz por id
    public function infoMatrize($idMatriz){
        $where['idNuevaMatriz'] = $idMatriz;
        $infoMatrices               = $this->ci->dbmisMatriz->infoMatrize($where);
        return $infoMatrices;
    }
    //consulto empresas por id
    public function infoEmpresa($idEmpresa){
        $where['idEmpresa'] = $idEmpresa;
        $infoEmpresa               = $this->ci->dbmisMatriz->infoEmpresa($where);
        return $infoEmpresa;
    }
    //elimina Matrices compradas
    public function eliminaMatrizComprada($datos){
        $dataActualiza["estado"]    = 0;
        $dataActualiza["eliminado"] = 1;
        $where['idMatriz']          = $datos["idMatriz"];
        $where['idEmpresa']         = $datos["idEmpresa"];
        $elimina               = $this->ci->dbmisMatriz->eliminaMatrizComprada($dataActualiza,$where);
        if($elimina > 0){
            $respuesta = array("mensaje"=>"La matriz, se elimino Correctamente.",
            "continuar"=>1,
            "datos"=>$elimina);
        }else{
            $respuesta = array("mensaje"=>"La Matriz no pudo ser eliminada.",
            "continuar"=>0,
            "datos"=>"");
        }
        return $respuesta;
    }
    public function relEmpresaPerfiles($datos){
        $where['idEmpresa']         = $datos["id"];
        $where['idPerfil']         = 8;
        $where['estado']         = 1;
        $consulta               = $this->ci->dbmisMatriz->relEmpresaPerfiles($where);
        if(count($consulta) > 0){
            $respuesta = array("mensaje"=>"La empresa ya cuenta con oficial de cumplimiento, por favor comuniquese con le empresa.",
            "continuar"=>1,
            "datos"=>$consulta);
        }else{
            $datas["idEmpresa"] = $datos["id"];
            $datas["estado"]    = 1;
            $datas["eliminado"] = 0;
            $verifica     = $this->ci->dbmisMatriz->relOficialEmpresa($datas);
            if(count($verifica) > 0){
                $respuesta = array("mensaje"=>"La empresa ya cuenta con oficial de cumplimiento independiente, por favor comuniquese con le empresa.",
                "continuar"=>1,
                "datos"=>$consulta);
            }else{
                $respuesta = array("mensaje"=>"La empresa no cuenta con oficial de cumplimiento.",
                "continuar"=>0,
                "datos"=>"");
            }
        }
        return $respuesta;
    }
    //informacion de empresas compradas por idPersona de oficial de cumplimiento
    public function infoEmpresasCompradas($idPersona){
        $where['idPersona'] = $idPersona;
        $where['estado']    = 1;
        $where['eliminado'] = 0;
        $consulta               = $this->ci->dbmisMatriz->relOficialEmpresa($where);
        return $consulta;
    }
    //inserta file en imagenes temporales
    public function insertaFotoTemp($data){
        $dataInserta["nombreArchivo"] = $data["foto"];
        $dataInserta["ruta"] = $data["rutaFoto"];
        $crea           = $this->ci->dbmisMatriz->insertaFotoTemp($dataInserta);
        return $crea;
    } 
    public function consultaRcomentario($idRecurrente,$idPersona,$idPeriocidad){
        $where['idMatrizRecurrente']    = $idRecurrente;
        $where['idPersona']             = $idPersona;
        $where['idRelPeriocidad']       = $idPeriocidad;
        $consulta               = $this->ci->dbmisMatriz->consultaRcomentario($where);
        if(count($consulta) > 0){
            $respuesta = array("mensaje"=>"se realizo la consulta.",
            "continuar"=>1,
            "datos"=>$consulta);
        }else{
            $respuesta = array("mensaje"=>"no se ejecuto la consulta.",
            "continuar"=>0,
            "datos"=>"");
        }
    return $respuesta;
    } 
    //consulta de respuestas de check realizados 
    public function consultacheck($idRecurrente,$idPersona,$idRelPeriocidad){
        $where['idMatrizRecurrente']    = $idRecurrente;
        $where['idPersona']             = $idPersona;
        $where['idEmpresa']             = $_SESSION["project"]["info"]["idEmpresa"];
        $where['idRelPeriocidad']       = $idRelPeriocidad;
        $consulta               = $this->ci->dbmisMatriz->consultacheck($where);
        $valorArray = array();
        foreach($consulta as $item){
            $valorArray[] = $item["valor"];
        }
        $arrayArchivos =array();
        foreach($consulta as $archiivo){
            $arrayArchivos[] = $archiivo["nombreArchivo"];
        }
        if(count($consulta) > 0){
            $respuesta = array(
                "respuesta" => $valorArray,
                "arrayArchivos" => $arrayArchivos,
                "idEmpresa" => $_SESSION["project"]["info"]["idEmpresa"]
            );
        }else{
            $respuesta = array("mensaje"=>"no se ejecuto la consulta.",
            "continuar"=>0,
            "datos"=>"");
        }
    return $respuesta;
    } 
    //actualiza check
    public function actualizaCheck($data){
        extract($data);
        $where['idMatrizRecurrente']    = $data["idMatrizRecurrente"];
        $where['idPersona']             = $data["idPersona"];
        $where['idEmpresa']             = $data["idEmpresa"];
        $where['idRelPeriocidad']       = $data["idRelPeriocidad"];

        if($_SESSION['project']['info']["idPerfil"] == 8){
            $resOficial        = $data["resOficial"];
            $resOficialArray   = explode(",", $resOficial);
            $pregunta = 1;
            foreach ($resOficialArray as $valores) {
                $dataActualiza["resOficial"] = $valores;
                $where['idRespuesta'] = $pregunta;
                $guardado = $this->ci->dbmisMatriz->actualizaCheck($where,$dataActualiza);
                $pregunta++;
            }
                $respuesta = array("mensaje"=>"El formulario se ha actualizado exitosamente.",
                                    "continuar"=>1,
                                    "datos"=>"");
            return $respuesta;
        } else {
            $archivo        = $data["archivos"];
            $archivoArray   = explode(",", $archivo);
    
            $res                = $data["respuestas"];
            $array              = explode(",", $res);
            if (!empty($array) && !empty($archivoArray)) {
                $pregunta = 1;
                foreach ($array as $valores) {
                    $dataActualiza["valor"] = $valores;
                    $dataActualiza["nombreArchivo"] = "";
                    if ($dataActualiza["valor"] == "SI" && isset($archivoArray[$pregunta - 1])){
                        $dataActualiza["nombreArchivo"] = $archivoArray[$pregunta - 1];
                    }
                    $where['idRespuesta'] = $pregunta;
                    $guardado = $this->ci->dbmisMatriz->actualizaCheck($where,$dataActualiza);
                    $pregunta++;
                }
                $respuesta = array("mensaje"=>"El formulario se ha actualizado exitosamente.",
                        "continuar"=>1,
                        "datos"=>"");
            }
            return $respuesta;
        }
    }
    //consulta de check para oficial de cumplimiento
    public function consultacheckRealizado($idRecurrente,$idPersona,$idEmpresa,$idRelPeriocidad){
        $where['idMatrizRecurrente']    = $idRecurrente;
        $where['idPersona']             = $idPersona;
        $where['idEmpresa']             = $idEmpresa;
        $where['idRelPeriocidad']       = $idRelPeriocidad;
        $consulta               = $this->ci->dbmisMatriz->consultacheckRealizado($where);
        // var_dump($consulta);die();
        $valorArray = array();
        foreach($consulta as $item){
            $valorArray[] = $item["valor"];
        }
        $arrayArchivos =array();
        foreach($consulta as $archiivo){
            $arrayArchivos[] = $archiivo["nombreArchivo"];
        }
        $arrayResOficial = array();
        foreach($consulta as $resOficial){
            $arrayResOficial[] = $resOficial["resOficial"];
        }
        if(count($consulta) > 0){
            $respuesta = array(
                "respuesta" => $valorArray,
                "arrayArchivos" => $arrayArchivos,
                "arrayResOficial" => $arrayResOficial,
                "idEmpresa" => $_SESSION["project"]["info"]["idEmpresa"]
            );
        }else{
            $respuesta = array("mensaje"=>"no se ejecuto la consulta.",
            "continuar"=>0,
            "datos"=>"");
        }
    return $respuesta;
    }
    //consulto periocidades
    public function periocidades($idPersona,$idEmpresa){
        $where['r.idPersona']    = $idPersona;
        $where['r.idEmpresa']    = $idEmpresa;
        $where['r.estado']       = 1;
        $where['r.eliminado']    = 0;
        $consulta              = $this->ci->dbmisMatriz->periocidades($where);
        if(count($consulta) > 0){
            $respuesta = array("mensaje"=>"se realizo la consulta.",
            "continuar"=>1,
            "datos"=>$consulta);
        }else{
            $respuesta = array("mensaje"=>"no se ejecuto la consulta.",
            "continuar"=>0,
            "datos"=>"");
        }
    return $respuesta;
    }
    //crear periocidad
    public function crearRelPeriocidad($data){
        if($data["edita"] == 1){
            $dataActualiza["idPeriodicidad"]    = $data["idPeriodicidad"];
            $dataActualiza["nombreRel"]         = $data["nombreRel"];
            $where['idRelPeriocidad']           = $data["idRelPeriocidad"];
            $actualiza                            = $this->ci->dbmisMatriz->updatePeriocidad($dataActualiza,$where);
            if($actualiza > 0){
                $respuesta = array("mensaje"=>"Se Actualizo correctamente.",
                "continuar"=>1,
                "datos"=>$actualiza);
            }else{
                $respuesta = array("mensaje"=>"No pudo ser Actualizado, por favor comuniquese con el administrador.",
                "continuar"=>0,
                "datos"=>"");
            }
            return $respuesta;
        }if($data["edita"] == 0){
            $dataInserta["idPeriodicidad"]  = $data["idPeriodicidad"];
            $dataInserta["nombreRel"]       = $data["nombreRel"];
            $dataInserta["idEmpresa"]       = $_SESSION["project"]["info"]["idEmpresa"];
            $dataInserta["idPersona"]       = $_SESSION["project"]["info"]["idPersona"];
            $dataInserta["fecha"]           = date("Y-m-d H:i:s");
            $crea           = $this->ci->dbmisMatriz->crearRelPeriocidad($dataInserta);
            if($crea > 0){
                $respuesta = array("mensaje"=>"Se ha creado correctamente.",
                "continuar"=>1,
                "datos"=>$crea);
            }else{
                $respuesta = array("mensaje"=>"No se ha creado",
                "continuar"=>0,
                "datos"=>"");
            }
            return $respuesta;
        }
    }
    //eliminar periodicidad
    public function borraPeriocidad($datos){
        $dataActualiza["estado"]    = 0;
        $dataActualiza["eliminado"] = 1;
        $where['idRelPeriocidad']   = $datos["idRelPeriocidad"];
        $where['idPersona']         = $_SESSION["project"]["info"]["idPersona"];
        $where['idEmpresa']         = $_SESSION["project"]["info"]["idEmpresa"];
        $elimina               = $this->ci->dbmisMatriz->updatePeriocidad($dataActualiza,$where);
        if($elimina > 0){
            $respuesta = array("mensaje"=>"Se elimino coorectamente.",
            "continuar"=>1,
            "datos"=>$elimina);
        }else{
            $respuesta = array("mensaje"=>"No pudo ser eliminada.",
            "continuar"=>0,
            "datos"=>"");
        }
        return $respuesta;
    }
    //consulto periocidad de la empresa
    public function infoPeriocidades($idEmpresa){
        $where['r.idEmpresa']    = $idEmpresa;
        $where['r.estado']       = 1;
        $where['r.eliminado']    = 0;
        $consulta              = $this->ci->dbmisMatriz->periocidades($where);
        // var_dump($consulta);die();
        if(count($consulta) > 0){
            $respuesta = array("mensaje"=>"se realizo la consulta.",
            "continuar"=>1,
            "datos"=>$consulta);
        }else{
            $respuesta = array("mensaje"=>"no se ejecuto la consulta.",
            "continuar"=>0,
            "datos"=>"");
        }
    return $respuesta;
    }
    //datos para editar
    public function infoPeriodicidad($idRelPeriocidad){
        $where['idRelPeriocidad'] = $idRelPeriocidad;
        $consulta                   = $this->ci->dbmisMatriz->infoPeriodicidad($where);
        return $consulta;
    }
    // borra matriz creada por la empresa
    public function borraMatrizCreada($datos){
        // var_dump($datos);die();
        $dataActualiza["estado"]    = 0;
        $dataActualiza["eliminado"] = 1;
        $where['idNuevaMatriz']      = $datos["idNuevaMatriz"];
        $where['idEmpresa']         = $_SESSION["project"]["info"]["idEmpresa"];
        $elimina               = $this->ci->dbmisMatriz->actualizoTablaMatriz($dataActualiza,$where);
        if($elimina > 0){
            $respuesta = array("mensaje"=>"Se elimino coorectamente.",
            "continuar"=>1,
            "datos"=>$elimina);
        }else{
            $respuesta = array("mensaje"=>"No pudo ser eliminada.",
            "continuar"=>0,
            "datos"=>"");
        }
        return $respuesta;
    }
    //consulto matriz, para actualizar
    public function consultoMiMatrizId($idNuevaMatriz){
        $where['idNuevaMatriz']        = $idNuevaMatriz;
        $infoMatrices               = $this->ci->dbmisMatriz->infoNuevaMatriz($where);
        return $infoMatrices;
    }
    public function actualizoMiCheck($datos){
        // var_dump($datos);die();
        $dataActualiza["nombreNuevaMatriz"] = $datos["nombreNuevaMatriz"];
        $dataActualiza["descripcion"]       = $datos["descripcion"];
        $where['idNuevaMatriz']             = $datos["idNuevaMatriz"];
        $where['idEmpresa']                 = $_SESSION["project"]["info"]["idEmpresa"];
        $actualizar                         = $this->ci->dbmisMatriz->actualizoTablaMatriz($dataActualiza,$where);
        if($actualizar > 0){
            $respuesta = array("mensaje"=>"Se actualizo coorectamente.",
            "continuar"=>1,
            "datos"=>$actualizar);
        }else{
            $respuesta = array("mensaje"=>"No pudo actualizo.",
            "continuar"=>0,
            "datos"=>"");
        }
        return $respuesta;
    }
    //Duplico check y agrego a la a mis creados
    public function duplicarMatrizCreada($datos){
        $where['idNuevaMatriz'] = $datos["idNuevaMatriz"];
        $infoMatrices           = $this->ci->dbmisMatriz->infoMatrize($where);
        $infoRecurrentes        = $this->ci->dbGeneral->consultoRecurrentes($where);
        $dataRecurrente = $infoRecurrentes[0];
        $newDataRecurrente = [];
        foreach($infoRecurrentes as $sdata){
            unset($sdata["idMatrizRecurrente"]);
            unset($sdata["idNuevaMatriz"]);
            $newDataRecurrente[] = $sdata;
        }
        //procedo a crear nueva infoMatrize 
        $datosNewMatriz["nombreNuevaMatriz"] = $infoMatrices[0]["nombreNuevaMatriz"]." Duplicado";
        $datosNewMatriz["descripcion"]       = $infoMatrices[0]["descripcion"];
        $datosNewMatriz["precio"]            = $infoMatrices[0]["precio"];
        $datosNewMatriz["idEmpresa"]         = $_SESSION["project"]["info"]["idEmpresa"];
        $datosNewMatriz["tipoEmpresa"]       = 0;
        $datosNewMatriz["dirigida"]          = 0;
        $creaMatriz = $this->ci->dbMatriz->creaNuevaMatriz($datosNewMatriz);
        if($creaMatriz > 0){
            $totalCount = count($newDataRecurrente);
            $processedCount = 0;
            foreach ($newDataRecurrente as $new) {
                $dataCrea["idNuevaMatriz"] = $creaMatriz;
                $dataCrea["obligacion"] = $new["obligacion"];
                $dataCrea["idEntidad"] = $new["idEntidad"];
                $dataCrea["normatividad"] = $new["normatividad"];
                $dataCrea["idcuandoAplique"] = $new["idcuandoAplique"];
                $dataCrea["idResponsable"] = $new["idResponsable"];
                $dataCrea["idccsm"] = $new["idccsm"];
                $dataCrea["idMetodoControl"] = $new["idMetodoControl"];
                $dataCrea["idperiodicidad"] = $new["idperiodicidad"];
                $creoNewRecurrente = $this->ci->dbGeneral->crearNewRecurrente($dataCrea);
                $processedCount++;
            }
            if($processedCount === $totalCount){
                $respuesta = array("mensaje"=>"Se duplico coorectamente el check.",
                "continuar"=>1,
                "datos"=>"");
            }else{
                $respuesta = array("mensaje"=>"No se duplico en su totalidad.",
                "continuar"=>0,
                "datos"=>"");
            }
        }
        return $respuesta;
    }
    //consulta de matrices compradas
    public function consultaMatricecomprada($idEmpresa){
        if($_SESSION["project"]["info"]["idPerfil"] != 8){
            $where["c.estado"]      = 1;
            $where["c.eliminado"]   = 0;
            $where["c.idEmpresa"]   = $idEmpresa;
            $infoMatriz                 = $this->ci->dbmisMatriz->consultaMatricescompradas($where);
            if(count($infoMatriz) > 0){
                $respuesta = array("mensaje"=>"las matrices fueron consultadas.",
                            "continuar"=>1,
                            "datos"=>$infoMatriz);
            }else{
                $respuesta = array("mensaje"=>"las matrices no fueron consultadas.",
                            "continuar"=>0,
                            "datos"=>"");
            }
        }
        return $respuesta;
    }

}