<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BaseDatosLogin extends CI_Model {
    private $tableEmpresas              =   "";
    private $tablePersonas              =   "";
    private $tableLogin                 =   "";
    private $tableRegistrosLogin        =   "";
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->tableEmpresas               = "app_empresas"; 
        $this->tablePersonas               = "app_personas"; 
        $this->tableLogin                  = "app_login"; 
        $this->tableRegistrosLogin         = "app_registroslogin"; 
    }
    public function buscaEmpresa($where,$tabla){
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
    public function verificaUsuarioyClave($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableLogin);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function registraIngreso($dataInserta)
    {
        $this->db->insert($this->tableRegistrosLogin,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
}

?>