<?php
class LogicaRegistro  {
    private $ci;
    public function __construct()
    {
        $this->ci = get_instance();
        $this->ci->load->model("registro/BaseDatosRegistro","dbRegistro");
    } 
    public function verificaEmpresa($palabra,$campo,$tabla)
    {
        $select[$campo]     =   trim($palabra);
        //inserto los datos básicos de la empresa
        $dataEmpresa = $this->ci->dbRegistro->verificaEmpresa($select,$tabla);
        return $dataEmpresa;
    }

    /*
    * Inserta Empresas
    * Función que realiza el registro de los perfiles empresariales
    * @author Farez Prieto
    * @date 08 de Julio 2016
    * @return array $respuesta. Esta variable contiene 3 campos
    * mensaje: texto que define la acción
    * continuar: valor entero que retorna 1 si se cumplio el objetivo y si no se cumplió
    * datos: array de con información
    */
    public function insertaEmpresa($data){
        extract($data);
        //antes de registrar la empresa debo verificar que no exista
        $verificoEmpresaNombre = $this->verificaEmpresa($nombre,"nombre","empresas");
        if(count($verificoEmpresaNombre) > 0){//la empresa existe y no debo permitirle el registro
            $respuesta = array("mensaje"=>"El nombre de empresa que intenta crear ya existe en nuestra base de datos. Por favor verifique o intente recuperar su clave si es que la ha olvidado.",
                            "continuar"=>0,
                            "datos"=>"");
        } else {
            //ahora verifico que el mail no este registrado como persona
            $verificoPersonaMail = $this->verificaEmpresa($email,"email","personas");
            if(count($verificoPersonaMail) > 0){  
                $respuesta = array("mensaje"=>"El correo electrónico que intenta registrar ya se encuentra registrado para un perfil tipo persona, por favor verifíquelo o reemplácelo.",
                            "continuar"=>0,
                            "datos"=>"");
            }else{
                //verifico que no este registrado el mail como empresa
                $verificoEmpresaMail = $this->verificaEmpresa($email,"email","empresas");
                if(count($verificoEmpresaMail) > 0){  
                    $respuesta = array("mensaje"=>"El correo electrónico que intenta registrar ya se encuentra registrado, por favor verifíquelo o reemplácelo.",
                                "continuar"=>0,
                                "datos"=>"");
                }else{
                    //procedo a insertar la empresa
                    //armo la data que voy a insertar
                    $dataInsert['nombre']           =   trim($nombre);
                    $dataInsert['direccion']        =   trim($direccion);
                    $dataInsert['telefono']         =   trim($telefono);
                    $dataInsert['email']            =   trim($email);
                    $dataInsert['ciudad']           =   trim($ciudad);
                    $dataInsert['departamento']     =   trim($departamento);
                    //inserto los datos básicos de la empresa
                    $idEmpresa = $this->ci->dbRegistro->insertaEmpresa($dataInsert);
                    //si la inserción es correcta debo notificar para hacer el resto de inserciones
                    if(trim($idEmpresa) > 0){   
                        @mkdir('assets/uploads/files/'.$idEmpresa,0777);
                        //después de haber insertado la empresa debo insertar el usuario y la clave para esta empresa
                        $dataInsertClave['idGeneral']   =   $idEmpresa;
                        $dataInsertClave['tipoLogin']   =   1;//tipo Empresa
                        $dataInsertClave['usuario']     =   $email;
                        $dataInsertClave['clave']       =   sha1($rclave);
                        $dataInsertClave['clave64']     =   base64_encode($rclave);
                        $dataInsertClave['cambioClave'] =   0;
                        //inserto la clave
                        $idLogin                        = $this->ci->dbRegistro->insertaClaveEmpresa($dataInsertClave);
                        if($idLogin > 0){
                            //proceso a insertar el demo que tienen las empresas de 90 días.
                            $dataInsertDemo['idEmpresa']     =   $idEmpresa;
                            $dataInsertDemo['descripcion']   =   "Demo Inicial de 90 días para que pruebes la aplicación.";
                            $dataInsertDemo['fechaInicio']   =   date("Y-m-d H:i:s");
                            $dataInsertDemo['fechaFin']      =   sumaDias(date("Y-m-d H:i:s"),DEFAULT_DEMO_DAYS);
                            $dataInsertDemo['cantComprada']  =   DEFAULT_DEMO_DAYS;
                            //inserto la clave
                            $idPago                          =   $this->ci->dbRegistro->insertaPago($dataInsertDemo);
                            if($idPago){   
                                $asuntoMensaje  = "Registro de empresa";
                                $mensajeenviar  = "<h2>Registro de empresa exitoso</h2> <br>";
                                $mensajeenviar  = "<p>Se ha realizado el registro de su empresa en la plataforma</p> <br>";
                                $mensajeenviar  = "<p>Url: https://check.wannabe.com.co</p> <br>";
                                $mensajeenviar  = "<p>Usuario: ".$email."</p> <br>";
                                $mensajeenviar  = "<p>Contraseña: ".$rclave."</p> <br>";
                                $mensajeenviar  = "<p>Recuerde no compartir los datos de acceso de la empresa.</p> <br>";
                                $mensajeenviar  = "<p>Los datos de acceso son personales.</p> <br>";
                                $mensaje        = plantillaMail($mensajeenviar);
                                $envioMail      = sendMail($email,$asuntoMensaje,$mensaje);
                                //$envioMail                   =   sendMail($email,"Registro de empresa exitoso","Se ha realizado el registro de su empresa en la plataforma");
                                if($envioMail == 1){
                                    $respuesta = array("mensaje"=>"La empresa se ha registrado exitosamente, por favor verifique su correo electrónico al cual llegarán instrucciones de activación de su cuenta.",
                                        "continuar"=>1,
                                        "datos"=>"");
                                }else{
                                    $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, ha habido un error interno que no ha permitido registrar la empresa, por favor intentelo de nuevo más tarde.",
                                        "continuar"=>0,
                                        "datos"=>"");
                                }
                            }else{
                                 $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, ha habido un error interno que no ha permitido registrar la empresa, por favor intentelo de nuevo más tarde.",
                                        "continuar"=>0,
                                        "datos"=>"");
                            }
                            
                        }else{
                            $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, ha habido un error interno que no ha permitido registrar la empresa, por favor intentelo de nuevo más tarde.",
                                        "continuar"=>0,
                                        "datos"=>"");
                        }
                    }else{
                        $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, ha habido un error interno que no ha permitido registrar la empresa, por favor intentelo de nuevo más tarde.",
                                        "continuar"=>0,
                                        "datos"=>"");
                    }
                }
            }
        }
        return $respuesta;
    }
    /*
    * Inserta Personas
    * Función que realiza el registro de los perfiles personales.
    * @author Farez Prieto
    * @date 08 de Julio 2016
    * @return array $respuesta. Esta variable contiene 3 campos
    * mensaje: texto que define la acción
    * continuar: valor entero que retorna 1 si se cumplio el objetivo y si no se cumplió
    * datos: array de con información
    */
    public function insertaPersona($data){
        extract($data);
        //antes de registrar la persona debo verificar que no exista
        $verificoMailEnEmpresa = $this->verificaEmpresa(trim($email),"email","empresas");
        if(count($verificoMailEnEmpresa) > 0){//la empresa existe y no debo permitirle el registro
            $respuesta = array("mensaje"=>"El correo electrónico que intenta registrar pertenece a una cuenta empresarial, por favor verifique.",
                            "continuar"=>0,
                            "datos"=>"");
        } else {
            //ahora verifico que el mail no este registrado como persona
            $verificoPersonaMail = $this->verificaEmpresa($email,"email","personas");
            if(count($verificoPersonaMail) > 0){  
                $respuesta = array("mensaje"=>"El correo electrónico que intenta registrar ya se encuentra registrado, por favor verifíquelo y si es posible ingrese otro.",
                            "continuar"=>0,
                            "datos"=>"");
            } else {
                //procedo a insertar la empresa
                //armo la data que voy a insertar
                $dataInsert['nombre']           =   trim($nombre);
                $dataInsert['email']            =   trim($email);
                $dataInsert['ciudad']           =   trim($ciudad);
                $dataInsert['departamento']     =   trim($departamento);
                //inserto los datos básicos de la empresa
                $idPersona = $this->ci->dbRegistro->insertaPersona($dataInsert);
                //si la inserción es correcta debo notificar para hacer el resto de inserciones
                if(trim($idPersona) > 0){
                    //después de haber insertado la empresa debo insertar el usuario y la clave para esta empresa
                    $dataInsertClave['idGeneral']   =   $idPersona;
                    $dataInsertClave['tipoLogin']   =   2;//tipo Empresa
                    $dataInsertClave['usuario']     =   $email;
                    $dataInsertClave['clave']       =   sha1($rclave);
                    $dataInsertClave['clave64']     =   base64_encode($rclave);
                    $dataInsertClave['cambioClave'] =   0;
                    //inserto la clave
                    $idLogin                        = $this->ci->dbRegistro->insertaClavePersona($dataInsertClave);
                    if($idLogin > 0){
                        $envioMail                   =   sendMail($email,"Registro exitoso","Se ha realizado el registro de su cuenta personal en la plataforma");
                        if($envioMail == 1){
                            $respuesta = array("mensaje"=>"Tu registro se ha llevado a cabo de manera exitosa, por favor verifique su correo electrónico al cual llegarán instrucciones de activación de su cuenta.",
                                "continuar"=>1,
                                "datos"=>"");
                        }else{
                            $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, ha habido un error interno que no ha permitido registrar la empresa, por favor intentelo de nuevo más tarde - Mail",
                                "continuar"=>0,
                                "datos"=>"");
                        }
                        
                    }else{
                        $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, ha habido un error interno que no ha permitido registrar la empresa, por favor intentelo de nuevo más tarde- Usuario",
                                    "continuar"=>0,
                                    "datos"=>"");
                    }
                }else{
                    $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, ha habido un error interno que no ha permitido registrar la empresa, por favor intentelo de nuevo más tarde. -Id Persona",
                                    "continuar"=>0,
                                    "datos"=>"");
                }
            }
        }
        return $respuesta;
    }
    //crea empresa desde el login
    public function creaEmpresaNueva($data){
        extract($data);
        //antes de registrar la empresa debo verificar que no exista
        $verificoEmpresaNombre = $this->verificaEmpresa($nombre,"nombre","empresas");
        if(count($verificoEmpresaNombre) > 0){//la empresa existe y no debo permitirle el registro
            $respuesta = array("mensaje"=>"El nombre de empresa que intenta crear ya existe en nuestra base de datos. Por favor verifique o intente recuperar su clave si es que la ha olvidado.",
                            "continuar"=>0,
                            "datos"=>"");
        } else {
            //ahora verifico que el mail no este registrado como persona
            $verificoPersonaMail = $this->verificaEmpresa($email,"email","personas");
            if(count($verificoPersonaMail) > 0){  
                $respuesta = array("mensaje"=>"El correo electrónico que intenta registrar ya se encuentra registrado para un perfil tipo persona, por favor verifíquelo o reemplácelo.",
                            "continuar"=>0,
                            "datos"=>"");
            } else{
                //verifico que no este registrado el mail como empresa
                $verificoEmpresaMail = $this->verificaEmpresa($email,"email","empresas");
                if(count($verificoEmpresaMail) > 0){  
                    $respuesta = array("mensaje"=>"El correo electrónico que intenta registrar ya se encuentra registrado, por favor verifíquelo o reemplácelo.",
                                "continuar"=>0,
                                "datos"=>"");
                } else {
                    //procedo a insertar la empresa
                    //armo la data que voy a insertar
                    $dataInsert['nombre']           =   trim($nombre);
                    $dataInsert['direccion']        =   "";
                    $dataInsert['telefono']         =   "";
                    $dataInsert['email']            =   trim($email);
                    $dataInsert['ciudad']           =   "";
                    $dataInsert['departamento']     =   "";
                    $dataInsert['tipoEmpresa']      =   trim($tipoEmpresa);
                    $dataInsert['nombreEncargado']  =   trim($nombreUsuario." ".$apellido);
                    $dataInsert['pais']             =   057;
                    $hoy                            =   date("Y-m-d");
                    $dataInsert['fechaCaducidad']   =   date('Y-m-d', strtotime('-1 day', strtotime($hoy)));

                    //inserto los datos básicos de la empresa
                    $idEmpresa = $this->ci->dbRegistro->creaEmpresaNueva($dataInsert);
                    //si la inserción es correcta debo notificar para hacer el resto de inserciones
                    if(trim($idEmpresa) > 0){
                        //después de haber insertado la empresa debo insertar el usuario y la clave para esta empresa
                        $dataInsertClave['idGeneral']   =   $idEmpresa;
                        $dataInsertClave['idPerfil']    =   11;
                        $dataInsertClave['tipoLogin']   =   2;//tipo Empresa
                        $dataInsertClave['usuario']     =   $email;
                        $dataInsertClave['clave']       =   sha1($rclave);
                        $dataInsertClave['clave64']     =   base64_encode($rclave);
                        $dataInsertClave['cambioClave'] =   0;
                        //inserto la clave
                        $idLogin                        = $this->ci->dbRegistro->insertaClaveEmpresa($dataInsertClave);
                        if($idLogin > 0){
                            $dataPerson['nombre']           =   trim($nombreUsuario);
                            $dataPerson['apellido']         =   trim($apellido);
                            $dataPerson['idEmpresa']        =   $idEmpresa;
                            $dataPerson['email']            =   trim($email);
                            $dataPerson['ciudad']           =   "";
                            $dataPerson['departamento']     =   "";
                            $dataPerson['idPerfil']         =   11;
                            $where["idLogin"]               =   $idLogin;
                            $consultaLogin                  = $this->ci->dbRegistro->consultaLogin($where);
                            //inserto los datos básicos de la empresa
                            $idPersona = $this->ci->dbRegistro->insertaPersona($dataPerson);
                            if($idPersona > 0){
                                //proceso a insertar el demo que tienen las empresas de 90 días.
                                $dataInsertDemo['idEmpresa']     =   $idEmpresa;
                                $dataInsertDemo['descripcion']   =   "Demo Inicial de 90 días para que pruebes la aplicación.";
                                $dataInsertDemo['fechaInicio']   =   date("Y-m-d H:i:s");
                                $dataInsertDemo['fechaFin']      =   sumaDias(date("Y-m-d H:i:s"),DEFAULT_DEMO_DAYS);
                                $dataInsertDemo['cantComprada']  =   DEFAULT_DEMO_DAYS;
                                //inserto la clave
                                $idPago                          =   $this->ci->dbRegistro->insertaPago($dataInsertDemo);
                                if($idPago){   
                                    $asuntoMensaje  ="Registro de empresa";
                                    $mensajeenviar  ="<h2>Registro de empresa exitoso</h2> <br>";
                                    $mensajeenviar  ="<p>Se ha realizado el registro de su empresa en la plataforma</p> <br>";
                                    $mensajeenviar  ="<p>Url: https://check.wannabe.com.co</p> <br>";
                                    $mensajeenviar  ="<p>Usuario: ".$email."</p> <br>";
                                    $mensajeenviar  ="<p>Contraseña: ".$rclave."</p> <br>";
                                    $mensajeenviar  ="<p>Recuerde no compartir los datos de acceso de la empresa.</p> <br>";
                                    $mensajeenviar  ="<p>Los datos de acceso son personales.</p> <br>";
                                    $mensaje        = plantillaMail($mensajeenviar);
                                    $envioMail      =sendMail($email,$asuntoMensaje,$mensaje);
                                    //$envioMail                   =   sendMail($email,"Registro de empresa exitoso","Se ha realizado el registro de su empresa en la plataforma");
                                    if($envioMail == 1){
                                        $respuesta = array("mensaje"=>"La empresa se ha registrado exitosamente, por favor verifique su correo electrónico al cual llegarán instrucciones de activación de su cuenta.",
                                            "continuar"=>1,
                                            "datos"=>$consultaLogin);
                                    } else {
                                        $respuesta = array("mensaje"=>"La empresa se ha registrado exitosamente, por favor verifique su correo electrónico al cual llegarán instrucciones de activación de su cuenta.",
                                            "continuar"=>1,
                                            "datos"=>$consultaLogin);
                                    }
                                    
                                } else {
                                     $respuesta = array("mensaje"=>"La empresa se ha registrado exitosamente, por favor verifique su correo electrónico al cual llegarán instrucciones de activación de su cuenta.",
                                            "continuar"=>0,
                                            "datos"=>$consultaLogin);
                                }
                            }
                        } else {
                            $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, ha habido un error interno que no ha permitido registrar la empresa, por favor intentelo de nuevo más tarde.",
                                        "continuar"=>0,
                                        "datos"=>"");
                        }
                    } else {
                        $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, ha habido un error interno que no ha permitido registrar la empresa, por favor intentelo de nuevo más tarde.",
                                        "continuar"=>0,
                                        "datos"=>"");
                    }
                }
            }
        }
        return $respuesta;
    }
    //crea oficial de cumplimiento
    public function creaOficial($data){
        extract($data);
        $email          = $data["email"];
        $rclave         = $data["rclave"];
        $nombreUsuario  = $data["nombreUsuarios"];
        $apellido       = $data["apellidos"];
        $idEmpresa      = "";
        $celular        = $data["celular"];
        //ahora verifico que el mail no este registrado como persona
        $verificoPersonaMail = $this->verificaEmpresa($email,"email","personas");
        if(count($verificoPersonaMail) > 0){  
            $respuesta = array("mensaje"=>"El correo electrónico que intenta registrar ya se encuentra registrado, por favor verifíquelo o reemplácelo.",
                        "continuar"=>0,
                        "datos"=>"");
        }else{
            $dataInsert['idGeneral']   =0;
            $dataInsert['idPerfil']    =8;
            $dataInsert['tipoLogin']   =2;//tipo Empresa
            $dataInsert['usuario']     =$email;
            $dataInsert['clave']       =sha1($rclave);
            $dataInsert['clave64']     =base64_encode($rclave);
            $dataInsert['cambioClave'] =0;
            //inserto la clave
            $idLogin                        = $this->ci->dbRegistro->insertaClaveEmpresa($dataInsert);
            if($idLogin > 0){
                $dataPerson['nombre']           =trim($nombreUsuario);
                $dataPerson['apellido']         =trim($apellido);
                $dataPerson['email']            =trim($email);
                $dataPerson['celular']          = $celular;
                $dataPerson['ciudad']           ="";
                $dataPerson['departamento']     ="";
                $dataPerson['idPerfil']         =8;
                $where["idLogin"]               =$idLogin;
                $consultaLogin                  = $this->ci->dbRegistro->consultaLogin($where);
                //inserto los datos básicos de la persona
                $idPersona = $this->ci->dbRegistro->insertaPersona($dataPerson);
                //se crea relacion de oficial de cumplimiento con pago app_mmebresia:oficial para controlar si esta o no aldia con suspagos
                $dataM["idPersona"] = $idPersona;
                $dataM["email"]     = $email;
                $hoy = date("Y-m-d H:i:s");
                $dataM["fechaIngreso"] = $hoy;
                $dataM["fechaInicioMes"] = $hoy;
                $dataM["fechaCaducidad"] = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($hoy)));
                $dataM["paquete"] = "mensual";
                $dataM["estadoFunciona"] = "normal";

                $emembresiaOficial = $this->ci->dbRegistro->insertaMembresiaMes($dataM);
                //crea relacion de oficial de cumplimiento y empresa
                if($idPersona > 0){
                    //envio email de confirmacion
                    $asuntoMensaje  ="Registro de oficial de cumplimiento";
                    $mensajeenviar  ="<h2>Registro de oficial de cumplimiento exitoso</h2> <br>";
                    $mensajeenviar  ="<p>Se ha realizado el registro plataforma</p> <br>";
                    $mensajeenviar  ="<p>Url: https://check.wannabe.com.co</p> <br>";
                    $mensajeenviar  ="<p>Usuario: ".$email."</p> <br>";
                    $mensajeenviar  ="<p>Contraseña: ".$rclave."</p> <br>";
                    $mensajeenviar  ="<p>Recuerde no compartir los datos de acceso de ingreso.</p> <br>";
                    $mensajeenviar  ="<p>Los datos de acceso son personales.</p> <br>";
                    $mensaje        = plantillaMail($mensajeenviar);
                    $envioMail      =sendMail($email,$asuntoMensaje,$mensaje);
                    if($envioMail > 0){

                        $respuesta = array("mensaje"=>"Se ha registrado exitosamente, por favor verifique su correo electrónico al cual llegarán instrucciones de activación de su cuenta.",
                                            "continuar"=>1,
                                            "datos"=>$consultaLogin);
                    }
                    $respuesta = array("mensaje"=>"Se ha registrado exitosamente, por favor verifique su correo electrónico al cual llegarán instrucciones de activación de su cuenta.",
                                        "continuar"=>1,
                                        "datos"=>$consultaLogin);
                }
            }else{
                $respuesta = array("mensaje"=>"Oops!! Esto es bastante embarazoso, ha habido un error interno que no ha permitido registrarar su usuario, por favor intentelo de nuevo más tarde.",
                                    "continuar"=>0,
                                    "datos"=>"");
            }
        }
        return $respuesta;
    }
}