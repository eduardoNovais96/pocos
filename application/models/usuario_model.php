<?php if(!defined("BASEPATH"))exit("Sem direito de acesso direto ao script");

class Usuario_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function logar($data){
        $this->db->select('u.id_usuario, u.nome, u.usuario, un.id_nivel as cod_nivel, n.descricao as nivel, u.status');
        $this->db->from('usuarios u');
        $this->db->join('usuarios_nivel un','un.id_usuario = u.id_usuario','inner');
        $this->db->join('nivel n','un.id_nivel = n.id_nivel','inner');
        $this->db->where('u.usuario',$data['usuario']);
        $this->db->where('u.senha',$data['senha']);
        
        return $this->db->get()->result();
    }
    function get_funcionalidades($where){
        $this->db->select('f.*');
        $this->db->from('funcionalidades f');
        $this->db->join('funcionalidade_nivel fn','fn.id_funcionalidade = f.id_funcionalidade','inner');
        $this->db->where($where);
        $this->db->order_by('id_funcionalidade');
        $this->db->order_by('f.descricao');
        
        return $this->db->get()->result_array();
    }
    function get_categorias($cat){
        $this->db->select('*');
        $this->db->from('categoria');
        $this->db->where('id_categoria',$cat);
        
        return $this->db->get()->result();
    }
    function get_cat_dif($where){
        $this->db->distinct('f.id_categoria, f.menu');
        $this->db->select('f.id_categoria');
        $this->db->from('funcionalidades f');
        $this->db->join('funcionalidade_nivel fn','fn.id_funcionalidade = f.id_funcionalidade','inner');
        $this->db->where($where);
        
        return $this->db->get()->result();
    }
    function get_all($max, $inic, $nome = NULL, $usuario = NULL){
        $this->db->select('*');
        $this->db->from('usuarios');
        
        if($nome!=NULL)
            $this->db->like('nome', $nome);
        if($usuario!=NULL)
            $this->db->like('usuario', $usuario);
//        $querry  = $this->db->get('usuario',$max,$inic);
        $this->db->limit($max, $inic);
        return $this->db->get()->result();
    }
    function get_nivel(){
        $this->db->select('*');
        $this->db->from('nivel');
        return $this->db->get()->result();
    }
    function count_all($nome = NULL, $usuario = NULL){
        if($nome!=NULL)
            $this->db->like('nome', $nome);
        if($usuario!=NULL)
            $this->db->like('usuario', $usuario);
        return $this->db->count_all_results('usuarios');
    }
    function usuario_existente($usuario = NULL, $id = NULL, $senha = NULL, $email = NULL){
        $this->db->select('*');
        $this->db->from('usuarios');
        if($usuario != NULL)
            $this->db->where('usuario',$usuario);
        if($email != NULL)
            $this->db->where('email', $email);
        if($id != NULL)
            $this->db->where('id_usuario',$id);
        if($senha != NULL)
            $this->db->where('senha',$senha);
        
        return $this->db->get()->result();
    }
    function novo_usuario($data){
        $this->db->insert('usuarios',$data);
        return $this->db->insert_id();
    }
    function novo_usuario_nivel($dados){
        $this->db->insert('usuarios_nivel', $dados);
    }
    function editar_usuario($dados, $id){
        $this->db->where('id_usuario', $id);
        return $this->db->update('usuarios',$dados);
    }
    function get_usuario_existente($usuario, $id){
        $this->db->select('*');
        $this->db->from('usuarios');

        $this->db->where('usuario',$usuario);
        $this->db->where('id_usuario !=',$id);
        
        return $this->db->get()->result();
    }
    function recuperar($usuario = NULL, $email = NULL){
        $this->db->select('id_usuario, nome, email, usuario');
        $this->db->from('usuarios');
        
        if($usuario != NULL)
            $this->db->where('usuario', $usuario);
        if($email != NULL)
            $this->db->where('email', $email);
        
        return $this->db->get()->result();
    }
    function get_link($link=NULL, $ativo=NULL, $usuario = NULL){
        $this->db->select('*');
        $this->db->from('recuperar_senha');
        
        if($link != NULL)
            $this->db->where('link', $link);
        if($ativo!=NULL)
            $this->db->where('ativo', 1);
        if($usuario!=NULL)
            $this->db->where('id_usuario',$usuario);
        
        return $this->db->get()->result();
    }
    function set_link($dados){
        return $this->db->insert('recuperar_senha', $dados);
    }
    function editar_link($dados, $link){
        $this->db->where('link', $link);
        return $this->db->update('recuperar_senha',$dados);
    }
    function get_ususario_nivel($id_usuario = NULL){
        $this->db->select('*');
        $this->db->from('usuarios_nivel');
        if($id_usuario!=NULL){
            $this->db->where('id_usuario', $id_usuario);
        }
        return $this->db->get()->result();
    }
    function excluir_nivel($id = NULL){
        $this->db->where('id_usuario', $id);
        return $this->db->delete('usuarios_nivel');
    }
}