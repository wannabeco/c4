<?php
class LogicaUsuarios  {
    private $ci;
    public function __construct(){
        $this->ci = &get_instance();
        $this->ci->load->model("admin/BaseDatosUsuarios","dbUsuarios");
        $this->ci->load->model("login/BaseDatosLogin","dbLogin");
    } 
    public function infoUsuario($idPersona=""){
        $where = array();
        if($idPersona != ""){
            $where['u.idPersona']    = $idPersona;
        }
        $where['u.eliminado'] = 0;
        $dataUsuario                  = $this->ci->dbUsuarios->infoUsuario($where);
        if(count($dataUsuario) > 0){
            $respuesta = array("mensaje"=>"Información del usuarios consultada.",
                        "continuar"=>1,
                        "datos"=>$dataUsuario); 
        }else{
            $respuesta = array("mensaje"=>"No se ha podido consultar la información del usuario, por favor intente de nuevo más tarde.",
                        "continuar"=>0,
                        "datos"=>""); 
        }
        return $respuesta;
    }
    public function borraUsuario($post){
        extract($post);
        $data['estado']     =  0;
        $data['eliminado']  =  1;
        $where['idPersona'] = $idUsuario;
        $proceso            = $this->ci->dbUsuarios->actualizaUsuario($where,$data);
        if($proceso > 0){
            auditoria("BORRADOPERSONA","Se ha borrado la información de la persona | ".$idUsuario);
            $respuesta = array("mensaje"=>"El usuario se ha eliminado correctamente.",
                          "continuar"=>1,
                          "datos"=>$proceso); 
        }else{
            $respuesta = array("mensaje"=>"No se ha podido eliminar el usuario, por favor intente de nuevo más tarde.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;
    }
    public function generaDatosAcceso($post){
        extract($post);
        $where1['u.idPersona']   = $idUsuario;
        $dataUsuario            = $this->ci->dbUsuarios->infoUsuario($where1);
        $clave                  =   generacodigo(5);
        $data['clave']          =  sha1($clave);
        $data['clave64']        =  base64_encode($clave);
        $data['estado']         = 1;
        $where['idGeneral']     = $idUsuario;
        $proceso                = $this->ci->dbUsuarios->generaDatosAcceso($where,$data);
        if($proceso > 0){
            auditoria("GENDATOSACCESOPERSONA","Se ha generado una clave de acceso a la persona la persona | ".$idUsuario);
            //debo de enviar un correo electrónico al usuario al cuál le han generado una clave de acceso al sistema
            $respuesta = array("mensaje"=>"Se ha generado correctamente la clave de acceso del usuario.<br>Los datos de acceso son los siguientes:<br><br><strong>Usuario:</strong><br>".$dataUsuario[0]['email']."<br><strong>Clave:</strong><br>".$clave."",
                        "continuar"=>1,
                        "datos"=>$proceso); 
        }else{
            $respuesta = array("mensaje"=>"No se ha podido eliminar el usuario, por favor intente de nuevo más tarde.",
                        "continuar"=>0,
                        "datos"=>""); 
        }
        return $respuesta;
    }
    public function procesaUsuarios($post){
        extract($post);
        if($edita == 1){//proceso de edición   
            $where['idPersona'] = $idUsuario;
            unset($post['edita']);
            unset($post['idUsuario']);
            $proceso            = $this->ci->dbUsuarios->actualizaUsuario($where,$post);
            if($proceso > 0){
                auditoria("EDICIONPERSONA","Se ha actualizado la información de la persona | ".$where['idPersona']);
                $respuesta = array("mensaje"=>"La información del usuario se ha actualizado correctamente.",
                              "continuar"=>1,
                              "datos"=>$proceso); 
            }else{
                $respuesta = array("mensaje"=>"No se ha podido editar la información del usuario, por favor intente de nuevo más tarde.",
                              "continuar"=>0,
                              "datos"=>""); 
            }
        }else{//proceso de inserción
            $whereExisteMail['email']     =   $email;
            $yaExistePersonaMail   = $this->ci->dbUsuarios->infoUsuario($whereExisteMail);
            if(count($yaExistePersonaMail) == 0){
                unset($post['edita']);
                unset($post['idUsuario']);
                $proceso            = $this->ci->dbUsuarios->agregaUsuario($post);
                if($proceso > 0){
                    //cada vez que se cree un usuario debo insertarlo de una vez en la tabla del login.
                    $dataInserta['idGeneral']   =   $proceso;
                    $dataInserta['usuario']     =   $post['email'];
                    $dataInserta['tipoLogin']   =   2;
                    $usuarioLogin            = $this->ci->dbUsuarios->insertaUsuarioLogin($dataInserta);
                    auditoria("CREACIONPERSONA","Se ha creado la persona | ".$proceso);
                    $respuesta = array("mensaje"=>"El nuevo usuario se ha insertado correctamente.",
                                    "continuar"=>1,
                                    "datos"=>$proceso); 
                }else{
                    $respuesta = array("mensaje"=>"No se ha podido editar la información del usuario, por favor intente de nuevo más tarde.",
                                    "continuar"=>0,
                                    "datos"=>""); 
                }
            }else{
                    $respuesta = array("mensaje"=>"El correo electrónico que intenta ingresar ya está en la base de datos, por favor verifique.",
                                "continuar"=>0,
                                "datos"=>"");
            }
        }
        return $respuesta;
    }

    public function procesoCambioClave($post){
        extract($post);
        //lo primero que debo hacer es verificar que la clave actual si sea la del usuario
        //verifico en la tabla de login el usuario y la clave
        $select["usuario"]     =   trim($_SESSION['project']['info']['email']);
        $select["clave"]       =   sha1(trim($claveActual));
        //inserto los datos básicos de la empresa
        $dataLogin = $this->ci->dbLogin->verificaUsuarioyClave($select);
        //si este login me envia data, quiere decir que la clave actual es correcta
        if(count($dataLogin) > 0){
            //lugo de verificar la clave actual debo empezar a hacer el proceso de actualización de la clave para el usuario.
            $dataActualiza['clave']         =   sha1($rClave);
            $dataActualiza['clave64']       =   base64_encode($rClave);
            $dataActualiza['cambioClave']   =   0;
            $whereCambio['usuario']         =   $_SESSION['project']['info']['email'];
            $cambioClaveProc                =   $this->ci->dbUsuarios->cambioClave($whereCambio,$dataActualiza);
            if($cambioClaveProc > 0){

                    $email = $_SESSION['project']['info']['email'];
                    $asuntoMensaje  = "Cambio de contraseña";
                    $mensajeenviar  =  "Se ha realizado el cambio de contraseña para acceder al aplicativo de ".lang("titulo")."<br><br>";
                    $mensajeenviar  .=  "Su nueva contraseña es: <h2>".$rClave."</h2>";
                    $mensajeenviar  .= "<a href='https://www.wabecheck.com/' target='_blank'>https://www.wabecheck.com/</a>";
                    $mensaje        = plantillaMail($mensajeenviar);
                    $envioMail      = sendMail($email,$asuntoMensaje,$mensaje);
                    
                $respuesta = array("mensaje"=>"La contraseña se ha cambiado de manera exitosa.",
                                   "continuar"=>1,
                                   "datos"=>"");
            }else{
                $respuesta = array("mensaje"=>"No se ha podido cambiar la contraseña, por favor intente de nuevo más tarde.",
                                  "continuar"=>0,
                                  "datos"=>"");
            }

        }else{
            $respuesta = array("mensaje"=>"Parece que la clave actual no es correcta, por favor verifique.",
                                  "continuar"=>0,
                                  "datos"=>"");
        }
        return $respuesta;
    }
    //se obtiene los usuarios de la empresa
    public function getinfoUsuario($post){
        $where["idEmpresa"] = $post;
        $where["u.eliminado"] = 0;
        $dataUsuario            = $this->ci->dbUsuarios->getinfoUsuario($where);
        //var_dump($dataUsuario);die();
        if($dataUsuario > 0){
            $respuesta = array("mensaje"=>"Información del usuarios consultada.",
                              "continuar"=>1,
                              "datos"=>$dataUsuario); 
        } else{
            $respuesta = array("mensaje"=>"No se realizo consulta de usuario información del usuarios.",
                              "continuar"=>0,
                              "datos"=>$dataUsuario); 
        }
        return $respuesta;
    }
    //info departamentos
    public function infodepartamentos($idpais){
        $where['estado'] = 1;
        $where['ID_PAIS'] = $idpais;
        $departamentos=$this->ci->dbUsuarios->infodepartamentos($where);
        return $departamentos;
    }
    //info ciudades
    public function infociudades($idpais, $idDepartamentos){
        $where['estado'] = 1;
        $where['ID_PAIS'] = $idpais;
        $where['ID_DPTO'] = $idDepartamentos;
        $ciudades=$this->ci->dbUsuarios->infociudades($where);
        return $ciudades;
    }
    //consulto informacion de empresa
    public function infoEmpresa($idEmpresa=""){
        $where = array();
        if($idEmpresa != ""){
            $where['idEmpresa']    = $idEmpresa;
        }
        $where['eliminado'] = 0;
        $dataUsuario                  = $this->ci->dbUsuarios->infoEmpresa($where);
        if(count($dataUsuario) > 0){
            $respuesta = array("mensaje"=>"Información del usuarios consultada.",
                        "continuar"=>1,
                        "datos"=>$dataUsuario); 
        }else{
            $respuesta = array("mensaje"=>"No se ha podido consultar la información del usuario, por favor intente de nuevo más tarde.",
                        "continuar"=>0,
                        "datos"=>""); 
        }
        return $respuesta;
    }
    //procesa informacion de empresa
    public function procesaEmpresa($datos){
        extract($datos);
        if($datos['edita'] == 1){//proceso de edición   
            $where['idEmpresa'] = $datos['idEmpresa'];
            unset($datos['edita']);
            unset($datos['idEmpresa']);
            $proceso            = $this->ci->dbUsuarios->procesaEmpresa($where,$datos);
            if($proceso > 0){
                $respuesta = array("mensaje"=>"La información de la empresa se ha actualizado correctamente.",
                              "continuar"=>1,
                              "datos"=>$proceso); 
            }else{
                $respuesta = array("mensaje"=>"No se ha podido editar la información de la empresa, por favor intente de nuevo más tarde.",
                              "continuar"=>0,
                              "datos"=>""); 
            }
            return $respuesta;
        }
    }
}