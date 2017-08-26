<?php if(!defined("BASEPATH"))exit("Sem direito de acesso direto ao script");

class Empresa_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get_all($max = NULL, $inic = NULL, $ie = NULL, $cnpj = NULL, $id_empresa = NULL, $tipo = NULL, $busca = NULL){
        $this->db->select('*');
        $this->db->from('empresas');
        
        if($ie!=NULL)
            $this->db->like('inscricao_municipal', $ie);
        if($cnpj!=NULL)
            $this->db->like('documento', $cnpj);
        if($id_empresa!=NULL)
            $this->db->where('id', $id_empresa);
        if($max!=NULL)
            $this->db->limit($max, $inic);
        if($tipo!=NULL)
            $this->db->where('tipo', $tipo);
        if($busca != NULL) {
            
            $this->db->like('nome', $busca);
            $this->db->or_like('inscricao_municipal', $busca);
            $this->db->or_like('documento', $busca);
            $this->db->or_like('endereco', $busca);
        }
        return $this->db->get()->result();
    }
    function count_all($ie = NULL, $cnpj = NULL, $tipo = NULL, $busca = NULL){
        if($ie!=NULL)
            $this->db->like('inscricao_municipal', $ie);
        if($cnpj!=NULL)
            $this->db->like('documento', $cnpj);
        if($tipo!=NULL)
            $this->db->where('tipo', $tipo);
        if($busca != NULL) {
            
            $this->db->like('nome', $busca);
            $this->db->or_like('inscricao_municipal', $busca);
            $this->db->or_like('documento', $busca);
            $this->db->or_like('endereco', $busca);
        }
        return $this->db->count_all_results('empresas');
    }
    function set_empresa($dados){
        $this->db->insert('empresas',$dados);
        return $this->UltimoId();
    }
    
    public function BuscarPorId($id) {
        
        $query = $this->db->select('*')
                    ->from('empresas')
                    ->where('id', $id)                    
                    ->get();
        
        return $query->row();
    }
    
    function Atualizar($empresa) {
                
        $this->db->where('id', $empresa['id']);
        return $this->db->update('empresas', $empresa);  
    }
    
    function UltimoId()
    {   
        
        $this->db->from('empresas')->order_by('id', 'desc')->limit('1');
        
        $query = $this->db->get();
        $linha = $query->row();
        return $linha->id;
    }
    
    function get_categorias($id_categoria = NULL){
        $this->db->select('*');
        $this->db->from('categorias');
        
        if($id_categoria != NULL)
            $this->db->where('id_categoria', $id_categoria);
        
        return $this->db->get()->result();
    }
}
