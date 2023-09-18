<?php
/*

    ("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por @orugal
   https://github.com/orugal

   Lógica que manejará las agendas
   
*/
class LogicaAgendas  {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("admin/BaseDatosAgendas","dbAgendas");//reemplazar por el archivo de base de datos real
        $this->ci->load->model("admin/BaseDatosPacientes","dbPacientes");//reemplazar por el archivo de base de datos real
    } 
    public function infoAgenda($idAgenda="")
    {
        
    }

    public function insertaHorarios($post)
    {
        extract($post);//app_horarios_agendas

        $dataInsertar['idServicio'] = $idServicio;
        $dataInsertar['idPersona'] = $idPersona;
        $dataInsertar['idDiaSemana'] = $diaSemana;
        $dataInsertar['horaInicio'] = $horaInicio;
        $dataInsertar['horaFinal']  = $horaFin;
        $resultado          = $this->ci->dbAgendas->insertaHorarios($dataInsertar);
        //valido
        if($resultado > 0)//todo ok
        {
            auditoria("CREACIONHORARIOSAGENDAGENERAL","Se han insertado los horarios de la persona ".$idPersona." y del servicio ".$idServicio." | ".$idPersona);
            $salida   = array("mensaje"=>"Inserción correcta",
                              "continuar"=>1,
                              "datos"=>$resultado);
        }
        else
        {
            $salida   = array("mensaje"=>"No se pudo insertar",
                              "continuar"=>0,
                              "datos"=>array());
        }
        return $salida; 
    }
    public function borraHorarios($post)
    {
        extract($post);//app_horarios_agendas
        //antes que nada borro toda la información relacionada al usuario y al servicio
        $whereBorrado['idServicio'] = $idServicio;
        $whereBorrado['idPersona']  = $idPersona;
        $borrado  =  $this->ci->dbAgendas->borrarRelacionHorarios($whereBorrado);
        //valido
        if($borrado > 0)//todo ok
        {
            auditoria("BORRADOHORARIOSAGENDAGENERAL","Se han eliminado los horarios de la persona ".$idPersona." y del servicio ".$idServicio." | ".$idPersona);
            $salida   = array("mensaje"=>"Inserción correcta",
                              "continuar"=>1,
                              "datos"=>$resultado);
        }
        else
        {
            $salida   = array("mensaje"=>"No se pudo insertar",
                              "continuar"=>0,
                              "datos"=>array());
        }
        return $salida; 
    }
    public function editaHorarios($post)
    {
        extract($post);//app_horarios_agendas

        $dataInsertar['idServicio'] = $idServicio;
        $dataInsertar['idPersona'] = $idPersona;
        $dataInsertar['idDiaSemana'] = $diaSemana;
        $dataInsertar['horaInicio'] = $horaInicio;
        $dataInsertar['horaFinal']  = $horaFin;
        $resultado          = $this->ci->dbAgendas->insertaHorarios($dataInsertar);
        //valido
        if($resultado > 0)//todo ok
        {
            auditoria("EDICIONHORARIOSAGENDAGENERAL","Se han editado los horarios de la persona ".$idPersona." y del servicio ".$idServicio." | ".$idPersona);
            $salida   = array("mensaje"=>"Inserción correcta",
                              "continuar"=>1,
                              "datos"=>$resultado);
        }
        else
        {
            $salida   = array("mensaje"=>"No se pudo insertar",
                              "continuar"=>0,
                              "datos"=>array());
        }
        return $salida; 
    }

    public function getHorariosConfigurados($post)
    {
        extract($post);
        $final = array();
        $where['p.estado'] = 1;
        if(isset($idPersona))
        {
          $where['p.idPersona']   = $idPersona;
          $where['r.idServicio']  = $idServicio;
        }
        $resultado          = $this->ci->dbAgendas->getHorariosConfigurados($where,true);
        if(count($resultado) > 0)//hay registros
        {
            //ahora proceso a  recorrer el resultado para agregar los horarios reales a los cuales están amarrados
            foreach($resultado as $res)
            {
                $where['p.estado'] = 1;
                $where['p.idPErsona'] = $res['idPersona'];
                $semanas          = $this->ci->dbAgendas->getHorariosConfigurados($where,false);
                foreach($semanas as $dataSem)
                {
                    $sem[]  = $dataSem['idDiaSemana'];
                }

                $nuevaData    = array("idRelacion"=>$res['idRelacion'],
                                      "idServicio"=>$res['idServicio'],
                                      "idPersona"=>$res['idPersona'],
                                      "nombre"=>$res['nombre'],
                                      "horaInicio"=>$res['horaInicio'],
                                      "horaFinal"=>$res['horaFinal'],
                                      "apellido"=>$res['apellido'],
                                      "des_servicios"=>$res['des_servicios'],
                                      "diasSemana"=>$sem);
                array_push($final,$nuevaData);

            }

            $salida   = array("mensaje"=>"Data consultada",
                            "continuar"=>1,
                            "datos"=>$final);
        }
        else
        {
            $salida   = array("mensaje"=>"No hay registros en los horarios",
                            "continuar"=>0,
                            "datos"=>array());
        }
        return $salida; 
    }

    public function consultaAgendaEspecialista($post)
    {
        extract($post);
        $whereCitas['c.idServicio']       =  $idServicio;
        $whereCitas['c.idEspecialista']   =  $idPersona;
        $whereIn                          = array(1,2,3);

        $citas          = $this->ci->dbAgendas->consultaAgendaEspecialista($whereCitas,$whereIn);

        //obtengo los horarios programados
        $whereHorarios['p.estado'] = 1;
        $whereHorarios['p.idPersona']   = $idPersona;
        $whereHorarios['r.idServicio']  = $idServicio;
        $horarios               = $this->ci->dbAgendas->getHorariosConfigurados($whereHorarios,false);

        $dataCitas = array();
        //ordeno la información a mostrar
        foreach($citas as $lista)
        {
            //var_dump($Apartamento);die();
            $fechaHoraCita   = $lista['fechaCita']." ".$lista['horaCita'];
            $fechaHoraCitaF  = $lista['fechaCita']." ".$lista['horaFinCita'];
            $color           = "#6BA5C2";
            if($lista['tomada'] == 1)
            {
                $color           = "#6BA5C2";
            }
            elseif($lista['tomada'] == 2)
            {
                $color           = "#3E9B5D";
            }
            elseif($lista['tomada'] == 3)
            {
                $color           = "#C8A437";
            }
            elseif($lista['tomada'] == 4)
            {
                $color           = "#9E232D";
            }
            $dataSalida =   array("id"=>$lista['idCita'],
                                  "title"=>"Cita de ".$lista['des_servicios'].", Paciente ".$lista['nombre_paciente']." ".$lista['apellido_paciente'],
                                  "start"=>date("Y-m-d H:i",strtotime($fechaHoraCita)),
                                  //"end"=>date("Y-m-d H:i",strtotime('+20 minute',strtotime($fechaHoraCita))),
                                  "end"=>date("Y-m-d H:i",strtotime($fechaHoraCitaF)),
                                  "url"=>"",
                                  "color"=>$color);

             array_push($dataCitas,$dataSalida);
        }


        $dataCompleta['citas']      = $dataCitas;
        $dataCompleta['horarios']   = $horarios;


        $salida   = array("mensaje"=>"Data consultada",
                          "continuar"=>1,
                          "datos"=>$dataCompleta);
        return $salida; 
    }

    public function actualizaCitas($post)
    {
        extract($post);
        $dataActualiza['observaciones'] = $observaciones;
        $dataActualiza['tomada']        = ($proceso==1)?2:4;
        $where['idCita']                =   $idCita;
        $procesoAct            = $this->ci->dbAgendas->actualizaCitas($where,$dataActualiza);
        if($procesoAct > 0)
        {
            //inserto una pequeña auditoría de la cita
            $audInserta['idCita']           =   $idCita;
            $audInserta['fecha']            =   date("Y-m-d H:i:s");
            $audInserta['ip']               =   getIP();
            $audInserta['observaciones']    =   $observaciones;
            $audInserta['usuario']          =   $_SESSION['project']['info']['idPersona'];
            $audInserta['estado']           =   ($proceso==1)?2:4;
            $auditoria            = $this->ci->dbAgendas->insertaAudCita($audInserta);

            if($proceso == 1)
            {
                auditoria("APROBACIONCITA","Se ha aprobado la cita para el paciente, ya está lista para que el médico la tome.| ".$idCita);
            }
            else
            {
                auditoria("CANCELACIONCITA","Se ha cancelado la cita | ".$idCita);
            }

            $mensajeSalida = ($proceso == 1)?"La cita ha sido notificada con éxito. El paciente puede seguir donde el especialista.":"La cita ha sido cancelada exitosamente, el espacio ha quedado disponible para una nueva asignación";

            $respuesta = array("mensaje"=>$mensajeSalida,
                              "continuar"=>1,
                              "datos"=>$procesoAct);
        }
        else
        {
            $mensajeSalida = ($proceso == 1)?"La cita no ha podido ser notificada, intente de nuevo más tarde.":"La cita no ha podido ser cancelada, intente de nuevo más tarde.";
            $respuesta = array("mensaje"=>$mensajeSalida,
                              "continuar"=>0,
                              "datos"=>array());   
        }
        return $respuesta;
    }
    public function procesaCitas($post)
    {
        extract($post);
        if($edita == 1)//proceso de edición
        {   
            $where['idPaciente'] = $idPaciente;
            unset($post['edita']);
            unset($post['idUsuario']);
            unset($post['fechaCita']);
            unset($post['horaCita']);
            unset($post['horaFinCita']);
            unset($post['idServicio']);
            unset($post['idEspecialista']);
            unset($post['idPaciente']);
            $proceso            = $this->ci->dbPacientes->actualizaPaciente($where,$post);
            if($proceso > 0)
            {
                auditoria("EDICIONPACIENTE","Se ha actualizado la data del paciente| ".$idPaciente);

                $dataInsertCita['fechaCita']        = $fechaCita;
                $dataInsertCita['horaCita']         = $horaCita;
                $dataInsertCita['horaFinCita']      = $horaFinCita;
                $dataInsertCita['idServicio']       = $idServicio;
                $dataInsertCita['idEspecialista']   = $idEspecialista;
                $dataInsertCita['idPaciente']       = $idPaciente;

                $procesoCita  = $this->ci->dbAgendas->agregaCita($dataInsertCita);
                auditoria("NUEVACITA","Se ha insertado una nueva cita médica | ".$procesoCita);

                if($procesoCita)
                {
                    //envio mensaje con la data de la cita al paciente que la solicitó
                    if($post['email_paciente'] != "")
                    {
                        $whereCitas['c.idServicio']       =  $idServicio;
                        $whereCitas['c.idEspecialista']   =  $idEspecialista;
                        $whereCitas['c.idPaciente']       =  $idPaciente;

                        $citas          = $this->ci->dbAgendas->consultaAgendaEspecialista($whereCitas);

                        $mensaje                     =  "Se ha realizado la asignación de la cita médica. A continuación se mostrará la información de su cita.<br><br>";
                        $mensaje                    .=  "<strong>Especialista:</strong> ".$citas[0]['nombre']." ".$citas[0]['apellido']."<br>";
                        $mensaje                    .=  "<strong>Fecha:</strong> ".$fechaCita."<br>";
                        $mensaje                    .=  "<strong>Hora de la cita:</strong> ".$horaCita."<br><br>";
                        $mensaje                    .=  "Recuerde que debe estar 15 minutos antes de la cita. Si desea cancelar su cita debe hacerlo con 8 horas de anticipación, comunicándose al teléfono: 404 8985 EXT 101 ó al celular 322 259 1710.";

                        sendMail($post['email_paciente'],"Asignación cita de ".$citas[0]['des_servicios'],$mensaje);

                    }
                     $respuesta = array("mensaje"=>"La cita se ha asignado correctamente, los datos de la cita son los siguientes:.",
                              "continuar"=>1,
                              "datos"=>$proceso);
                }
                else
                {
                    $respuesta = array("mensaje"=>"No se ha podido agregar la cita médica, por favor intente de nuevo más tarde.",
                              "continuar"=>0,
                              "datos"=>$proceso);  
                }
            }
            else
            {

                $dataInsertCita['fechaCita']        = $fechaCita;
                $dataInsertCita['horaCita']         = $horaCita;
                $dataInsertCita['horaFinCita']      = $horaFinCita;
                $dataInsertCita['idServicio']       = $idServicio;
                $dataInsertCita['idEspecialista']   = $idEspecialista;
                $dataInsertCita['idPaciente']       = $idPaciente;

                $procesoCita  = $this->ci->dbAgendas->agregaCita($dataInsertCita);
                auditoria("NUEVACITA","Se ha insertado una nueva cita médica | ".$procesoCita);

                if($procesoCita)
                {
                     //envio mensaje con la data de la cita al paciente que la solicitó
                    if($post['email_paciente'] != "")
                    {
                        $whereCitas['c.idServicio']       =  $idServicio;
                        $whereCitas['c.idEspecialista']   =  $idEspecialista;
                        $whereCitas['c.idPaciente']       =  $idPaciente;

                        $citas          = $this->ci->dbAgendas->consultaAgendaEspecialista($whereCitas);

                        $mensaje                     =  "Se ha realizado la asignación de la cita médica. A continuación se mostrará la información de su cita.<br><br>";
                        $mensaje                    .=  "<strong>Especialista:</strong> ".$citas[0]['nombre']." ".$citas[0]['apellido']."<br>";
                        $mensaje                    .=  "<strong>Fecha:</strong> ".$fechaCita."<br>";
                        $mensaje                    .=  "<strong>Hora de la cita:</strong> ".$horaCita."<br>";
                        $mensaje                    .=  "Recuerde que debe estar 15 minutos antes de la cita. Si desea cancelar su cita debe hacerlo con 8 horas de anticipación, comunicándose al teléfono: 404 8985 EXT 101 ó al celular 322 259 1710.";

                        sendMail($post['email_paciente'],"Asignación cita de ".$citas[0]['des_servicios'],$mensaje);

                    }
                     $respuesta = array("mensaje"=>"La cita se ha asignado correctamente, los datos de la cita son los siguientes:.",
                              "continuar"=>1,
                              "datos"=>$proceso);
                }
                else
                {
                    $respuesta = array("mensaje"=>"No se ha podido agregar la cita médica, por favor intente de nuevo más tarde.",
                              "continuar"=>0,
                              "datos"=>$proceso);  
                }
            }
        }
        else//proceso de inserción
        {
            //antes de insertar debo de verificar si el usuario que se intenta crear ya existe
            $whereExiste['num_doc']       =   $num_doc;
            $whereExiste['eliminado']     =   0;
            $yaExistePaciente   = $this->ci->dbPacientes->infoPaciente($whereExiste);
            if(count($yaExistePaciente) == 0)
            {
                $continuaGuardado = false;
                //ahora verifico que el mail no se registre dos veces
                if($email_paciente != "")
                {
                    $whereExisteMail['email_paciente']     =   $email_paciente;
                    $whereExisteMail['eliminado']          =   0;
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
                    unset($post['fechaCita']);
                    unset($post['horaCita']);
                    unset($post['horaFinCita']);
                    unset($post['idServicio']);
                    unset($post['idEspecialista']);
                    unset($post['idPaciente']);
                    $proceso            = $this->ci->dbPacientes->agregaPaciente($post);
                    if($proceso > 0)//si la inserción del paciente sale bien, procederé a asignar la cita
                    {
                        auditoria("CREACIONPACIENTE","Se ha insertado el nuevo paciente | ".$proceso);

                        $dataInsertCita['fechaCita']        = $fechaCita;
                        $dataInsertCita['horaCita']         = $horaCita;
                        $dataInsertCita['horaFinCita']      = $horaFinCita;
                        $dataInsertCita['idServicio']       = $idServicio;
                        $dataInsertCita['idEspecialista']   = $idEspecialista;
                        $dataInsertCita['idPaciente']       = $proceso;

                        $procesoCita  = $this->ci->dbAgendas->agregaCita($dataInsertCita);

                        auditoria("NUEVACITA","Se ha insertado una nueva cita médica | ".$procesoCita);

                        if($procesoCita)
                        {
                             $respuesta = array("mensaje"=>"La cita se ha asignado correctamente, los datos de la cita son los siguientes:.",
                                      "continuar"=>1,
                                      "datos"=>$proceso);
                        }
                        else
                        {
                             $respuesta = array("mensaje"=>"La cita no ha podido ser agregada, por favor intente de nuevo más tarde.",
                                      "continuar"=>0,
                                      "datos"=>$proceso);
                        } 
                    }
                    else
                    {
                        $respuesta = array("mensaje"=>"No se ha podido editar la agregar la información del paciente, por favor intente de nuevo más tarde.",
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
    public function buscaCitas($post)
    {
        extract($post);

        if(isset($fechaConsulta) && $fechaConsulta != "")
        {
            $whereCitas['c.fechaCita']       =  $fechaConsulta;
        }

        if(isset($idPersona) && $idPersona != "")
        {
            $whereCitas['c.idEspecialista']   =  $idPersona;
        }

        if(isset($idServicio) && $idServicio != "")
        {
            $whereCitas['c.idServicio']   =  $idServicio;
        }

        if(isset($documento) && $documento != "")
        {
            $whereCitas['pa.num_doc']       =  $documento;
        }

        if(isset($estado) && $estado != "")
        {
            $whereCitas['c.tomada']       =  intval($estado);
        }

        $whereCitas['c.estado']             =   1;
        $whereCitas['c.eliminado']          =   0;
        
        $citas          = $this->ci->dbAgendas->consultaAgendaEspecialista($whereCitas);
        if(count($citas) > 0)
        {
            $respuesta = array("mensaje"=>"Listado de citas.",
                                  "continuar"=>1,
                                  "datos"=>$citas); 
        }
        else
        {
             $respuesta = array("mensaje"=>"No se encontraron citas con los parámetros de búsqueda.",
                                  "continuar"=>0,
                                  "datos"=>array()); 
        }
        return $respuesta;
    }
 }