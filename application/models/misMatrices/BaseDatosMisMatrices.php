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

class BaseDatosMisMatrices extends CI_Model {
    
    private $tableMatrices                  =   "";
    private $tableTipoEmpresa               =   "";
    private $tableAsignaciones              =   "";
    private $tableEmpresas                  =   "";
    private $tablePersonas                  =   "";
    private $tableRecurrentes               =   "";
    private $tablematrizComprada            =   "";
    private $tableempresasCompradas         =   "";
    private $tableArchivoTemporal           =   "";
    private $tableRcomentarios              =   "";
    private $tableRcheck                    =   "";
    private $tablePeriocidades              =   "";
    private $tablePeriocidad                =   "";
    private $tablePerfiles                  =   "";


    public function __construct() {

        parent::__construct();
        $this->load->database();
        //bases de datos a consultar
        $this->tableMatrices                = "app_nueva_matriz"; 
        $this->tableTipoEmpresa             = "app_tipo_empresa"; 
        $this->tableAsignaciones            = "app_asignaciones"; 
        $this->tableEmpresas                = "app_empresas"; 
        $this->tablePersonas                = "app_personas"; 
        $this->tableRecurrentes             = "app_matriz_recurrente"; 
        $this->tablematrizComprada          = "app_matriz_comprada"; 
        $this->tableempresasCompradas       = "app_rel_cumplimiento_empresa"; 
        $this->tableArchivoTemporal         = "app_archivos_temporales"; 
        $this->tableRcomentarios            = "app_respuesta_comentarios"; 
        $this->tableRcheck                  = "app_respuestas_check"; 
        $this->tablePeriocidades            = "app_rel_periocidad"; 
        $this->tablePeriocidad              = "app_periodicidad"; 
        $this->tablePerfiles                = "app_perfiles"; 
    }
    //se obtienen todos los procesos
    public function consultaMiMatriz($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableMatrices." m");
        $this->db->join($this->tableAsignaciones." a", "a.idMatriz = m.idNuevaMatriz", "INNER");
        $this->db->join($this->tableTipoEmpresa." t", "t.idTipoEmpresa = a.idTipoEmpresa", "INNER");
        $this->db->join($this->tableEmpresas." e", "e.tipoEmpresa = t.idTipoEmpresa", "INNER");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //consulta las relaciones de la matriz
    public function consultaRelacion($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePersonas." p");
        $this->db->join($this->tableEmpresas." e", "e.idEmpresa = p.idEmpresa", "INNER");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //consulta matriz
    public function consultaMatriz($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableMatrices." m");
        $this->db->join($this->tableRecurrentes." r", "r.idNuevaMatriz = m.idNuevaMatriz", "INNER");
        $this->db->join($this->tableAsignaciones." a", "a.idMatriz = m.idNuevaMatriz", "INNER");
        $this->db->group_by("m.idNuevaMatriz");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen las matrices compradas
    public function consultaMatricescompradas($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablematrizComprada." c");
        $this->db->join($this->tableMatrices." n", "n.idNuevaMatriz = c.idMatriz", "INNER");
        $id = $this->db->get();
        // print_r($this->db->last_query());die();
        return $id->result_array();
    }
     //se obtienen todas las nuevas matrices
    public function infoNuevaMatriz($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableMatrices);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //crea Parametros
    public function creaGratis($datos){
        $this->db->insert($this->tablematrizComprada,$datos);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    //validacion de matrices
    public function getMatricesEmpresa($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablematrizComprada);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se las matrices segun la busqueda
    public function infoMatriceslike($datos) {
        $this->db->select("*");
        $this->db->like('nombreNuevaMatriz', $datos['nombreNuevaMatriz']);
        $query = $this->db->get($this->tableMatrices);
        //print_r($this->db->last_query());die();
        return $query->result_array();
    }
    //informacion de todas las empresas
    public function infoEmpresas($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEmpresas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //informacion de empresas compradas
    public function ConsultaEmpresasCompradas($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableempresasCompradas." c");
        $this->db->join($this->tableEmpresas." e", "e.idEmpresa = c.idEmpresa", "INNER");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //busca las matrices segun la empresa
    public function infoEmpresasLike($datos) {
        $this->db->select("*");
        $this->db->like('nombre', $datos['nombre']);
        $query = $this->db->get($this->tableEmpresas);
        //print_r($this->db->last_query());die();
        return $query->result_array();
    }
    //crea relacion cumplimiento empresa
    public function creaGratisrel($datos){
        $this->db->insert($this->tableempresasCompradas,$datos);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    //validacion rel empresas
    public function getrelEmpresa($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableempresasCompradas);
        $id = $this->db->get();
        // print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //consulta matriz por id 
    public function infoMatrize($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableMatrices);
        $id = $this->db->get();
        // print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //consulta empresa por id
    public function infoEmpresa($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEmpresas);
        $id = $this->db->get();
        // print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //elimina matriz comprada
    public function eliminaMatrizComprada($data,$where){
        $this->db->where($where);
        $this->db->update($this->tablematrizComprada,$data);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    public function relEmpresaPerfiles($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePersonas);
        $id = $this->db->get();
        // print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function relOficialEmpresa($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableempresasCompradas);
        $id = $this->db->get();
        // print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //inserto archivo temporales
    public function insertaFotoTemp($datos){
        $this->db->insert($this->tableArchivoTemporal,$datos);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    //consulto comentarios realizados para la matriz
    public function consultaRcomentario($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRcomentarios);
        $id = $this->db->get();
        // print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //consulto item checkeados
    public function consultacheck($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRcheck);
        $id = $this->db->get();
        // print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //actualiza check
    public function actualizaCheck($where,$data){
        $this->db->where($where);
        $this->db->update($this->tableRcheck,$data);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    public function consultacheckRealizado($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRcheck);
        $id = $this->db->get();
        // print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //consulto periocidades
    public function periocidades($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePeriocidades." r");
        $this->db->join($this->tablePeriocidad." e", "e.idperiodicidad = r.idPeriodicidad", "INNER");
        $this->db->join($this->tablePersonas." p", "p.idPersona = r.idPersona", "INNER");
        $this->db->join($this->tablePerfiles." f", "f.idPerfil = p.idPerfil", "INNER");
        $id = $this->db->get();
        // print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //crear periocidad
    public function crearRelPeriocidad($datos){
        $this->db->insert($this->tablePeriocidades,$datos);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    //eliminar periodicidad
    public function updatePeriocidad($data,$where){
        $this->db->where($where);
        $this->db->update($this->tablePeriocidades,$data);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    public function infoPeriodicidad($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePeriocidades." r");
        $this->db->join($this->tablePeriocidad." e", "e.idperiodicidad = r.idPeriodicidad", "INNER");
        $id = $this->db->get();
        // print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //actualizo tabla nueva matriz
    public function actualizoTablaMatriz($data,$where){
        $this->db->where($where);
        $this->db->update($this->tableMatrices,$data);
        // print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    
}

?>