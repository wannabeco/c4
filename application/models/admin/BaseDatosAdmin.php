<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BaseDatosAdmin extends CI_Model {
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
        $this->tableModulos              = "app_modulos";
        $this->tableRelPerfilModulo      = "app_rel_perfil_modulo";
    }
    public function agregarCategoriaModulo($dataInserta)
    {
        $this->db->insert($this->tableModulos,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }

    public function updateCategoriaModulo($where, $dataSet)
    {
        $this->db->where($where)->update($this->tableModulos, $dataSet);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }

    public function agregarPrivilegio($dataInserta)
    {
        $this->db->insert($this->tableRelPerfilModulo,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    public function borraPrivilegio($where)
    {
        $this->db->where($where);
        $this->db->delete($this->tableRelPerfilModulo);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    public function editarModulo($where,$dataInserta)
    {
        $this->db->where($where);
        $this->db->update($this->tableModulos,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }

    
}

?>