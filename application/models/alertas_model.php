<?php if(!defined('BASEPATH')) exit('Sem direito de acesso direto ao script.');

class Alertas_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    /*
     * FEEDBACK
     */
    function get_info_face($inicio = NULL, $maximo = NULL, $id_empresa = NULL, $nome = NULL){
        //select count(id_empresa) as qtd, id_empresa from feedback group by id_empresa
        $this->db->select('e.nome, f.id_empresa, count(id_empresa) qtd,  '
                . 'min(data_registro) data_minima, max(data_registro) data_maxima');
        $this->db->from('feedback f');
        $this->db->join('empresas e', 'e.id = f.id_empresa', 'inner');
        $this->db->order_by('qtd', 'desc');
        
        $this->db->group_by('f.id_empresa');
        
        if($id_empresa != NULL)
            $this->db->where('id_empresa', $id_empresa);
        if($nome!=NULL)
            $this->db->like('e.nome', $nome);
        if($maximo!=NULL)
            $this->db->limit($maximo, $inicio);
        
        return $this->db->get()->result();
    }
    function count_all(){
        //select count(id_empresa) as qtd, id_empresa from feedback group by id_empresa        
        $this->db->group_by('f.id_empresa');
        
        return $this->db->count_all_results('feedback f');
    }
    function delete_alertas($id_empresa){
        $this->db->where('id_empresa', $id_empresa);
        return $this->db->delete('feedback');
    }
    
    /*
     * Contatos
     */
    function get_contatos($id_contato = NULL, $status = NULL){
        $this->db->select('*');
        $this->db->from('contatos');
        
        if($id_contato!=NULL)
            $this->db->where('id_contato', $id_contato);
        if($status != NULL){
            if($status == 'ab')
                $this->db->where('status', 0);
            else
                $this->db->where('status', 1);
        }
        
        return $this->db->get()->result();
    }
    
    function count_contatos($status = NULL){
        if($status != NULL){
            if($status == 'ab')
                $this->db->where('status', 0);
            else
                $this->db->where('status', 1);
        }
        return $this->db->count_all_results('contatos');
    }
    
    function ler_contato($dados, $id_baixa){
        $this->db->where('id_contato', $id_baixa);
        return $this->db->update('contatos',$dados);
    }
    
    function set_contato($dados){
        return $this->db->insert('contatos', $dados);
    }
}