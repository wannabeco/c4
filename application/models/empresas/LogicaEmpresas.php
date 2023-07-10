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
class LogicaEmpresas  {
    private $ci;
    
    //modelos de base de datos a consultar
    public function __construct(){
        $this->ci = &get_instance();
        $this->ci->load->model("general/BaseDatosGral","dbGeneral");
        $this->ci->load->model("empresas/BaseDatosEmpresas","dbEmpresas");
    } 
    //informacion del moodulo
    public function infoModulo($idModulo){
        $infoModulo          = $this->ci->dbGeneral->infoModulo(array("idModulo"=>$idModulo));
        return $infoModulo;
    }
    //consulta empreas
    public function infoEmpresas(){
        $where['eliminado']     = 0;
        $empresas               = $this->ci->dbEmpresas->infoEmpresas($where);
        return $empresas;
    }
    //elimina empresas
    public function eliminaEmpresa($datos){
        $dataActualiza["eliminado"]     = 1;
        $where['idEmpresa']             = $datos["idEmpresa"];
        $empresas                       = $this->ci->dbEmpresas->eliminaEmpresa($dataActualiza, $where);
            if($empresas > 0){
                $respuesta = array("mensaje"=>"La empresa se ha eliminado exitosamente.",
                "continuar"=>1,
                "datos"=>"");
            }else{
                $respuesta = array("mensaje"=>"La empresa no se ha eliminado, por favor intentelo mas tarde.",
                "continuar"=>1,
                "datos"=>"");
            }
        return $respuesta;
    }
    //informacion de empresas individual
    public function infoEmpresa($dato){
        $where['idEmpresa']     = $dato;
        $empresas               = $this->ci->dbEmpresas->infoEmpresa($where);
        return $empresas;
    }
    //info paises
    public function infopaises(){
        $where['ID_PAIS']= '057';
        $paises=$this->ci->dbEmpresas->infopaises($where);
        return $paises;
    }
    //info departamentos
    public function infodepartamentos($idpais){
        $where['estado'] = 1;
        $where['ID_PAIS'] = $idpais;
        $departamentos=$this->ci->dbEmpresas->infodepartamentos($where);
        return $departamentos;
    }
    //info ciudades
    public function infociudades($idpais, $idDepartamentos){
        $where['estado'] = 1;
        $where['ID_PAIS'] = $idpais;
        $where['ID_DPTO'] = $idDepartamentos;
        $ciudades=$this->ci->dbEmpresas->infociudades($where);
        return $ciudades;
    }
    //informacion de empresa con oficial de cumplimiento
    public function misEmpresas(){
        $where['idPersona']     = $_SESSION['project']['info']['idPersona'];
        $where['c.estado']        = 1;
        $where['c.eliminado']     = 0;
        $empresas               = $this->ci->dbEmpresas->misEmpresas($where);
        return $empresas;
    }
     //elimina rel de emrpesa
     public function eliminaRel($datos){
        $where['idEmpresa']             = $datos["idEmpresa"];
        $empresas                       = $this->ci->dbEmpresas->eliminaRel($where);
            if($empresas > 0){
                $respuesta = array("mensaje"=>"La empresa se ha eliminado exitosamente.",
                "continuar"=>1,
                "datos"=>"");
            }else{
                $respuesta = array("mensaje"=>"La empresa no se ha eliminado, por favor intentelo mas tarde.",
                "continuar"=>0,
                "datos"=>"");
            }
        return $respuesta;
    }
    //crea relcion de oficial de cumplimiento y emrpesa.
    public function crearRel($data){
        $dataRel['idPersona']     =$data["idPersona"];
        $dataRel['idPerfil']      =$data["idPerfil"];
        $dataRel["idEmpresa"]     =$data["idEmpresa"];
        $dataRel['fecha']         =date("Y-m-d H:i:s");
        //busco si existe relacion antes de crear
        $where['idPersona']     =$data["idPersona"];
        $where['idEmpresa']     =$data["idEmpresa"];
        $buscoRel = $this->ci->dbEmpresas->buscoRel($where);
        //var_dump($buscoRel);die();
        if(count($buscoRel) > 0){
            $respuesta = array("mensaje"=>"La empresa ya se encuentra agregada, por favor verifique e intente nuevamente.",
                "continuar"=>0,
                "datos"=>"");
        }else{
            //crea relacion de oficial de cumplimiento y empresa
            $crea = $this->ci->dbEmpresas->creaRel($dataRel);
            if($crea > 0){
                $respuesta = array("mensaje"=>"Se a agregado una nueva empresa exitosamente.",
                    "continuar"=>1,
                    "datos"=>"");
            }
            else{
                $respuesta = array("mensaje"=>"No se ha podido agregar la empresa, por favor intentelo mas tarde.",
                    "continuar"=>0,
                    "datos"=>"");
            }
        }
        return $respuesta;
    }
    
}