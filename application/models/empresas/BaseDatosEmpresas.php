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
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BaseDatosEmpresas extends CI_Model {
    
    private $tableEmpresas                      = "";
    private $tableDepartmentos                  = "";
    private $tableCiudades                      = "";
    private $tipoEmpresa                        = "";
    private $tablePaises                        = "";
    private $tableRelCumplimiento               = "";

    public function __construct() {

        parent::__construct();
        $this->load->database();
        //bases de datos a consultar
        $this->tableEmpresas                    = "app_empresas"; 
        $this->tableDepartmentos                = "app_departamentos"; 
        $this->tableCiudades                    = "app_ciudades"; 
        $this->tipoEmpresa                      = "app_tipo_empresa"; 
        $this->tablePaises                      = "app_paises"; 
        $this->tableRelCumplimiento             = "app_rel_cumplimiento_empresa"; 
    }
    //se obtienen imformacion de todas las empresas
    public function infoEmpresas($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEmpresas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //info de paises
    public function infopaises($pais)
    {
        $this->db->select("*");
        $this->db->where($pais);
        $this->db->from($this->tablePaises);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //info departamentos
    public function infodepartamentos($departamento)
    {
        $this->db->select("*");
        $this->db->where($departamento);
        $this->db->from($this->tableDepartmentos);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //info ciudades
    public function infociudades($ciudad)
    {
        $this->db->select("*");
        $this->db->where($ciudad);
        $this->db->from($this->tableCiudades);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //informacion de empresa individual
    public function infoEmpresa($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEmpresas." e");
        $this->db->join($this->tipoEmpresa." t"," t.idTipoEmpresa=e.tipoEmpresa","INNER");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se elimina empresa
    public function eliminaEmpresa($data,$where){
        $this->db->where($where);
        $this->db->update($this->tableEmpresas,$data);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    public function misEmpresas($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRelCumplimiento." c");
        $this->db->join($this->tableEmpresas." e"," e.idEmpresa=c.idEmpresa","INNER");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //elimina relacion de empresa con oficila de cumplimiento
    public function eliminaRel($where){
        $this->db->where($where);
        $this->db->delete($this->tableRelCumplimiento);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    //busco que no exista relacion
    public function buscoRel($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRelCumplimiento);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //registro relacion de persona con empresa oficial de cumplimiento
    public function creaRel($dataInserta){
        $this->db->insert($this->tableRelCumplimiento,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    
    
}

?>