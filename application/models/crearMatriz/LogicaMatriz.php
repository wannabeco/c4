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
class LogicaMatriz  {
    private $ci;
    
    //modelos de base de datos a consultar
    public function __construct(){
        $this->ci = &get_instance();
        $this->ci->load->model("general/BaseDatosGral","dbGeneral");
        $this->ci->load->model("crearMatriz/BaseDatosMatriz","dbMatriz");
    } 
    //informacion del moodulo
    public function infoModulo($idModulo){
        $infoModulo          = $this->ci->dbGeneral->infoModulo(array("idModulo"=>$idModulo));
        return $infoModulo;
    }
    //consulta procesos
    public function infoProceso(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $procesos               = $this->ci->dbMatriz->infoProcesos($where);
        return $procesos;
    }
    //consulta fuentes de riesgo
    public function infoFuenteRiesgo(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $fuentes               = $this->ci->dbMatriz->infoFuenteRiesgo($where);
        return $fuentes;
    }
    //consulta info Factor Especifico
    public function infoFactorEspecifico(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $factor               = $this->ci->dbMatriz->infoFactorEspecifico($where);
        return $factor;
    }
    //consulta info Descripcion de riesgo
    public function infoDescripcionR(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $descripciones               = $this->ci->dbMatriz->infoDescripcionR($where);
        return $descripciones;
    }
    //consulta info Causas
    public function infoCausas(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $causas               = $this->ci->dbMatriz->infoCausas($where);
        return $causas;
    }
    //consulta info Tipo Riesgo
    public function infoTipoRiesgo(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $tipoRiesgo               = $this->ci->dbMatriz->infoTipoRiesgo($where);
        return $tipoRiesgo;
    }
    //consulta info Riesgo Asociado
    public function infoRiesgoAsociado(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $riesgosAsociados               = $this->ci->dbMatriz->infoRiesgoAsociado($where);
        return $riesgosAsociados;
    }
    //consulta info Consecuencias
    public function infoConsecuencias(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $consecuencias               = $this->ci->dbMatriz->infoConsecuencias($where);
        return $consecuencias;
    }
    public function infoTipoEmpresa(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $tipoEmpresa               = $this->ci->dbMatriz->infoTipoEmpresa($where);
        return $tipoEmpresa;
    }
    public function entidades(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $entidades              = $this->ci->dbMatriz->entidades($where);
        return $entidades;
    }
    public function frecuenciaejecucion(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $frecuencia             = $this->ci->dbMatriz->frecuenciaejecucion($where);
        return $frecuencia;
    }
    public function estados(){
        $where['eliminado']     = 0;
        $frecuencia             = $this->ci->dbMatriz->estados($where);
        return $frecuencia;
    }
    public function infoMatriz($id){
        $where['idNuevaMatriz'] = $id;
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $cuadnoAplique          = $this->ci->dbMatriz->infoMatriz($where);
        return $cuadnoAplique;
    }
    public function infoNuevaMatriz($id){
        $where['idNuevaMatriz'] = $id;
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $cuadnoAplique          = $this->ci->dbMatriz->infoNuevaMatriz($where);
        return $cuadnoAplique;
    }
    public function cuandoAplique(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $cuadnoAplique          = $this->ci->dbMatriz->cuandoAplique($where);
        return $cuadnoAplique;
    }
    public function responsable(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $responsable          = $this->ci->dbMatriz->responsable($where);
        return $responsable;
    }
    public function aplicaCcsm(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $aplicaCcsm          = $this->ci->dbMatriz->aplicaCcsm($where);
        return $aplicaCcsm;
    }
    public function metodoControl(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $metodoControl          = $this->ci->dbMatriz->metodoControl($where);
        return $metodoControl;
    }
    public function periodicidad(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $periodicidad          = $this->ci->dbMatriz->periodicidad($where);
        return $periodicidad;
    }
    public function dirigida(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $dirigida          = $this->ci->dbMatriz->dirigida($where);
        return $dirigida;
    }
    public function relacionEspecifica($data){
        $where['idMatriz']      = $data;
        $where['a.estado']      = 1;
        $where['a.eliminado']   = 0;
        $dirigida          = $this->ci->dbMatriz->relacionEspecifica($where);
        return $dirigida;
    }
    public function creaNuevaMatriz($data){
        extract($data);
        $ids = $data["idTipoEmpresa"];
        $array = explode(",", $ids);
        unset($data['idTipoEmpresa']);
        $creaMatriz = $this->ci->dbMatriz->creaNuevaMatriz($data);
        if($creaMatriz > 0){
            //se recorren las posiciones si $array esta lleno
            if($array != ""){
                
                foreach ($array as $idTipoEmpresa) {
                    $datacrea["idMatriz"]          = $creaMatriz;
                    $datacrea["idTipoEmpresa"]     = $idTipoEmpresa;
                    $this->ci->dbMatriz->guardarRelacionMatriz($datacrea);
                }
                $respuesta = array("mensaje"=>"La matriz se ha registrado exitosamente.",
                        "continuar"=>1,
                        "datos"=>"");
            }
                $respuesta = array("mensaje"=>"La matriz se ha registrado exitosamente.",
                            "continuar"=>1,
                            "datos"=>"");
        }else{
            $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, La matriz no se ha registradao, por favor intentelo de nuevo más tarde.",
                        "continuar"=>0,
                        "datos"=>"");
        }
        return $respuesta;
    }
    //consulta info de todas las matrices creadas
    public function infoMatrices(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $infoMatrices               = $this->ci->dbMatriz->infoMatrices($where);
        return $infoMatrices;
    }
    //informacion de matriz recurrente por id
    public function infoMatrizporID($datos){
        $where["r.idMatrizRecurrente"] = $datos;
        $where['r.eliminado']     = 0;
        $infoMatrices               = $this->ci->dbMatriz->infoMatrizporID($where);
        return $infoMatrices;
    }
    //informacion de matriz recurrente por id
    public function informacionMatriz($datos){
        $where["n.idNuevaMatriz"] = $datos;
        $where['n.eliminado']     = 0;
        $informacionMatriz               = $this->ci->dbMatriz->informacionMatriz($where);
        return $informacionMatriz;
    }
    //informacion de matriz recurrente por id
    public function informacionMatrizDos($datos){
        $where = $datos;
        $informacionMatriz               = $this->ci->dbMatriz->informacionMatrizDos($where);
        return $informacionMatriz;
    }
    
    //consulta las nuevas matrices creadas 
    public function infoGeneralMatriz(){
        //$where['estado']        = 1;
        $where['eliminado']     = 0;
        $Matrices               = $this->ci->dbMatriz->infoGeneralMatriz($where);
        return $Matrices;
    }
    //elimina trices
    public function eliminaNuevaMatriz($id){
        $where                          = $id;
        $dataActualiza['estado']        = 0;
        $dataActualiza['eliminado']     = 1;
        $eliminaMatrices                = $this->ci->dbMatriz->eliminaNuevaMatriz($dataActualiza,$where);

        if($eliminaMatrices > 0){
            
            $respuesta = array("mensaje"=>"La matriz se ha eliminado correctamente.",
            "continuar"=>1,
            "datos"=>"");
        }else{
            
            $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, La matriz no se ha registradao, por favor intentelo de nuevo más tarde.",
            "continuar"=>0,
            "datos"=>"");
        }
        return $respuesta;
    }
    public function eliminaLaMatriz($id){
        $dataActualiza['estado']        = 0;
        $dataActualiza['eliminado']     = 1;
        $where                          = $id;
        $elimina                        = $this->ci->dbMatriz->eliminaLaMatriz($dataActualiza,$where);

        if($elimina > 0){
            
            $respuesta = array("mensaje"=>"La matriz se ha eliminado correctamente.",
            "continuar"=>1,
            "datos"=>"");
        }else{
            
            $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, La matriz no se ha registradao, por favor intentelo de nuevo más tarde.",
            "continuar"=>0,
            "datos"=>"");
        }
        return $respuesta;
    }
    //se crean los parametros de la matriz
    public function crearParametros($datos){
        unset($datos['edita']);
        $dataInserta = $datos;
        $actualiza   = $this->ci->dbMatriz->crearParametros($dataInserta);
        if($actualiza > 0){
            
            $respuesta = array("mensaje"=>"Los parametros se han creado correctamente.",
            "continuar"=>1,
            "datos"=>"");
        }else{
            
            $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, La matriz no se ha registradao, por favor intentelo de nuevo más tarde.",
            "continuar"=>0,
            "datos"=>"");
        }
        return $respuesta;
    }
    //se asigna tipo de emrpesa a matriz
    public function asigTiposEmpresa($datos){
        $dataInserta = $datos;
        $actualiza   = $this->ci->dbMatriz->guardarRelacionMatriz($dataInserta);
        if($actualiza > 0){
            
            $respuesta = array("mensaje"=>"El tipo de empresa se ha asignado correctamente.",
            "continuar"=>1,
            "datos"=>"");
        }else{
            
            $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, La matriz no se ha registradao, por favor intentelo de nuevo más tarde.",
            "continuar"=>0,
            "datos"=>"");
        }
        return $respuesta;
    }
    //actualiza Parametros de matriz
    public function actualizaParametros($datos){
        $dataActualiza['obligacion']        = $datos["obligacion"];
        $dataActualiza['idEntidad']         = $datos["idEntidad"];
        $dataActualiza['normatividad']      = $datos["normatividad"];
        $dataActualiza['frecuencia']        = $datos["frecuencia"];
        $dataActualiza['idcuandoAplique']   = $datos["idcuandoAplique"];
        $dataActualiza['idResponsable']     = $datos["idResponsable"];
        $dataActualiza['idccsm']            = $datos["idccsm"];
        $dataActualiza['idMetodoControl']   = $datos["idMetodoControl"];
        $dataActualiza['idperiodicidad']    = $datos["idperiodicidad"];
        $where["idMatrizRecurrente"]        = $datos["idNuevaMatriz"];
        $elimina                            = $this->ci->dbMatriz->actualizaParametros($dataActualiza,$where);

        if($elimina > 0){
            
            $respuesta = array("mensaje"=>"El parametro se ha actualizado correctamente.",
            "continuar"=>1,
            "datos"=>"");
        }else{
            
            $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, no se ha podido completar la eliminación, por favor intentelo de nuevo más tarde.",
            "continuar"=>0,
            "datos"=>"");
        }
        return $respuesta;
    }
    //selecciona las matrices creadas
    public function infoMatrizRecurrentes($id){
        $where['r.idNuevaMatriz'] = $id;
        $where['r.eliminado']     = 0;
        $respuesta          = $this->ci->dbMatriz->infoMatrizRecurrentes($where);
        return $respuesta;
    }
    public function infoMatrizRecurrentesDos($id,$idPerfil){
        $where['r.idNuevaMatriz'] = $id;
        $where['r.idResponsable'] = $idPerfil;
        $where['r.eliminado']     = 0;
        //$where['r.idPersona']     = $idPersona;
        $respuesta          = $this->ci->dbMatriz->infoMatrizRecurrentes($where);
        return $respuesta;
    }
    //elimina parametros de la matriz
    public function eliminaParametro($id){
        $dataActualiza['eliminado']     = 1;
        $where["idMatrizRecurrente"]    = $id[0];
        $elimina                        = $this->ci->dbMatriz->eliminaParametro($dataActualiza,$where);

        if($elimina > 0){
            
            $respuesta = array("mensaje"=>"Se ha eliminado correctamente.",
            "continuar"=>1,
            "datos"=>"");
        }else{
            
            $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, no se ha podido completar la eliminación, por favor intentelo de nuevo más tarde.",
            "continuar"=>0,
            "datos"=>"");
        }
        return $respuesta;
    }
    //actualiza matriz general
    public function actualizaMatrizGeneral($datos){
        $ids                                    = $datos["idse"];
        $array                                  = explode(",", $ids);
        unset($datos['idse']);
        $dataActualiza["nombreNuevaMatriz"]     = $datos["nombreNuevaMatriz"];
        $dataActualiza["dirigida"]              = $datos["dirigida"];
        $dataActualiza["estado"]                = $datos["estado"];
        $where["idNuevaMatriz"]                 = $datos["idNuevaMatriz"];
        if($ids != " "){
            foreach ($array as $idTipoEmpresa) {
                $datacrea["idMatriz"]          = $datos["idNuevaMatriz"];
                $datacrea["idTipoEmpresa"]     = $idTipoEmpresa;
                $agrega = $this->ci->dbMatriz->guardarRelacionMatriz($datacrea);
                if($agrega >0){
                    $respuesta = array("mensaje"=>"La matriz se ha actualizado correctamente.",
                                        "continuar"=>1,
                                        "datos"=>"");
                }
            }
        }else{
            $actualiza    = $this->ci->dbMatriz->actualizaMatrizGeneral($dataActualiza,$where);
            if($actualiza > 0){ 
                $respuesta = array("mensaje"=>"La matriz se ha actualizado correctamente.",
                "continuar"=>1,
                "datos"=>"");
            }else{
                $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, no se ha podido completar la eliminación, por favor intentelo de nuevo más tarde.",
                "continuar"=>0,
                "datos"=>"");
            }
        }
        return $respuesta;
    }
    public function infoUsuario($idPerfil){
        $where["idPersona"] = $idPerfil;
        $actualiza            = $this->ci->dbMatriz->infoUsuario($where);
        return $actualiza;
    }
    //elimina la matriz
    public function eliminaRelacion($post){
        $where["idAccionaciones"]    = $post[0];
        $elimina       = $this->ci->dbMatriz->eliminaRelacion($where);
        if($elimina > 0){
            $respuesta = array("mensaje"=>"La relacion se ha eliminado correctamente.",
            "continuar"=>1,
            "datos"=>"");
        }else{
            $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, no se ha podido completar la eliminación, por favor intentelo de nuevo más tarde.",
            "continuar"=>0,
            "datos"=>"");
        }
        return $respuesta;
    }
    //crea nuevo chekeo
    public function creaCheckeo($data){
        $archivo = "";
        extract($data);
        if( $data["archivos"] != ""){
            $archivo        = $data["archivos"];
            $archivoArray   = explode(",", $archivo);
        }
        $idPersona          = $data["idPersona"];
        $idEmpresa          = $data["idEmpresa"];
        $matriz             = $data["idNuevaMatriz"];
        $recurrente         = $data["idMatrizRecurrente"];
        $res                = $data["respuestas"];
        $idRelPeriocidad    = $data["idRelPeriocidad"];
        $array              = explode(",", $res);
        $datacreaComentario["idNuevaMatriz"]          = $matriz;
        $datacreaComentario["idPersona"]              = $idPersona;
        $datacreaComentario["idPerfil"]               = $_SESSION['project']['info']['idPerfil'];
        $datacreaComentario["idMatrizRecurrente"]     = $recurrente;
        $datacreaComentario["comentario"]             = $data["comentario"];
        $datacreaComentario["idEmpresa"]              = $idEmpresa;
        $datacreaComentario["idRelPeriocidad"]        = $idRelPeriocidad;
        $datacreaComentario["fechaRespuesta"]         = date("Y-m-d H:i:s");
        $this->ci->dbMatriz->creaComentario($datacreaComentario);
        if (!empty($array) && !empty($archivoArray)){
            $pregunta = 1;
            foreach ($array as $valores) {
                $datacrea["valor"] = $valores;
                $datacrea["nombreArchivo"] = "";
                if ($datacrea["valor"] == "SI" && isset($archivoArray[$pregunta - 1])){
                    $datacrea["nombreArchivo"] = $archivoArray[$pregunta - 1];
                }
                $datacrea["idPersona"]              = $idPersona;
                $datacrea["idPerfil"]               = $_SESSION['project']['info']['idPerfil'];
                $datacrea["idEmpresa"]              = $idEmpresa;
                $datacrea["idNuevaMatriz"]          = $matriz;
                $datacrea["idMatrizRecurrente"]     = $recurrente;
                $datacrea["idRespuesta"]            = $pregunta;
                $datacrea["idRelPeriocidad"]        = $idRelPeriocidad;
                
                $guardado = $this->ci->dbMatriz->creaCheckeo($datacrea);
                $pregunta++;
            }
            $respuesta = array("mensaje"=>"El formulario se ha regsitrado exitosamente.",
                    "continuar"=>1,
                    "datos"=>"");
        }
        return $respuesta;
    }
    //informacion de comentarios
    public function infoComentarios($id,$idPersona,$periocidad){
        $where["idPersona"]          = $idPersona;
        $where["idNuevaMatriz"] = $id;
        $where["idRelPeriocidad"]   = $periocidad;
        $informacion            = $this->ci->dbMatriz->infoComentarios($where);
        // var_dump($informacion);die();
        if($informacion > 0){
            $respuesta = array("mensaje"=>"los comentarios se han consultado correctamente.",
                            "continuar"=>1,
                            "datos"=>$informacion);
        }else{
            $respuesta = array("mensaje"=>"los comentarios no se han consultado correctamente.",
                        "continuar"=>0,
                        "datos"=>"");
        }
        return $respuesta;
    }
    //informacion de respuestas chekeador
    public function informacionCheck($idPersona,$nuevaMatriz,$idEmpresa,$periocidad){
        if($_SESSION['project']['info']['idPerfil'] != 8){
            $where["idPerfil"]          = $idPersona;
            $where["idMatrizRecurrente"] = $nuevaMatriz;
            $where["idEmpresa"] = $idEmpresa;
            $where["idRelPeriocidad"] = $periocidad;
            $informacion            = $this->ci->dbMatriz->informacionCheck($where);
            $idNuevaMatriz = "";
            if(isset($informacion[0]["idNuevaMatriz"])){
                $idNuevaMatriz = $informacion[0]['idNuevaMatriz'];
            }
            $id1 = intval(trim($nuevaMatriz));
            $id2 = intval(trim($idNuevaMatriz));
    
            if($id1 == $id2){
                $respuesta = array("mensaje"=>"los comentarios se han consultado correctamente.",
                            "continuar"=>1,
                            "datos"=>$informacion);
            }
            else{
                $respuesta = array("mensaje"=>"los comentarios no se han consultado correctamente.",
                            "continuar"=>0,
                            "datos"=>"");
            }
        }if($_SESSION['project']['info']['idPerfil'] == 8){
            $where["idPerfil"]          = $idPersona;
            $where["idNuevaMatriz"] = $nuevaMatriz;
            $where["idEmpresa"] = $idEmpresa;
            $where["idRelPeriocidad"] = $periocidad;
            $informacion            = $this->ci->dbMatriz->informacionCheck($where);
            $idNuevaMatriz = "";
            if(isset($informacion[0]["idNuevaMatriz"])){
                $idNuevaMatriz = $informacion[0]['idNuevaMatriz'];
            }
            $id1 = intval(trim($nuevaMatriz));
            $id2 = intval(trim($idNuevaMatriz));
    
            if($id1 == $id2){
                $respuesta = array("mensaje"=>"los comentarios se han consultado correctamente.",
                            "continuar"=>1,
                            "datos"=>$informacion);
            }
            else{
                $respuesta = array("mensaje"=>"los comentarios no se han consultado correctamente.",
                            "continuar"=>0,
                            "datos"=>"");
            }
        }
        return $respuesta;
    }
    public function informacionCheckDos($idrecurrente,$idPrefil,$idEmpresa){
        $where["idPerfil"]          = $idPrefil;
        $where["idMatrizRecurrente"] = $idrecurrente;
        $where["idEmpresa"] = $idEmpresa;
        $informacion            = $this->ci->dbMatriz->informacionCheckDos($where);
        return $informacion;
    }
    //informacion de persona por id
    public function infoPersona($idPersona){
        $where["idPersona"] = $idPersona;
        $actualiza            = $this->ci->dbMatriz->infoUsuario($where);
        return $actualiza;
    }
    //informacion solo de matriz recurrente
    public function infoRecurrente($idrecurrente){
        $where["idMatrizRecurrente"] = $idrecurrente;
        $informacion            = $this->ci->dbMatriz->infoMatriz($where);
        return $informacion;
    }
    //se obtienen las respuestas
    public function consultoSi($periocidad,$idPerfil,$acumuloRecurrentes){
        
        $respuestas = [];
        $porcentajes = []; 
        foreach($acumuloRecurrentes as $recurrente){
            $where["idRelPeriocidad"]   = $periocidad;
            $where["idPerfil"]          = $idPerfil;
            $where["idMatrizRecurrente"] = $recurrente;
            $informacion            = $this->ci->dbMatriz->informacionCheck($where);
            $respuestas[$recurrente] = $informacion;
        }
        foreach ($respuestas as $recurrente => $respuesta) {
            $contadorSi = 0;
            $contadorTotal = 0;
    
            foreach ($respuesta as $item) {
                if ($item["resOficial"] == "SI") {
                    $contadorSi++;
                }
                $contadorTotal++; 
            }
            if ($contadorTotal > 0) {
                $porcentajeSi = ($contadorSi / $contadorTotal) * 100;
            } else {
                $porcentajeSi = 0;
            }
            $porcentajes[$recurrente] = $porcentajeSi;
        }
        return $porcentajes;
    }
    
    public function consultoSiDos($periocidad,$idEmpresa,$acumuloRecurrentes){
        
        $respuestas = [];
        $porcentajes = []; 
        foreach($acumuloRecurrentes as $recurrente){
            $where["idRelPeriocidad"]   = $periocidad;
            $where["idEmpresa"]          = $idEmpresa;
            $where["idMatrizRecurrente"] = $recurrente;
            $informacion            = $this->ci->dbMatriz->informacionCheck($where);
            // array_push($respuestas,$informacion);
            $respuestas[$recurrente] = $informacion;
        }
        foreach ($respuestas as $recurrente => $respuesta) {
            $contadorSi = 0;
            $contadorTotal = 0;
    
            foreach ($respuesta as $item) {
                if ($item["resOficial"] == "SI") {
                    $contadorSi++;
                }
                $contadorTotal++; 
            }
            if ($contadorTotal > 0) {
                $porcentajeSi = ($contadorSi / $contadorTotal) * 100;
            } else {
                $porcentajeSi = 0;
            }
            $porcentajes[$recurrente] = $porcentajeSi;
        }
        // var_dump($porcentajes);die();
        return $porcentajes;
    }
}