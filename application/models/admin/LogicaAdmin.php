<?php
class LogicaAdmin  {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("admin/BaseDatosAdmin","dbAdmin");
    } 
    public function agregarCategoriaModulo($data)
    {
        extract($data);
        $dataInserta['idPadre'] = 0;
        $dataInserta['nombreModulo'] = $nombreModulo;
        $nCategoria                  = $this->ci->dbAdmin->agregarCategoriaModulo($dataInserta);
        if($nCategoria > 0)
        {
            auditoria("CREACIONCATEGORIAMODULO","Se ha creado el módulo ".$nombreModulo." | ".$nCategoria);
            $respuesta = array("mensaje"=>"Se ha insertado la categoría.",
                          "continuar"=>1,
                          "datos"=>$nCategoria); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No se ha podido agregar la nueva categoría, por favor intente de nuevo más tarde.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;

    }

    public function editarCategoria($data)
    {
        $where = ['idModulo' => $data['idModulo']];
        $dataUpdate = ['nombreModulo' => $data['nombreModulo']];
        if( $this->ci->dbAdmin->updateCategoriaModulo($where, $dataUpdate) > 0 )
        {
            $respuesta = array("mensaje"=>"Se ha editado la categoría correctamente.",
                          "continuar"=>1,
                          "datos"=>null); 
        } else {
            $respuesta = array("mensaje"=>"No se ha podido editar la categoría, por favor intente de nuevo más tarde.",
                          "continuar"=>0,
                          "datos"=>null); 
        }
        return $respuesta;
    }

    public function crearModulo($data)
    {
        extract($data);
        $dataInserta['idPadre']      = $padre;
        $dataInserta['nombreModulo'] = $nombreModulo;
        $dataInserta['urlModulo']    = $urlModulo;
        $nCategoria                  = $this->ci->dbAdmin->agregarCategoriaModulo($dataInserta);
        if($nCategoria > 0)
        {
            auditoria("CREACIONMODULO","Se ha creado el módulo ".$nombreModulo." | ".$nCategoria);
            $respuesta = array("mensaje"=>"Se ha insertado la categoría.",
                          "continuar"=>1,
                          "datos"=>$nCategoria); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No se ha podido agregar la nueva categoría, por favor intente de nuevo más tarde.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;

    }
    public function editarModulo($data)
    {
        extract($data);
        //var_dump($data);die();
        $dataUpdate['nombreModulo'] = $nombreModulo;
        $dataUpdate['urlModulo']    = $urlModulo;
        $dataUpdate['icono']        = $icono;
        $dataUpdate['orden']        = $orden;
        $dataUpdate['estado']       = $estado;
        $where['idModulo']          = $idEditar;
        $nCategoria                 = $this->ci->dbAdmin->editarModulo($where,$dataUpdate);
        if($nCategoria > 0)
        {
            extract($data);
            $where['idModulo']            = $idEditar;
            //antes de agregar privilegios siempre los voy a borrar
            $deletePrivilegios            = $this->ci->dbAdmin->borraPrivilegio($where);
            auditoria("EDICIONMODULO","Se ha actualizado la información del módulo ".$nombreModulo." | ".$idEditar);
            $respuesta = array("mensaje"=>"Se ha editado el módulo.",
                          "continuar"=>1,
                          "datos"=>$nCategoria); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No se ha podido editar el módulo, por favor intente de nuevo más tarde.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;

    }
    public function estadoCategoriaModulo($data)
    {
        extract($data);
        $dataUpdate['estado']       = ($estadoActual == 1)?0:1;
        $where['idModulo']          = $idCategoria;
        $nCategoria                 = $this->ci->dbAdmin->editarModulo($where,$dataUpdate);
        if($nCategoria > 0)
        {
            auditoria("ESTADOMODULO","Se ha actualizado el estado de la categoría del módulo a ".$dataUpdate['estado']." | ".$idCategoria);
            $respuesta = array("mensaje"=>"Se ha editado la categoria correctamente.",
                          "continuar"=>1,
                          "datos"=>$nCategoria); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No se ha podido editar el módulo, por favor intente de nuevo más tarde.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;

    }


    public function agregarPrivilegio($data)
    {
        extract($data);
        $dataInserta['idPerfil']      = $idPerfil;
        $dataInserta['idModulo']      = $idModulo;
        $dataInserta['ver']           = $ver;
        $dataInserta['crear']         = $crear;
        $dataInserta['editar']        = $editar;
        $dataInserta['borrar']        = $borrar;
        $nCategoria                   = $this->ci->dbAdmin->agregarPrivilegio($dataInserta);
        if($nCategoria > 0)
        {
            auditoria("PRIVILEGIOSMODULOS","Se actualizaron los provilegios del módulo: ver=".$ver.", crear=".$crear.", editar=".$editar.", borrar=".$borrar." para el perfil=".$idPerfil." | ".$idModulo);
            $respuesta = array("mensaje"=>"Se han insertado los privilegios.",
                          "continuar"=>1,
                          "datos"=>$nCategoria); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No se ha podido agregar los privilegios, por favor intente de nuevo más tarde.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;

    }
 }