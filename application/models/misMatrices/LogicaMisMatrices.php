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
        $where["a.idTipoEmpresa"]   = $tipoEmpresa;
        $infoMatriz                 = $this->ci->dbmisMatriz->consultaMatriz($where);
        return $infoMatriz;
    }
    public function consultaMatricescompradas($idPersona,$idEmpresa){
        $where["c.idPersona"]   = $idPersona;
        $where["c.idEmpresa"]   = $idEmpresa;
        $infoMatriz                 = $this->ci->dbmisMatriz->consultaMatricescompradas($where);
        if(count($infoMatriz) > 0){
            $respuesta = array("mensaje"=>"las matrices fueron consultadas.",
                        "continuar"=>1,
                        "datos"=>$infoMatriz);
        }
        else{
            $respuesta = array("mensaje"=>"las matrices no fueron consultadas.",
                        "continuar"=>0,
                        "datos"=>"");
        }
        return $respuesta;
    }
    //informacion de todas las matrices para poderlas comprar
    public function infoMatrices(){
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $infoMatrices               = $this->ci->dbMatriz->infoNuevaMatriz($where);
        return $infoMatrices;
    }
    //crea relacion de las matrices gratis, apenas se registra la empresa.
    public function creaGratis($datos){
        extract($datos);
        //var_dump($datos);die();
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
        }
        else{
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
        }
        else{
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
        //var_dump($datos);die();
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
        }
        else{
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

    
}