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

class BaseDatosMatriz extends CI_Model {
    
    private $tableProcesos                      =   "";
    private $tableFuenteRiesgo                  =   "";
    private $tableFactorEspecifico              =   "";
    private $tableDescripcionRiesgo             =   "";
    private $tableCausas                        =   "";
    private $tableTipoRiesgo                    =   "";
    private $tableConsecuencias                 =   "";
    private $tableRiesgosAsociados              =   "";
    private $tableMatriz                        =   "";
    private $tableNuevaMatriz                   =   "";
    private $tableTipoEmpresa                   =   "";
    private $tableEstados                       =   "";
    private $tablerecurrentes                   =   "";
    private $tableEntidades                     =   "";
    private $tablefejecuacion                   =   "";
    private $tableresponsable                   =   "";
    private $tableccsm                          =   "";
    private $tableMetodoControl                 =   "";
    private $tablePeriodicidad                  =   "";
    private $tableCuandoAplique                 =   "";
    private $tableAsignaciones                  =   "";
    private $tableDirigida                      =   "";
    private $tablePersonas                      =   "";
    private $tableRespuestasCheck               =   "";
    private $tableRespuestasComentario          =   "";


    public function __construct() {

        parent::__construct();
        $this->load->database();
        //bases de datos a consultar
        $this->tableProcesos                    = "app_procesos"; 
        $this->tableFuenteRiesgo                = "app_fuente_riesgo"; 
        $this->tableFactorEspecifico            = "app_factor_especifico"; 
        $this->tableDescripcionRiesgo           = "app_descripcion_riesgos"; 
        $this->tableCausas                      = "app_causas"; 
        $this->tableTipoRiesgo                  = "app_tipo_riesgo"; 
        $this->tableConsecuencias               = "app_consecuencias"; 
        $this->tableRiesgosAsociados            = "app_riesgos_asociados"; 
        $this->tableMatriz                      = "app_matrizes"; 
        $this->tableNuevaMatriz                 = "app_nueva_matriz"; 
        $this->tableTipoEmpresa                 = "app_tipo_empresa"; 
        $this->tableEstados                     = "app_estados";
        $this->tablerecurrentes                 = "app_matriz_recurrente";
        $this->tableEntidades                   = "app_entidades";
        $this->tablefejecuacion                 = "app_frecuencia_ejecucion";
        $this->tableresponsable                 = "app_perfiles";
        $this->tableccsm                        = "app_ccsm";
        $this->tableMetodoControl               = "app_metodo_control";
        $this->tablePeriodicidad                = "app_periodicidad";
        $this->tableCuandoAplique               = "app_cuando_aplique";
        $this->tableAsignaciones                = "app_asignaciones";
        $this->tableDirigida                    = "app_dirigida";
        $this->tablePersonas                    = "app_personas";
        $this->tableRespuestasCheck             = "app_respuestas_check";
        $this->tableRespuestasComentario        = "app_respuesta_comentarios";

    }
    //se obtienen todos los procesos
    public function infoProcesos($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableProcesos);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas las fuentes de riesgo
    public function infoFuenteRiesgo($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableFuenteRiesgo);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas los factores especificos
    public function infoFactorEspecifico($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableFactorEspecifico);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas las descripciones
    public function infoDescripcionR($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableDescripcionRiesgo);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas las descripciones
    public function infoCausas($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableCausas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todos los tipos de riesgo
    public function infoTipoRiesgo($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableTipoRiesgo);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todos los riesgo asociados
    public function infoRiesgoAsociado($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRiesgosAsociados);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas las consecuencias
    public function infoConsecuencias($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableConsecuencias);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas las consecuencias
    public function infoTipoEmpresa($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableTipoEmpresa);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas las entidades
    public function entidades($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEntidades);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas las frecuencia de ejecucion
    public function cuandoAplique($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableCuandoAplique);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas las frecuencia de ejecucion
    public function frecuenciaejecucion($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablefejecuacion);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //informacion de los estados
    public function estados($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEstados);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas los responsable
    public function responsable($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableresponsable);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas los aplicacion Ccsm
    public function aplicaCcsm($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableccsm);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas los metodoControl
    public function metodoControl($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableMetodoControl);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas los periodicidad
    public function periodicidad($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePeriodicidad);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen informacion para donde van dirigidas las matrices
    public function dirigida($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableDirigida);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se crea nueva matriz
    public function creaNuevaMatriz($dataInserta){

        $this->db->insert($this->tableNuevaMatriz,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    //se obtienen todas la matriz recurrentes creada
    public function infoMatriz($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablerecurrentes);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas las nuevas matrices
    public function infoNuevaMatriz($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableNuevaMatriz);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas las nuevas matrices
    public function informacionMatriz($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableNuevaMatriz." n");
        $this->db->join($this->tableDirigida." d", "d.idDirigida = n.dirigida", "INNER");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas las nuevas matrices
    public function informacionMatrizDos($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableNuevaMatriz);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas las asignaciones de matrices especificas
    public function relacionEspecifica($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableAsignaciones." a");
        $this->db->join($this->tableTipoEmpresa." t", "t.idTipoEmpresa = a.idTipoEmpresa", "INNER");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se obtienen todas las consecuencias
    public function infoGeneralMatriz($where) {
        $this->db->distinct();
        $this->db->select("n.*, IFNULL(r.idNuevaMatriz, 0) AS tieneRecurrencia");
        $this->db->from($this->tableNuevaMatriz." n");
        $this->db->join($this->tableEstados." e", "e.idEstado = n.estado", "INNER");
        $this->db->join($this->tableTipoEmpresa." t", "t.idTipoEmpresa = n.dirigida", "INNER");
        $this->db->join($this->tablerecurrentes." r", "r.idNuevaMatriz = n.idNuevaMatriz", "LEFT");
        //$this->db->where('n.estado', $where['estado']);
        $this->db->where('n.eliminado', $where['eliminado']);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se elimina matriz creada
    public function eliminaNuevaMatriz($data,$where)
    {
        $this->db->where($where);
        $this->db->update($this->tableNuevaMatriz,$data);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    //elimina de la tabla
    public function eliminaLaMatriz($data,$whereDos)
    {
        $this->db->where($whereDos);
        $this->db->update($this->tablerecurrentes,$data);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    //crea Parametros
    public function crearParametros($datos)
    {
        $this->db->insert($this->tablerecurrentes,$datos);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    //se asigna tipo de empresa a matrices
    public function guardarRelacionMatriz($datos)
    {
        $this->db->insert($this->tableAsignaciones,$datos);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    //se obtienen datos de la tabla recurrentes
    public function infoMatrizRecurrentes($where)
    {   
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablerecurrentes." r");
        $this->db->join($this->tableEntidades." e"," e.idEntidad=r.idEntidad","INNER");
        $this->db->join($this->tableCuandoAplique." c"," c.idCuandoAplique=r.idcuandoAplique","INNER");
        $this->db->join($this->tableresponsable." p"," p.idPerfil=r.idResponsable","INNER");
        $this->db->join($this->tableccsm." x"," x.idccsm=r.idccsm","INNER");
        $this->db->join($this->tableMetodoControl." M"," M.idMetodoControl=r.idMetodoControl","INNER");
        $this->db->join($this->tablePeriodicidad." l"," l.idperiodicidad=r.idperiodicidad","INNER");
        $this->db->join($this->tableEstados." k"," k.idEstado=r.estado","INNER");
        //$this->db->join($this->tableRespuestasComentario." g"," g.idPerfil=p.idPerfil","INNER");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function infoMatrizporID($where)
    {   
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablerecurrentes." r");
        $this->db->join($this->tableEntidades." e"," e.idEntidad=r.idEntidad","INNER");
        $this->db->join($this->tableCuandoAplique." c"," c.idCuandoAplique=r.idcuandoAplique","INNER");
        $this->db->join($this->tableresponsable." p"," p.idPerfil=r.idResponsable","INNER");
        $this->db->join($this->tableccsm." x"," x.idccsm=r.idccsm","INNER");
        $this->db->join($this->tableMetodoControl." M"," M.idMetodoControl=r.idMetodoControl","INNER");
        $this->db->join($this->tablePeriodicidad." l"," l.idperiodicidad=r.idperiodicidad","INNER");
        $this->db->join($this->tableEstados." k"," k.idEstado=r.estado","INNER");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //elimina parametro de la tabla
    public function eliminaParametro($data,$whereDos)
    {
        $this->db->where($whereDos);
        $this->db->update($this->tablerecurrentes,$data);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    //actualiza los parametros de una matriz
    public function actualizaParametros($data,$where)
    {
        $this->db->where($where);
        $this->db->update($this->tablerecurrentes,$data);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    public function actualizaMatrizGeneral($data,$where)
    {
        $this->db->where($where);
        $this->db->update($this->tableNuevaMatriz,$data);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    //informacion de usuario con perfiles
    public function infoUsuario($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePersonas." p");
        $this->db->join($this->tableresponsable." r", "r.idPerfil = p.idPerfil", "INNER");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //elimina relacion de matrices con tipo de matriz
    public function eliminaRelacion($where){
        $this->db->where($where);
        $this->db->delete($this->tableAsignaciones);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    //crea respuestas checkeo
    public function creaCheckeo($datos)
    {
        $this->db->insert($this->tableRespuestasCheck,$datos);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    //crea el comentario
    public function creaComentario($datos)
    {
        $this->db->insert($this->tableRespuestasComentario,$datos);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    public function infoComentarios($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRespuestasComentario);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    
}

?>