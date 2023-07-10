<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BaseDatosRegistro extends CI_Model {
    private $tableEmpresas                 =   "";
    private $tablePersonas                 =   "";
    private $tableClaveEmpresa             =   "";
    private $tablePagosEmpresa             =   "";
    private $tableRel                      =   "";

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->tableEmpresas               = "app_empresas"; 
        $this->tablePersonas               = "app_personas"; 
        $this->tableClaveEmpresa           = "app_login"; 
        $this->tablePagosEmpresa           = "app_estadopago"; 
        $this->tableRel                    = "app_rel_cumplimiento_empresa"; 
    }
    public function verificaEmpresa($where,$tabla){
        $this->db->select("*");
        $this->db->where($where);
        if($tabla == "empresas")
        {
            $this->db->from($this->tableEmpresas);
        }
        else
        {
             $this->db->from($this->tablePersonas);
        }
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //registro empresa
    public function insertaEmpresa($dataInserta){

        $this->db->insert($this->tableEmpresas,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    public function insertaClaveEmpresa($dataInserta){

        $this->db->insert($this->tableClaveEmpresa,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    public function insertaPago($dataInserta){

        $this->db->insert($this->tablePagosEmpresa,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    //registro persona
    public function insertaPersona($dataInserta){

        $this->db->insert($this->tablePersonas,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    public function insertaClavePersona($dataInserta){

        $this->db->insert($this->tableClaveEmpresa,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
     //registro empresa desde el login
     public function creaEmpresaNueva($dataInserta){

        $this->db->insert($this->tableEmpresas,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    //consulta de registro login persona
    public function consultaLogin($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableClaveEmpresa);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //registro relacion de persona con empresa oficial de cumplimiento
    public function creaRel($dataInserta){
        $this->db->insert($this->tableRel,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
}

?>