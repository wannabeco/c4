<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BaseDatosAreas extends CI_Model {
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
        $this->load->database();
        $this->tableDeptos               = "app_departamentos"; 
        $this->tableCiudad               = "app_ciudades"; 
        $this->tableMails                = "app_mails";
        $this->tableInfoPago             = "app_estadopago";
        $this->tableEmpresas             = "app_empresas";
        $this->tablePersonas             = "app_personas";
        $this->tableAreas                = "app_areas";
    }
    public function getAreas($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableAreas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function creaNuevaArea($dataInserta)
    {
        $this->db->insert($this->tableAreas,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }

    public function borrarArea($where,$dataInserta)
    {
        $this->db->where($where);
        $this->db->update($this->tableAreas,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }

    
}

?>