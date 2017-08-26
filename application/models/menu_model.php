<?php if(!defined("BASEPATH")) exit("Sem direito de acesso direto ao script.");

class Menu_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function get_all($max, $inic){
        $querry = $this->db->get('categoria',$max,$inic);
        return $querry->result();
    }
    function get_nivel(){
        $this->db->select('*');
        $this->db->from('nivel');
        
        return $this->db->get()->result();
    }
    function get_categoria($descricao = NULL, $id=NULL){
        $this->db->select('*');
        $this->db->from('categoria');
        if($descricao!=NULL)
            $this->db->where('descricao',$descricao);
        if($id!=NULL)
            $this->db->where('id_categoria',$id);
        
        return $this->db->get()->result();
    }
    function set_categoria($data){
        return $this->db->insert('categoria',$data);
    }
    function update_categoria($data, $nome=NULL, $id=NULL){
        if($nome != NULL)
            $this->db->where('nome',$nome);
        if($id != NULL)
            $this->db->where('id_categoria',$id);
        return $this->db->update('categoria',$data);
    }
    function excluir_categoria($id = NULL){
        $this->db->where('id_categoria', $id);
        return $this->db->delete('categoria');
    }
    function count_all(){
        return $this->db->count_all_results('categoria');
    }
    function count_all_funcionalidades(){
        return $this->db->count_all_results('funcionalidades');
    }
    function set_funcionalidade($data){
        $this->db->insert('funcionalidades',$data);
        return $this->db->insert_id();
    }
    function editar_funcionalidade($data, $id){
        $this->db->where('id_funcionalidade', $id);
        return $this->db->update('funcionalidades',$data);
    }
    function set_func_niv($data){
        return $this->db->insert('funcionalidade_nivel',$data);
    }
    function get_all_funcionalidades($max,$inic){
        $this->db->select('f.*,c.descricao as descricao_cat');
        $this->db->from('funcionalidades f');
        $this->db->join('categoria c','c.id_categoria = f.id_categoria');
        $this->db->limit($max, $inic);
        
        return $this->db->get()->result();
    }
    function get_funcionalidade($id){
        $this->db->select('f.*,c.descricao as nome_cat');
        $this->db->from('funcionalidades f');
        $this->db->join('categoria c','c.id_categoria = f.id_categoria');
        $this->db->where('f.id_funcionalidade',$id);
        
        return $this->db->get()->result();
    }
    function get_funcionalidade_nivel($id){
        $this->db->select('*');
        $this->db->from('funcionalidade_nivel');
        $this->db->where('id_funcionalidade', $id);
        
        return $this->db->get()->result();        
    }
    function verifica_cadastro_funcionalidade($nome, $url, $id_categoria){
        $this->db->select('*');
        $this->db->from('funcionalidades');
        $this->db->where('descricao',$nome);
        $this->db->where('caminho',$url);
        $this->db->where('id_categoria',$id_categoria);
        
        return $this->db->get()->result();
    }
    function excluir_funcionalidade($id = NULL){
        $this->db->where('id_funcionalidade', $id);
        return $this->db->delete('funcionalidades');
    }
    function excluir_funcionalidade_nivel($id){
        $this->db->where('id_funcionalidade', $id);
        return $this->db->delete('funcionalidade_nivel');
    }
}