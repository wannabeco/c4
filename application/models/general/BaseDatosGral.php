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

class BaseDatosGral extends CI_Model {
    private $tableDeptos                 =   "";
    private $tableCiudad                 =   "";
    private $tableMails                  =   "";
    private $tableInfoPago               =   "";
    private $tableEmpresas               =   "";
    private $tablePersonas               =   "";
    private $tableTipoEmpresa            =   "";
    private $tableModulos                =   "";
    private $tableRelModulosPerfil       =   "";
    private $tablePerfiles               =   "";
    private $tableTiposDoc               =   "";
    private $tableSexo                   =   "";
    private $tableProfesiones            =   "";
    private $tableCargos                 =   "";
    private $tableAreas                  =   "";
    private $tableEps                    =   "";
    private $tableCesantias              =   "";
    private $tableAfp                    =   "";
    private $tableServicios              =   "";
    private $tableRelCargoServ           =   "";
    private $tableAseguradoras           =   "";
    private $tableAuditoria              =   "";
    private $tableOcupaciones            =   "";
    private $tableEstadoCivil            =   "";
    private $tableEscolaridad            =   "";
    private $tableReligiones             =   "";
    private $tableGrupoEtnico            =   "";
    private $tableCiediez                =   "";
    private $tableRelCieDiez             =   "";
    private $tableVariablesGlobales      =   "";
    private $tablePagoMatrices           =   "";
    private $tablePagotemporalm          =   "";
    private $tablePagoEmpresa            =   "";
    private $tablePagoEmpresalm          =   "";
    private $tablesugiereMatriz          =   "";
    
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
        $this->tableModulos              = "app_modulos";
        $this->tableRelModulosPerfil     = "app_rel_perfil_modulo";
        $this->tablePerfiles             = "app_perfiles";
        $this->tableTiposDoc             = "app_tipos_doc";
        $this->tableSexo                 = "app_sexo";
        $this->tableProfesiones          = "app_profesiones";
        $this->tableCargos               = "app_cargos";
        $this->tableAreas                = "app_areas";
        $this->tableEps                  = "app_listado_eps";
        $this->tableCesantias            = "app_cesantias";
        $this->tableAfp                  = "app_listado_afp";
        $this->tableServicios            = "app_lista_de_servicios";
        $this->tableRelCargoServ         = "app_rel_cargo_servicio";
        $this->tableAseguradoras         = "app_lista_aseguradoras";
        $this->tableAuditoria            = "app_auditoria_general";
        $this->tableOcupaciones          = "app_lista_ocupaciones";
        $this->tableEstadoCivil          = "app_lista_estados_civiles";
        $this->tableEscolaridad          = "app_lista_nivel_educativo";
        $this->tableReligiones           = "app_lista_religiones";
        $this->tableGrupoEtnico          = "app_pertenencia_etnica";
        $this->tableCiediez              = "app_cie_diez";
        $this->tableRelCieDiez           = "app_rel_visitas_ciediez";
        $this->tableVariablesGlobales    = "app_variablesglobales";
        $this->tableTipoEmpresa          = "app_tipo_empresa";
        $this->tablePagoMatrices         = "app_pago_matrices";
        $this->tablePagotemporalm        = "app_cMatrices_temporal";
        $this->tablePagoEmpresa          = "app_pago_empresas";
        $this->tablePagoEmpresalm        = "app_cEmpresas_temporal";
        $this->tablesugiereMatriz        = "app_sugiere_matriz";
    }
    public function getVariablesGlobales(){
        $this->db->select("*");
        $this->db->from($this->tableVariablesGlobales);
        $this->db->order_by("variable","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getDepartamentos($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableDeptos);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getCiudades($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableCiudad);
        $this->db->order_by("NOMBRE","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaCieDiez($where,$like){
        $this->db->select("*");
        $this->db->where($where);
        //$this->db->or_where($where);
        $this->db->from($this->tableCiediez);
        $this->db->like('descripcion', $like);
        $this->db->order_by("descripcion","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }

    public function consultaEPS($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEps);
        $this->db->order_by("des_eps","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }

    public function especialistasServicio($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePersonas." p");
        $this->db->join($this->tableRelCargoServ." rs"," rs.idCargo = p.idCargo");
        $this->db->order_by("p.nombre","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }

    public function getDiagnosticos($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRelCieDiez." c");
        $this->db->join($this->tableCiediez." d"," d.codigo=c.id_cie_diez","INNER");
        $this->db->order_by("d.descripcion","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaAFP($where){ 
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableAfp);
        $this->db->order_by("des_afp","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaCesantias($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableCesantias);
        $this->db->order_by("nombrefondocesantias","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaAseguradoras($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableAseguradoras);
        $this->db->order_by("des_asegurador","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaOcupaciones($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableOcupaciones);
        $this->db->order_by("descripcion","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaEstadoCivil($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEstadoCivil);
        $this->db->order_by("des_estado_civil","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaGrupoEtnico($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableGrupoEtnico);
        //$this->db->order_by("grupo_etnia","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaEscolaridad($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEscolaridad);
        $this->db->order_by("niveleducativo","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaReligiones($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableReligiones);
        $this->db->order_by("des_religiones","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }

    public function getInfoPago($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableInfoPago);
        $this->db->order_by("idPago","DESC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getInfoEmpresa($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEmpresas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getInfoPersonas($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePersonas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getInfoPersonasCruce($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePersonas." p");
        $this->db->join($this->tableCargos." c","c.idCargo=p.idCargo","INNER");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaPerfiles($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePerfiles);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getServicios($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableServicios);
        $this->db->order_by("des_servicios","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultatiposDoc($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableTiposDoc);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaSexo($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableSexo);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaCargos($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableCargos);
        $this->db->order_by("nombreCargo","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaAreas($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableAreas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaProfesiones($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableProfesiones);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function envioMailDB($dataInserta){
        $this->db->insert($this->tableMails,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();

    }
    public function auditoria($dataInserta){
        $this->db->insert($this->tableAuditoria,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();

    }
    public function infoModulo($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableModulos);
        $this->db->order_by("orden","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getDistCatModuloModulos($where){
        $this->db->select("distinct(m.idPadre)");
        $this->db->where($where);
        $this->db->from($this->tableModulos." m");
        $this->db->join($this->tableRelModulosPerfil." r","r.idModulo=m.idModulo","INNER"); 
        $this->db->order_by("m.idPadre","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }

    public function getModulosIn($where_in){
        $this->db->select("*");
        $this->db->where_in("idModulo",$where_in);
        $this->db->where(array("estado"=>1));
        $this->db->from($this->tableModulos);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();   
    }

    public function getModulos($where){
        $this->db->select("m.idModulo,m.idPadre,m.nombreModulo,m.urlModulo,m.icono,m.eliminado,m.estado");
        $this->db->where($where);
        $this->db->from($this->tableModulos." m");
        $this->db->join($this->tableRelModulosPerfil." r","r.idModulo=m.idModulo","INNER");
        $this->db->group_by("m.idModulo","ASC");
        $this->db->order_by("m.idPadre","ASC");
        $id = $this->db->get();
        //echo $this->db->last_query()."<hr>";
        return $id->result_array();
    }
    public function consultaRelacionPerfil($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRelModulosPerfil);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    //get tipo empresa
    public function getTipoEmpresa($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableTipoEmpresa);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //get empresas
    public function getEmpresas($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEmpresas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se inserta el codigo
    public function insetCodigo($dataInserta){
        $this->db->insert($this->tablePagoMatrices,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    //inserta pago de matriz temporal
    public function insertCmatriz($dataInserta){
        $this->db->insert($this->tablePagotemporalm,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    //get tipo empresa
    public function compraMatrizTemporal($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePagotemporalm." t");//pedido temporal
        $this->db->join($this->tablePagoMatrices." p","p.idPago=t.idPago","INNER");//tabla de pago
        $id = $this->db->get();
        $this->db->limit(1);
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //se inserta el codigo
    public function insetCodigoEmpresas($dataInserta){
        $this->db->insert($this->tablePagoEmpresa,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    //inserta pedido temporal de empresas
    public function insetCEmpresaTemporal($dataInserta){
        $this->db->insert($this->tablePagoEmpresalm,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
    //informacion de pedido
    public function compraEmpresaTemporal($where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePagoEmpresalm." e");//pedido temporal
        $this->db->join($this->tablePagoEmpresa." p","p.idPagoEmpresa=e.idPago","INNER");//tabla de pago
        $id = $this->db->get();
        $this->db->limit(1);
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    //inserta sugerencia de nueva matriz
    public function sugiereMatriz($dataInserta){
        $this->db->insert($this->tablesugiereMatriz,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }
}


?>