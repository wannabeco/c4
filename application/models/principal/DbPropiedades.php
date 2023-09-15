<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class dbPropiedades extends CI_Model {
    private $tableTipos                 =   "";
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->tableHuella               = "NGAC_USERFIR"; 
    }
    public function getHuellas($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableHuella);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
}

?>