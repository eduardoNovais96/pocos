<?php if(!defined("BASEPATH"))exit("Sem direito de acesso direto ao script");

class Empresa_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get_all($max, $inic, $ie = NULL, $cnpj = NULL, $id_empresa = NULL){
        $this->db->select('*');
        $this->db->from('empresas');
        
        if($ie!=NULL)
            $this->db->like('inscricao_municipal', $ie);
        if($cnpj!=NULL)
            $this->db->like('documento', $cnpj);
        if($id_empresa!=NULL)
            $this->db->where('id', $id_empresa);

        $this->db->limit($max, $inic);
        return $this->db->get()->result();
    }
    function count_all($ie = NULL, $cnpj = NULL){
        if($ie!=NULL)
            $this->db->like('inscricao_municipal', $ie);
        if($cnpj!=NULL)
            $this->db->like('documento', $cnpj);
        return $this->db->count_all_results('empresas');
    }
    function set_empresa($dados){
        return $this->db->insert('empresas',$dados);
    }
}