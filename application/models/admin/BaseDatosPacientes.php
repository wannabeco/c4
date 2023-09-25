<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BaseDatosPacientes extends CI_Model {
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
        $this->tableLogin                = "app_login";
        $this->tableEmpresas             = "app_empresas";
        $this->tablePersonas             = "app_personas";
        $this->tablePerfiles             = "app_perfiles";
        $this->tableAreas                = "app_areas";
        $this->tableModulos              = "app_modulos";
        $this->tablePacientes            = "app_pacientes";
        $this->tableRelPerfilModulo      = "app_rel_perfil_modulo";
    }
    public function agregaPaciente($dataInserta)
    {
        $this->db->insert($this->tablePacientes,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    public function insertaUsuarioLogin($dataInserta)
    {
        $this->db->insert($this->tableLogin,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    public function actualizaPaciente($where,$dataInserta)
    {
        $this->db->where($where);
        $this->db->update($this->tablePacientes,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    public function generaDatosAcceso($where,$dataInserta)
    {
        $this->db->where($where);
        $this->db->update($this->tableLogin,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    public function infoPaciente($where="")
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePacientes);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }    
}

?>