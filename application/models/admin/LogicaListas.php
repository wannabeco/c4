<?php
/*

    ("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por @orugal
   https://github.com/orugal

   Este archivo llamado lógica es el que se encargará de realizar procesos con la información obtenida de las
   bases de datos, aquí se realizan validaciones, armados de arreglos, procesos de calculos y muchos más por el estilo, aquí no deben
   realizarse querys directos a la base de datos, para eso se usa el archivo modelo de base de datos
   
*/
class LogicaListas  {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("admin/BaseDatosListas","dbListas");
    } 
    public function getListas()
    {
        $salida = array();
        $where['idLista !='] = 0;
        $listas = $this->ci->dbListas->getListas($where);
        if(count($listas) > 0)
        {
              $salida = array("mensaje"=>"Listas consultadas",
                              "continuar"=>1,
                              "datos"=>$listas);
        }
        else
        {
              $salida = array("mensaje"=>"No se consultaron las listas",
                              "continuar"=>0,
                              "datos"=>array());
        }
        return $salida;
    }
    /*
    * Archivo de excel que realizará la carga masiva de los archivos de excel para creación de listas, esto ayudará a crear tablas y a administrar información de manera más rápida.
    * @author Farez Prieto
    * @date 21 de Noviembre de 2016
    * @param $dataExcel hace referencia a la data extraida de los archivos en formato Excel y convertida en arreglos.
    * @param $post es el resto de información que se envia por medio del método $_POST
    */
    public function insertaMasivo($dataExcel,$post)
    {
        ini_set('max_execution_time', 1000000000);
        ini_set('max_input_time', 1000000000);
        ini_set('memory_limit', '1024M');
        $salida = array();
        $nuevoNombreTabla = "app_".eliminaCaracteres($post['nombreTabla']);
        $nuevoArrayConData = array();
        //antes que nada debo realizar una validación para garantizar que el excel traiga algo de información y no nos vaya a generar problemas
        if(count($dataExcel) > 0)
        {
          //saco los encabezados
          $encabezados    =  $this->getPrimeraLinea($dataExcel);
          //elimino la primer línea de el excel para eliminar los encabezados
          unset($dataExcel[1]);
          //ahora debo armar el query de creación de la tabla
          
          //recorro los encabezados generados para armar un arreglo final, esperemos que funcione.
          foreach($dataExcel as $datos)
          {
             $cont = 0;//creo un contador en cero cada vez que recorra una línea del arreglo del excel
             foreach($datos as $llave=>$valor)//recorro los datos del excel internos
             {
                //para poder armar el nuevo arreglo con las llaves del arreglo con los valores de la primera fila lo que hago es valerme del contador que va incrementando ya que en teoría siempre serán de la misma longitud.
                $nArray[$encabezados[$cont]] = $valor;
                $cont++;
             }
             //asigno al arreglo final
             array_push($nuevoArrayConData,$nArray);
          }
          //ahora que tengo la data del excel en un arreglo final ya puedo empezar a gestionar la creación de la tabla :D
          $creacionTabla = $this->procesoCreaciontablaAutomatica($nuevoArrayConData,$nuevoNombreTabla,$post['nombreLista']);
          //valido
          if($creacionTabla['continuar'] == 1)
          {
              $cont2 = 0;
              //a esta altura es porque la creación de tabla ha salido correcta, ahora se procede a insertar la información
              foreach($nuevoArrayConData as $dataInserta)
              {
                  $insercionDatos   =  $this->ci->dbListas->insertaDataTablaCreada($dataInserta,$nuevoNombreTabla);
                  $cont2++;
              } 
              if($cont2 == count($nuevoArrayConData))
              {
                  auditoria("CREACIONLISTA","Se ha creado la lista | ".$nuevoNombreTabla);
                  $salida = array("mensaje"=>"La lista se ha creado exitosamente.",
                            "continuar"=>1,
                            "datos"=>array());
              }
          }
          else
          {
             $salida = array("mensaje"=>$creacionTabla['mensaje'],
                            "continuar"=>0,
                            "datos"=>array());
          }
        }   
        else
        {
            $salida = array("mensaje"=>"El archivo de excel no tiene información, recuerde que debe agregar datos para poder crear la lista",
                            "continuar"=>0,
                            "datos"=>array());
        }
        return $salida;
    }
    public function procesoCreaciontablaAutomatica($arrayDepurado,$nombreTabla,$nombreLista)
    {
        $tipoCampo     = "";
        $querySalida   = "CREATE TABLE ".$nombreTabla." ";
        $querySalida  .= "(";
        //creo el campo que será autoincrementable de esta tabla
        $querySalida  .=  "id_".$nombreTabla." BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT, ";
        //con la primera línea tengo tanto los campos que voy a crear como los posibles tipo de campo.
        $primeraLinea = $arrayDepurado[0];
        foreach($primeraLinea as $llave=>$pl)
        {
            if($llave != "")
            {
                $detectoTipoCampo = $pl;
                if(is_numeric($detectoTipoCampo))
                {
                    $tipoCampo = "int";
                }
                else
                {
                    $tipoCampo = "text";
                }

                $querySalida  .=  $llave." ".$tipoCampo.", ";
            }
            
        }
        $querySalida   =  substr($querySalida,0,strlen($querySalida)-2);
        $querySalida  .= ")";
        //ahora que tengo la estructura de la tabla lista para crearse el siguiente paso es verificar que no esté creada.
        $verificaTabla = $this->ci->dbListas->verificaTabla($nombreTabla);
        //cuando la tabla no exista debo hacer la creacion
        if(count($verificaTabla) == 0)
        {
           $creaTabla = $this->ci->dbListas->creaTabla($querySalida);
           //al terminar de crear la tabla debo registrarla en el listado de listas  del administrador.
           $dataInsertaLista['nombreLista']       = $nombreLista;
           $dataInsertaLista['nombreTableLista']  = $nombreTabla;
           $registraLista                         =  $this->ci->dbListas->registraLista($dataInsertaLista);
           $notifica  = array("mensaje"=>"Tabla creada exitosamente","continuar"=>1);
        }
        else
        {
            $notifica = array("mensaje"=>"La tabla que intenta crear ya existe, por favor verifique","continuar"=>0);
        }
        return $notifica;
    }
    public function getPrimeraLinea($dataExcel)
    {
        $primerLinea  =  $dataExcel[1];
        foreach($primerLinea as $llave=>$linea1)
        {
            $campos[] = eliminaCaracteres($linea1);
        }
        return $campos;
    }
 }