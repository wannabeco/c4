<?php
class LogicaPacientes  {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("admin/BaseDatosPacientes","dbPacientes");
    } 
    public function infoPaciente($idPaciente="",$whereQuery=array())
    {
        $where['estado']    = 1;
        //$where['eliminado'] = 0;
        if($idPaciente != "")
        {
            $where['idPaciente'] = $idPaciente;
        }
        if(count($whereQuery) > 0)
        {
            $where['num_doc'] = $whereQuery['num_doc'];
        }
        if(isset($_SESSION['tipoPac']) && $_SESSION['tipoPac'] != "")
        {
            $where['tipoPaciente'] = $_SESSION['tipoPac'];   
        }
        //var_dump($where);
        $dataUsuario                  = $this->ci->dbPacientes->infoPaciente($where);
        if(count($dataUsuario) > 0)
        {
            $respuesta = array("mensaje"=>"Información del usuarios consultada.",
                          "continuar"=>1,
                          "datos"=>$dataUsuario); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No hay pacientes en este momento.",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;

    }
    public function borraPaciente($post)
    {
        extract($post);
        $data['estado']     =  0;
        $data['eliminado']  =  1;
        $where['idPaciente'] = $idPaciente;
        $proceso            = $this->ci->dbPacientes->actualizaPaciente($where,$data);
        if($proceso > 0)
        {
            auditoria("BORRADOPACIENTE","Se ha eliminado el paciente| ".$idPaciente);
            $respuesta = array("mensaje"=>"El paciente se ha eliminado correctamente.",
                          "continuar"=>1,
                          "datos"=>$proceso); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No se ha podido eliminar el paciente, por favor intente de nuevo más tarde.",
                          "continuar"=>0,
                          "datos"=>""); 
        }

        return $respuesta;
    }
    public function generaDatosAcceso($post)
    {
        extract($post);
        $where1['u.idPersona']   = $idUsuario;
        $dataUsuario            = $this->ci->dbPacientes->infoUsuario($where1);
        $clave                  =   generacodigo(5);
        $data['clave']          =  sha1($clave);
        $data['clave64']        =  base64_encode($clave);
        $data['estado']         = 1;

        $where['idGeneral']     = $idUsuario;
        $proceso                = $this->ci->dbPacientes->generaDatosAcceso($where,$data);
        if($proceso > 0)
        {
            $respuesta = array("mensaje"=>"Se ha generado correctamente la clave de acceso del usuario.<br>Los datos de acceso son los siguientes:<br><br><strong>Usuario:</strong><br>".$dataUsuario[0]['email']."<br><strong>Clave:</strong><br>".$clave."",
                          "continuar"=>1,
                          "datos"=>$proceso); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No se ha podido eliminar el usuario, por favor intente de nuevo más tarde.",
                          "continuar"=>0,
                          "datos"=>""); 
        }

        return $respuesta;
    }
    public function procesaUsuarios($post)
    {
        extract($post);
        if($edita == 1)//proceso de edición
        {   
            $where['idPaciente'] = $idPaciente;
            unset($post['edita']);
            unset($post['idPaciente']);
            $proceso            = $this->ci->dbPacientes->actualizaPaciente($where,$post);
            if($proceso > 0)
            {

                auditoria("EDICIONPACIENTE","Se ha actualizado la data del paciente| ".$idPaciente);
                $respuesta = array("mensaje"=>"La información del usuario se ha actualizado correctamente.",
                              "continuar"=>1,
                              "datos"=>$proceso); 
            }
            else
            {
                $respuesta = array("mensaje"=>"No se ha podido editar la información del usuario, por favor intente de nuevo más tarde.",
                              "continuar"=>0,
                              "datos"=>""); 
            }
        }
        else//proceso de inserción
        {
            //antes de insertar debo de verificar si el usuario que se intenta crear ya existe
            $whereExiste['num_doc']     =   $num_doc;
            $whereExiste['eliminado']   =   0;
            $yaExistePaciente   = $this->ci->dbPacientes->infoPaciente($whereExiste);
            if(count($yaExistePaciente) == 0)
            {
                $continuaGuardado = false;
                //ahora verifico que el mail no se registre dos veces
                if($email_paciente != "")
                {
                    $whereExisteMail['email_paciente']     =   $email_paciente;
                    $whereExiste['eliminado']   =   0;
                    $yaExistePacienteMail   = $this->ci->dbPacientes->infoPaciente($whereExisteMail);
                    if(count($yaExistePacienteMail) == 0)
                    {
                        $continuaGuardado = true;
                    }
                    else
                    {
                        $continuaGuardado = false;
                    }
                }
                else
                {
                    $continuaGuardado = true;
                }

                if($continuaGuardado)
                {
                    unset($post['edita']);
                    unset($post['idUsuario']);
                    $proceso            = $this->ci->dbPacientes->agregaPaciente($post);
                    if($proceso > 0)
                    {
                        auditoria("CREACIONPACIENTE","Se ha insertado el nuevo paciente | ".$proceso);
                        $respuesta = array("mensaje"=>"El nuevo paciente se ha insertado correctamente.",
                                      "continuar"=>1,
                                      "datos"=>$proceso); 
                    }
                    else
                    {
                        $respuesta = array("mensaje"=>"No se ha podido editar la información del paciente, por favor intente de nuevo más tarde.",
                                      "continuar"=>0,
                                      "datos"=>""); 
                    }
                }
                else
                {
                    $respuesta = array("mensaje"=>"El correo electrónico que intenta registrar ya se encuentra en la base de datos, por favor verifique.",
                                  "continuar"=>0,
                                  "datos"=>""); 

                }
            }
            else
            {
                $respuesta = array("mensaje"=>"El paciente que intenta crear ya existe en nuestra base de datos, por favor verifique.",
                                  "continuar"=>0,
                                  "datos"=>""); 

            }
        }

        return $respuesta;
    }
 }