<?php
class LogicaLogin  {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("login/BaseDatosLogin","dbLogin");
        $this->ci->load->model("login/BaseDatosGeneral","dbGeneral");
        $this->ci->load->model("admin/BaseDatosUsuarios","dbUsuarios");
    }
    public function verificaEmpresa($palabra,$campo,$tabla)
    {
        $select[$campo]     =   trim($palabra);
        //inserto los datos básicos de la empresa
        $dataEmpresa = $this->ci->dbLogin->buscaEmpresa($select,$tabla);
        return $dataEmpresa;
    }
    public function getPictureLogin($data)
    {
        extract($data);
        $buscaEmpresa = $this->verificaEmpresa($palabra,"email","empresas");
        if(count($buscaEmpresa) > 0)//existe como empresa
        {
            $respuesta = array("mensaje"=>"Foto obtenida",
                              "continuar"=>1,
                              "tipo"=>"empresas",
                              "datos"=>$buscaEmpresa);            
        }
        else
        {
            //lo busco como persona
            $buscaPersona = $this->verificaEmpresa($palabra,"email","personas");
            if(count($buscaPersona) > 0)//existe como persona
            {
                $respuesta = array("mensaje"=>"Foto obtenida",
                                  "continuar"=>1,
                                  "tipo"=>"personas",
                                  "datos"=>$buscaPersona); 
            }
            else
            {
                $respuesta = array("mensaje"=>"No hay datos",
                                  "continuar"=>0,
                                  "tipo"=>"",
                                  "datos"=>""); 

            } 
        }
        return $respuesta;
    }
    /*
    * Esta función me permite el acceso al sistema, la función realiza una serie
    * de validaciones para saber que tipo de usuario es, también para detectar
    * si está activo, inactivo, debe algún pago y todo lo demás.
    * @input array $data que es el post del formulario, contiene las variables $usuario y $clave
    * @return array $respuesta con las 3 variables de siempre mensaje, datos y continuar
    * @author Farez Prieto @orugal
    * @date 29 de Junio de 2016
    */
    public function getLoginUsuario($data)
    {
        //extraigo el post en variables
        extract($data);
        //verifico en la tabla de login el usuario y la clave
        $select["usuario"]     =   trim($usuario);
        $select["clave"]       =   sha1(trim($clave));
        //inserto los datos básicos de la empresa
        $dataLogin = $this->ci->dbLogin->verificaUsuarioyClave($select);
        //en primera instancia debo validar si esto retorno información
        //si retorna quiere decir que el usuario existe
        if(count($dataLogin) > 0)
        {
            //cada vez que se realice un lógin lo voy a guardar por seguridad
            $this->registraIngresoLogin($dataLogin[0]);
            //ahora debo identificar el tipo de login que me ha retornado este query
            if($dataLogin[0]['tipoLogin'] == 1)//empresa
            {
                $respuesta = $this->procesoEmpresas($dataLogin[0]);
            }
            elseif($dataLogin[0]['tipoLogin'] == 2)//usuario
            {
                $respuesta = $this->procesoPersonas($dataLogin[0]);
            }
            else
            {
                $respuesta = array("mensaje"=>"El tipo de usuario no es válido",
                                  "continuar"=>0,
                                  "datos"=>""); 
            }
        }
        else//no existe, así que notifico
        {
            $respuesta = array("mensaje"=>"Usuario o clave incorrecto, por favor verifique e intente de nuevo.",
                                  "continuar"=>0,
                                  "datos"=>""); 
        }

        return $respuesta;
    }
    /*
    * Función que permite poner en una tabla un registro de auditoría cada vez que un usuario se loguea, esta función guarda la ip, la fecha de logueo y el dispositivo desde el cual ingresa
    * @input array $dataLogin la cual contiene la información del usuario logueado
    * @return no retorna nada.
    * @author Farez Prieto
    * @date 15 de Julio de 2016
    */
    public function registraIngresoLogin($dataLogin)
    {
        $data['idLogin'] = $dataLogin['idLogin'];
        $data['fecha'] = date("Y-m-d H:i:s");
        $data['ip']      = getIP();
        $data['disp']    = getDisp();
        $registraIngreso = $this->ci->dbLogin->registraIngreso($data);
    }
    /*
    * Función que realizará el cambio de contraseña de los usuarios cuando la han olvidado
    */
    public function cambioClave($post)
    {
        extract($post);
        //verifico que el mai lque ingresó exista
        $whereInfoEmpresa['usuario'] = $usuario;
        $infoUsuario =  $this->ci->dbLogin->verificaUsuarioyClave($whereInfoEmpresa);
        if(count($infoUsuario))
        {
            //cómo existe el usuario en la base de datos, verifico que ya tenga una clave generada
            if($infoUsuario[0]['clave'] != "")
            {
                //como si tiene clave generada debo proceder a generar una nueva.
                $clave                  =   generacodigo(5);
                $data['clave']          =  sha1($clave);
                $data['clave64']        =  base64_encode($clave);
                $data['cambioClave']    = 1;
                $where['usuario']       = $usuario;
                $proceso                = $this->ci->dbUsuarios->generaDatosAcceso($where,$data);
                if($proceso)
                {
                    //inserto auditoría
                    auditoria("RECORDACIONCLAVEUSUARIO","Se ha generado una clave de acceso a la persona la persona | ".$infoUsuario[0]['idGeneral']);
                    //envio mail
                    $email = $usuario;
                    $asuntoMensaje  = "Olvido de contraseña";
                    $mensajeenviar  = "Se le ha generado una nueva clave de acceso ".lang("titulo")."<br><br>";
                    $mensajeenviar  .= "Su nueva contraseña es: <br><h2>".$clave."</h2><br>";
                    $mensajeenviar  .= "Recuerde que debe cambiar la contraseña una vez ingrese al sistema.<br>";
                    $mensajeenviar  .= "<a href='https://www.wabecheck.com/' target='_blank'>https://www.wabecheck.com/</a>";
                    $mensaje        = plantillaMail($mensajeenviar);
                    $envioMail      = sendMail($email,$asuntoMensaje,$mensaje);

                    $mensaje                     =  "Se le ha generado una nueva clave de acceso ".lang("titulo")."<br><br>";
                    $mensaje                    .=  "Su nueva contraseña es: <br><h2>".$clave."</h2><br><br>";
                    $mensaje                    .=  "Recuerde que debe cambiar la contraseña una vez ingrese al sistema.";
                    sendMail($usuario,"Olvido de contraseña - ".lang("titulo"),$mensaje);

                    //envio un mail al usuario con la nueva clave
                    $respuesta = array("mensaje"=>"Se ha generado una nueva contraseña de acceso y se ha enviado a su correo electrónico, por favor verifique. Recuerde que debe cambiar esta contraseña al ingresar de nuevo al sistema.",
                                      "continuar"=>1,
                                      "datos"=>"");
                } else {
                     $respuesta = array("mensaje"=>"La contraseña no ha podido ser generada, por favor intente de nuevo más tarde.",
                                        "continuar"=>0,
                                        "datos"=>"");

                }
            } else {
                 $respuesta = array("mensaje"=>"Este usuario no tiene aún una clave generada, debe comunicarse con el administrador para que genere la clave de primera vez.",
                                      "continuar"=>0,
                                      "datos"=>"");
            }
        } else {
             $respuesta = array("mensaje"=>"El correo electrónico ingresado no existe en nuestra base de datos, por favor verifique.",
                                  "continuar"=>0,
                                  "datos"=>""); 
        }
        return $respuesta;
    }

    /*
    * Función que realizará el proceso de login para los usuarios tipo persona
    * @input array $dataLogin la cual contiene la información del usuario logueado
    * @return array $respuesta con las 4 variables mensaje, datos, zona y continuar
    * Zona 0: Login
    * Zona 1: Pago -- Los usuarios no deben pagar
    * Zona 2: Ingreso
    * @author Farez Prieto
    * @date 15 de Julio de 2016
    */
    public function procesoPersonas($dataLogin)
    {   
        //lo primero que valido es si el usuario está activo o no
        if($dataLogin['estado'] == 1)//estado
        {   
            //die("asd");
            //si todo ha salido bien simplemente consulto la información de la empresa y envio al usuario al home de la plataforma
                $whereInfoEmpresa['email'] = $dataLogin['usuario'];
                $infoEmpresa =  $this->ci->dbGeneral->getInfoPersonas($whereInfoEmpresa);
                //levanto la famosa sessión project con 3 posiciones importantes para dejarlo todo ordenado
                //info
                //login
                //esta variable permite el acceso a todo el sistema
                $_SESSION['project']['info']  = $infoEmpresa[0];
                $_SESSION['project']['login'] = $dataLogin;
                auditoria("INICIODESESION","Ha ingresado al sistema el usuario ".$infoEmpresa[0]['nombre']." ".$infoEmpresa[0]['apellido']." | ".$infoEmpresa[0]['idPersona']);
                $respuesta = array("mensaje"=>"Bienvenido al sistema usuario",
                                   "continuar"=>1,
                                   "zona"=>2,
                                   "datos"=>""); 
        }
        else
        {
            $respuesta = array("mensaje"=>"Parece que su usuario está inactivo, por favor intente de nuevo, si el problema persiste pongase en contacto con soporte técnico.",
                                  "continuar"=>0,
                                  "zona"=>0,
                                  "datos"=>""); 
        }
        return $respuesta;
    }

    /*
    * Función que realizará el proceso de login para las empresas
    * la dejo de maneja independiente para evitar tanto desorden de código
    * @input array $dataLogin esto es la información recibida de la tabla login
    * @return array $respuesta con las 4 variables mensaje, datos, zona y continuar
    * Zona 0: Login
    * Zona 1: Pago
    * Zona 2: Ingreso
    * @author Farez Prieto @orugal
    */
    public function procesoEmpresas($dataLogin)
    {
        //lo primero que valido es si el usuario está activo o no
        if($dataLogin['estado'] == 1)//estado
        {
            //ahora debo saber si el usuario tiene derecho a entrar porque tiene sus pagos correctos
            //consulo estado del pago
            $wherePago['idEmpresa']  =   $dataLogin['idGeneral'];
            $wherePago['estado']     =   1;
            $wherePago['eliminado'] =   0;
            $infoPago = $this->ci->dbGeneral->getInfoPago($wherePago);
            //para esta validación siempre debo tomar el resultado de la posición 0 ya que sería el pago actual.
            //ahora debo identificar las variables que me dicen si el pago es correcto o debo enviarlo a la zona de pago
            $pago = vencimiento($infoPago[0]['cantComprada'],$infoPago[0]['fechaInicio']);
            //realizo la validación que me dice si esta debiendo o puede ingresar sin problema
            if($pago['vencido'] == 0)//no debe nada
            {
                //si todo ha salido bien simplemente consulto la información de la empresa y envio al usuario al home de la plataforma
                $whereInfoEmpresa['idEmpresa'] = $dataLogin['idGeneral'];
                $infoEmpresa =  $this->ci->dbGeneral->getInfoEmpresa($whereInfoEmpresa);
                //levanto la famosa sessión project con 3 posiciones importantes para dejarlo todo ordenado
                //info
                //pago
                //login
                //esta variable permite el acceso a todo el sistema
                $_SESSION['project']['info']  = $infoEmpresa[0];
                $_SESSION['project']['pago']  = $infoPago[0];
                $_SESSION['project']['login'] = $dataLogin;
                $respuesta = array("mensaje"=>"Bienvenido al sistema",
                                   "continuar"=>1,
                                   "zona"=>2,
                                   "datos"=>""); 
            }
            else //debe pagar licencia
            {
                //a la hora del pago  levanto una sessión que será la que me permita hacer la compra sin tener que afectar los demás módulos, esta sesión será igual que la sesión principal pero con otro nombre
                $whereInfoEmpresa['idEmpresa'] = $dataLogin['idGeneral'];
                $infoEmpresa =  $this->ci->dbGeneral->getInfoEmpresa($whereInfoEmpresa);
                //levanto la famosa sessión pago con 3 posiciones importantes para dejarlo todo ordenado
                //info
                //pago
                //login
                //esta variable permite el acceso a todo el sistema
                $_SESSION['pago']['info']  = $infoEmpresa[0];
                $_SESSION['pago']['pago']  = $infoPago[0];
                $_SESSION['pago']['login'] = $dataLogin;
                //valido si es demo o no es demo
                if($infoPago[0]['esDemo'] == 1)
                {
                    $respuesta = array("mensaje"=>"El periodo de prueba asignado se ha terminado, lo invitamos a dirigirse a nuestra zona de compra de licencia y adquirir una nueva para seguir difrutando de nuestra aplicación.",
                                   "continuar"=>1,
                                   "zona"=>1,
                                   "datos"=>""); 
                }
                else
                {
                    $respuesta = array("mensaje"=>"Parece que hay un problema con la facturación de su licencia, sera dirigido a nuestra zona de pago del servicio.",
                                   "continuar"=>1,
                                   "zona"=>1,
                                   "datos"=>""); 
                }
                
            }
        }
        else
        {
            $respuesta = array("mensaje"=>"Parece que su usuario está inactivo, por favor intente de nuevo, si el problema persiste pongase en contacto con soporte técnico.",
                                  "continuar"=>0,
                                  "zona"=>0,
                                  "datos"=>""); 
        }

        return $respuesta;
    }
    //login 2
    public function getLoginUsuarioDos($data)
    {
        //extraigo el post en variables
        
        //verifico en la tabla de login el usuario y la clave
        $select["usuario"]     =   trim($data["usuario"]);
        $select["clave"]       =   sha1(trim($data["clave"]));
        //var_dump($select);die();
        //inserto los datos básicos de la empresa
        $dataLogin = $this->ci->dbLogin->verificaUsuarioyClave($select);
        //en primera instancia debo validar si esto retorno información
        //si retorna quiere decir que el usuario existe
        if(count($dataLogin) > 0)
        {
            //cada vez que se realice un lógin lo voy a guardar por seguridad
            $this->registraIngresoLogin($dataLogin[0]);
            //ahora debo identificar el tipo de login que me ha retornado este query
            if($dataLogin[0]['tipoLogin'] == 1)//empresa
            {
                $respuesta = $this->procesoEmpresas($dataLogin[0]);
            }
            elseif($dataLogin[0]['tipoLogin'] == 2)//usuario
            {
                $respuesta = $this->procesoPersonas($dataLogin[0]);
            }
            else
            {
                $respuesta = array("mensaje"=>"El tipo de usuario no es válido",
                                  "continuar"=>0,
                                  "datos"=>""); 
            }
        }
        else//no existe, así que notifico
        {
            $respuesta = array("mensaje"=>"Usuario o clave incorrecto, por favor verifique e intente de nuevo.",
                                  "continuar"=>0,
                                  "datos"=>""); 
        }

        return $respuesta;
    }
 }