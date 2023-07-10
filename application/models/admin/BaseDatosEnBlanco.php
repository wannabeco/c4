<?php
/*

    ("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por @orugal
   https://github.com/orugal

   Este archivo modelo de base de datos se encargará de realizar los querys de inserción, selección, actualización, eliminación de la base de datos,
   aquí solo se obtiene información, aquí no se deben hacer condicionales ni nada por el estilo, eso de hace en el modelo de lógica.
   
*/
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BaseDatosEnBlanco extends CI_Model {
    private $tableDeptos                 =   "";
    private $tableCiudad                 =   "";
    private $tableMails                  =   "";
    private $tableInfoPago               =   "";
    private $tableEmpresas               =   "";
    private $tablePersonas               =   "";
    private $tableAreas                  =   "";
    public function __construct() 
    {
        parent::__construct();
        //asignación de las tablas, siempre se deben asignar las tablas que se vayan a usar.
        $this->load->database();
        $this->tableDeptos               = "app_departamentos"; 
        $this->tableCiudad               = "app_ciudades"; 
        $this->tableMails                = "app_mails";
        $this->tableInfoPago             = "app_estadopago";
        $this->tableLogin                = "app_login";
        $this->tableEmpresas             = "app_empresas";
        $this->tablePersonas             = "app_personas";
        $this->tablePerfiles             = "app_perfiles";
        $this->tableAreas                = "app_areas";
        $this->tableModulos              = "app_modulos";
        $this->tableRelPerfilModulo      = "app_rel_perfil_modulo";
    }
    //copear y pegar este query las veces que sea necesario para hacer una inserción, recordar cambiar el nombre
    public function queryInsert($dataInserta)
    {
        $this->db->insert($this->tablePersonas,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    //copear y pegar este query las veces que sea necesario realizar actualizaciones en las tablas de la db, recordar cambiar el nombre
    public function queryUpdate($where,$dataActualiza)
    {
        $this->db->where($where);
        $this->db->update($this->tablePersonas,$dataActualiza);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
   //copear y pegar este query las veces que sea necesario realizar seleccion de datos en las tablas de la db, recordar cambiar el nombre
    public function querySelect($where="")
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePersonas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }    
}

?>