<?php
class LogicaPropiedades  {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("principal/DbPropiedades","propiedadesDb");
    } 
    public function getReservas($where)
    {
        $listaReservas = $this->ci->propiedadesDb->getHuellas($where);
        return $listaReservas;
    }
 }