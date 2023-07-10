<?php
class LogicaPersonas  {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("personas/BaseDatosPersonas","dbPersonas");
    } 
    public function getPersonas()
    {
        $where['estado']        = 1;
        $where['eliminado']     = 0;
        $listadoAreas = $this->ci->dbPersonas->getPersonas($where);
        if(count($listadoAreas) > 0)
        {
            $respuesta = array("mensaje"=>"Listado de áreas empresariales consultado.",
                          "continuar"=>1,
                          "datos"=>$listadoAreas); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No hay áreas de trabajo creadas aún, no olvide crearlas haciendo clic en el boton ACCIONES > AGREGAR NUEVA ÁREA.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;
    }/*
    public function creaNuevaArea($data)
    {
        extract($data);
        $dataInsert['nombreArea']     = $nombreArea;
        $dataInsert['idEmpresa']      = $_SESSION['project']['login']['idGeneral'];
        $listadoAreas = $this->ci->dbPersonas->creaNuevaArea($dataInsert);
        if($listadoAreas > 0)
        {
            $respuesta = array("mensaje"=>"Área Creada exitosamente.",
                          "continuar"=>1,
                          "datos"=>""); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No se pudo crear el área, por favor intentelo de nuevo más tarde.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;
    }
    public function borrarArea($data)
    {
        extract($data);
        //elimino los primeros 3 caracteres para saber cual es el id real que voy a eliminar
        $idArea    =   substr($idArea,3,strlen($idArea));

        $where['idArea']         = $idArea;
        $where['idEmpresa']      = $_SESSION['project']['login']['idGeneral'];

        $datos['eliminado']      = 1;

        $listadoAreas = $this->ci->dbPersonas->borrarArea($where,$datos);
        if($listadoAreas > 0)
        {
            $respuesta = array("mensaje"=>"Área Borrada exitosamente.",
                          "continuar"=>1,
                          "datos"=>""); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No se pudo borrar el área, por favor intentelo de nuevo más tarde.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;
    }*/
 }