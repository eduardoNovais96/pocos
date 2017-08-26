<?php if(!defined('BASEPATH')) exit('Sem direito de acesso direto ao script.');

class Contatos extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('alertas_model', 'am');
    }
    public function index(){
        if(@$this->session->userdata['msg']!=NULL){
            $dados['mensagem'] = $this->session->userdata['msg'];
            $this->session->set_userdata('msg', NULL);
        }
        $sess['status'] = NULL;
        $sess['qtd'] = 10;
        $maximo = 10;
        $this->session->set_userdata($sess);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        if(@$this->input->post('qtd'))
            $maximo = $this->input->post('qtd');
        else
            $maximo = 10;

        $config['base_url'] = '/pocos/alertas/info_face/filtro';
        $config['total_rows'] = $this->am->count_contatos();
        $config['per_page'] = $maximo;
        $config["uri_segment"] = 4;
        $config['first_link'] = 'Primeiro';
        $config['last_link'] = 'Último';
        $config['next_link'] = 'Próximo';
        $config['prev_link'] = 'Anterior';

        $config['full_tag_open'] = '<div class="dataTables_paginate paging_simple_numbers"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; Primeiro';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Último &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Próximo &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Anterior';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);

        $dados['paginacao'] = $this->pagination->create_links();
        $dados['total'] = $config['total_rows'];
        $dados['contatos'] = $this->am->get_contatos();
        $dados['pagina'] = 'alertas/contatos';
        
        $this->load->view('template', $dados);
    }
    
    public function filtro(){
        if(@$this->input->post('status')){
            $sess['status'] = $this->input->post('status');
            $status = $this->input->post('status');
        }
        else if($this->session->userdata['status']){
            $sess['status'] = $this->session->userdata['status'];
            $status = $this->session->userdata['status'];
        }
        else{
            $sess['status'] = NULL;
            $status = NULL;
        }
        
        if(@$this->input->post('qtd')){
            $sess['qtd'] = $this->input->post('qtd');
            $maximo = $this->input->post('qtd');
        }
        else if($this->session->userdata['qtd']){
            $sess['qtd'] = $this->session->userdata['qtd'];
            $maximo = $this->session->userdata['qtd'];
        }
        else{
            $sess['qtd'] = 10;
            $maximo = 10;
        }
        
        $this->session->set_userdata($sess);

        $config['base_url'] = '/pocos/alertas/contatos/filtro';
        if($maximo == 'todos'){
            $maximo = $this->am->count_contatos();
            $inicio = 0;
        }
        else
            $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");
        
        $config['total_rows'] = $this->am->count_contatos($status);
        
        $config['per_page'] = $maximo;
        $config["uri_segment"] = 4;
        $config['first_link'] = 'Primeiro';
        $config['last_link'] = 'Último';
        $config['next_link'] = 'Próximo';
        $config['prev_link'] = 'Anterior';

        $config['full_tag_open'] = '<div class="dataTables_paginate paging_simple_numbers"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; Primeiro';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Último &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Próximo &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Anterior';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $dados['paginacao'] = $this->pagination->create_links();
        $dados['total'] = $config['total_rows'];
        $dados['contatos'] = $this->am->get_contatos(NULL, $status);
        $dados['pagina'] = 'alertas/contatos';
        
        $this->load->view('template',$dados);
    }
    
    public function salvar(){
        $dados['nome'] = $this->input->post('nome');
        $dados['telefone'] = $this->input->post('telefone');
        $dados['email'] = $this->input->post('email');
        $dados['mensagem'] = $this->input->post('mensagem');
        
        if($this->am->set_contato($dados))
            $msg = '<div class="alert alert-block alert-success">Mensagem enviada com sucesso.</div>';
        else
            $msg = '<div class="alert alert-block alert-danger">Algo inesperado aconteceu</div>';
        
        $this->session->set_userdata('msg', $msg);
        redirect(base_url('contato'));
        
    }
    
    public function dados_contato($id){
        $contato = $this->am->get_contatos($id);

        foreach($contato as $c){
            $dados['nome'] = $c->nome;
            $dados['telefone'] = $c->telefone;
            $dados['email'] = $c->email;
            $dados['status'] = $c->status;
            $dados['mensagem'] = $c->mensagem;
        }

        echo json_encode($dados);
    }
    public function ler_contato(){
        $id_baixa = $this->input->post('id');
        $dados['status'] = 1;
        
        if($this->am->ler_contato($dados, $id_baixa))
            $msg = '<div class="alert alert-block alert-success fade in">Mensagem lida com sucesso.</div>';
        else
            $msg = '<div class="alert alert-block alert-danger fade in">Algo inesperado aconteceu</div>';
        
        $this->session->set_userdata('msg', $msg);
        redirect(base_url('alertas/contatos'));
    }
}