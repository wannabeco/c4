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

class BaseDatosAgendas extends CI_Model {
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
        $this->tableHorarios             = "app_horarios_agendas";
        $this->tableServicios            = "app_lista_de_servicios";
        $this->tableCitas                = "app_citas";
        $this->tableAudCitas             = "app_aud_cita";
        $this->tablePacientes            = "app_pacientes";
    }
    //copear y pegar este query las veces que sea necesario para hacer una inserción, recordar cambiar el nombre
    public function queryInsert($dataInserta)
    {
        $this->db->insert($this->tablePersonas,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    //copear y pegar este query las veces que sea necesario para hacer una inserción, recordar cambiar el nombre
    public function agregaCita($dataInserta)
    {
        $this->db->insert($this->tableCitas,$dataInserta);
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
   //copear y pegar este query las veces que sea necesario realizar seleccion de datos en las tablas de la db, recordar cambiar el nombre
    public function borrarRelacionHorarios($where="")
    {
        $this->db->where($where);
        $this->db->delete($this->tableHorarios);
        //echo $this->db->last_query();die();
        return $this->db->affected_rows();
    } 
    public function getHorariosConfigurados($where="",$group)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePersonas." p");
        $this->db->join($this->tableHorarios." r","r.idPersona=p.idPersona");
        $this->db->join($this->tableServicios." s","r.idServicio=s.idServicio");
        if($group)
        {
            $this->db->group_by("p.idPersona,r.idServicio");
        }
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }    
    //copear y pegar este query las veces que sea necesario para hacer una inserción, recordar cambiar el nombre
    public function insertaHorarios($dataInserta)
    {
        $this->db->insert($this->tableHorarios,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    public function consultaAgendaEspecialista($where,$whereIn=array())
    {
        //var_dump($whereIn);
        $this->db->select("*");
        $this->db->where($where);

        if(count($whereIn) > 0)
        {
            $this->db->where_in('c.tomada',$whereIn);
        }  

        $this->db->from($this->tableCitas." c");
        $this->db->join($this->tableServicios." s","s.idServicio=c.idServicio");
        $this->db->join($this->tablePersonas." p","p.idPersona=c.idEspecialista");
        $this->db->join($this->tablePacientes." pa","pa.idPaciente=c.idPaciente");
        $id = $this->db->get();
       //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function actualizaCitas($where,$dataActualiza)
    {
        $this->db->where($where);
        $this->db->update($this->tableCitas,$dataActualiza);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    public function insertaAudCita($dataInserta)
    {
        $this->db->insert($this->tableAudCitas,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
}

?>