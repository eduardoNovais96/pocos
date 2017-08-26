<?php if(!defined('BASEPATH')) exit('Sem direito de acesso direto ao script.');

class Info_face extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('alertas_model', 'am');
    }
    
    public function index(){
        $dados['alertas'] = $this->am->get_info_face();
                
        if(@$this->session->userdata['msg'] != NUll){
            $dados['mensagem'] = $this->session->userdata['msg'];
            $this->session->set_userdata('msg', NULL);
        }

        $sess['nome'] = NULL;
        $sess['qtd'] = 10;
        $maximo = 10;
        $this->session->set_userdata($sess);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        if(@$this->input->post('qtd'))
            $maximo = $this->input->post('qtd');
        else
            $maximo = 10;

        $config['base_url'] = '/pocos/alertas/info_face/filtro';
        $config['total_rows'] = count($dados['alertas']);
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
        $dados['pagina'] = 'alertas/info_face';
        
        $this->load->view('template', $dados);
    }
    public function filtro(){
        if(@$this->input->post('nome')){
            $sess['nome'] = $this->input->post('nome');
            $nome = $this->input->post('nome');
        }
        else if($this->session->userdata['qtd']){
            $sess['nome'] = $this->session->userdata['nome'];
            $nome = $this->session->userdata['nome'];
        }
        else{
            $sess['nome'] = NULL;
            $nome = NULL;
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

        $config['base_url'] = '/pocos/alertas/info_face/filtro';
        if($maximo == 'todos'){
            $maximo = count($dados['alertas']);
            $inicio = 0;
        }
        else
            $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");
        
        $dados['alertas'] = $this->am->get_info_face($inicio, $maximo, NULL, $nome);
        $config['total_rows'] = count($dados['alertas']);
        
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
        $dados['pagina'] = 'alertas/info_face';
        
        $this->load->view('template',$dados);
    }
    
    public function alterar_id(){
        $this->form_validation->set_rules('id_facebook', 'ID Facebook', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in">','</div>');
        
        if($this->form_validation->run()==false)
            $this->index();
        else{
            $this->load->model('empresa_model', 'em');
            
            $dados['id_facebook'] = $this->input->post('id_facebook');
            $dados['id'] = $this->input->post('id_empresa');
            
            if($this->em->Atualizar($dados)){
                if($this->am->delete_alertas($dados['id']))
                    $msg = '<div class="alert alert-block alert-success fade in">ID alterado com sucesso.</div>';
                else
                    $msg = '<div class="alert alert-block alert-danger fade in">Algo inesperado aconteceu.</div>';
            }
            else
                $msg = '<div class="alert alert-block alert-danger fade in">Algo inesperado aconteceu.</div>';
            
            $this->session->set_userdata('msg', $msg);
            redirect(base_url('alertas/info_face'));
        }
    }
}