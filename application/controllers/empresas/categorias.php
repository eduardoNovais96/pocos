<?php if(!defined('BASEPATH')) exit('Sem direito de acesso direto ao script.');

class Categorias extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('empresa_model', 'em');
    }
    public function index(){
        if(@$this->session->userdata['msg']!=NULL){
            $dados['mensagem'] = $this->session->userdata['msg'];
            $this->session->set_userdata('msg', NULL);
        }
        $dados['categorias'] = $this->em->get_categorias();
        $dados['pagina'] = 'empresas/gerenciar_categorias';
        
        $this->load->view('template', $dados);
    }
    public function nova_categoria(){
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in">','</div>');
        
        if($this->form_validation->run()==false)
            $this->index();
        else{
            $dados['categoria'] = $this->input->post('descricao');
            
            if($this->em->set_categoria($dados))
                $msg = '<div class="alert alert-block alert-success fade in">Categoria cadastrada com sucesso.</div>';
            else
                $msg = '<div class="alert alert-block alert-danger fade in">Algo inesperado aconteceu</div>';
            
            $this->session->set_userdata('msg', $msg);
            redirect(base_url('empresas/categorias'));
        }
    }
    public function editar(){
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in">','</div>');
        
        if($this->form_validation->run()==false)
            $this->index();
        else{
            $dados['categoria'] = $this->input->post('descricao');
            $id = $this->input->post('id_editar');
            
            if($this->em->update_categoria($dados, $id))
                $msg = '<div class="alert alert-block alert-success fade in">Categoria editada com sucesso.</div>';
            else
                $msg = '<div class="alert alert-block alert-danger fade in">Algo inesperado aconteceu</div>';
            
            $this->session->set_userdata('msg', $msg);
            redirect(base_url('empresas/categorias'));
        }
    }
    public function dados_categoria(){
        $id = $this->input->post('id');
        $categoria = $this->em->get_categorias($id);
        
        foreach($categoria as $c){
            $op['descricao'] = $c->categoria;
        }
        
        echo json_encode($op);
    }
}