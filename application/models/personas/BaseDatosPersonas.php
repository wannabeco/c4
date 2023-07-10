<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BaseDatosPersonas extends CI_Model {
    private $tablePersonas               =   "";
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->tablePersonas             = "app_personas";
    }
    public function getPersonas($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePersonas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }/*
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
    }*/

    
}

?>