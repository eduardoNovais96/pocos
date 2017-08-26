<?php if(!defined('BASEPATH')) exit ('Sem direito de acesso direto ao script.');

class Gerenciar_empresas extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('empresa_model', 'em');
    }
    
    public function index(){
        if(@$this->session->userdata['msg'] != NUll){
            $data['mensagem'] = $this->session->userdata['msg'];
            $this->session->set_userdata('msg', NULL);
        }
        $sess['empresa'] = NULL;
        $sess['im'] = NULL;
        $sess['cnpj'] = NULL;
        $sess['qtd'] = 10;
        $maximo = 10;
        $this->session->set_userdata($sess);

        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        if(@$this->input->post('qtd'))
            $maximo = $this->input->post('qtd');
        else
            $maximo = 10;

        $config['base_url'] = '/pocos/empresas/gerenciar_empresas/filtro';
        $config['total_rows'] = $this->em->count_all();
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

        $data['paginacao'] = $this->pagination->create_links();
        $data['empresas'] = $this->em->get_all($maximo, $inicio);
        $data['total'] = $config['total_rows'];

        $data['pagina']   = 'empresas/gerenciar_empresas';
        $this->load->view('template',$data);
    }
    public function filtro(){
        if(@$this->input->post('im')){
            $sess['im'] = $this->input->post('im');
            $im = $this->input->post('im');
        }
        else if(@$this->session->userdata['im']){
            $sess['im'] = $this->session->userdata['im'];
            $im = $this->session->userdata['im'];
        }
        else{
            $sess['im'] = NULL;
            $im = NULL;
        }

        if(@$this->input->post('cnpj')){
            $sess['cnpj'] = $this->input->post('cnpj');
            $cnpj = $this->input->post('cnpj');
        }
        else if($this->session->userdata['cnpj']){
            $sess['cnpj'] = $this->session->userdata['cnpj'];
            $cnpj = $this->session->userdata['cnpj'];
        }
        else{
            $sess['cnpj'] = NULL;
            $cnpj = NULL;
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

        $config['base_url'] = '/pocos/empresas/gerenciar_empresas/filtro';
        $config['total_rows'] = $this->em->count_all($im, $cnpj);
        if($maximo == 'todos'){
            $maximo = $this->em->count_all();
            $inicio = 0;
        }
        else
            $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");
        $config['per_page'] = $maximo;
        $config["uri_segment"] = 4;
        $config['first_link'] = 'Primeiro';
        $config['last_link'] = 'Último';
        $config['next_link'] = 'Próximo';
        $config['prev_link'] = 'Anterior';

        $config['full_tag_open'] = '<div class="dataTables_paginate paging_simple_numbers"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
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

        $data['paginacao'] = $this->pagination->create_links();
        $data['empresas'] = $this->em->get_all($maximo, $inicio, $im, $cnpj);
        $data['total'] = $config['total_rows'];

        $data['pagina']   = 'empresas/gerenciar_empresas';
        $this->load->view('template',$data);
    }
    
    public function nova_empresa(){
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('im', 'Inscrição Estadual', 'required');
        $this->form_validation->set_rules('cnpj', 'CNPJ', 'required');
        $this->form_validation->set_rules('endereco', 'Endereço', 'required');
        $this->form_validation->set_rules('data_inscricao', 'Data de Inscrição', 'required');
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in">','</div>');
        
        if($this->form_validation->run()==false)
            $this->index();
        else{
            $dt = explode('/', $this->input->post('data_inscricao'));
            
            $dados['codigo'] = $this->input->post('codigo');
            $dados['tipo'] = $this->input->post('tipo');
            $dados['nome'] = $this->input->post('nome');
            $dados['inscricao_municipal'] = $this->input->post('im');
            $dados['documento']= $this->input->post('cnpj');
            $dados['endereco']= $this->input->post('endereco');
            $dados['datainscricao']= $dt[2].'-'.$dt[1].'-'.$dt[0];
            
            if($this->em->set_empresa($dados))
                $mensagem = '<div class="alert alert-block alert-success fade in">Empresa inserida com sucesso.</div>';
            else
                $mensagem = '<div class="alert alert-block alert-danger fade in">Algo inesperado aconteceu.</div>';
            
            $this->session->set_userdata('msg', $mensagem);
            redirect(base_url('empresas/gerenciar_empresas'));
        }
    }
    
    public function salvar(){
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('im', 'Inscrição Estadual', 'required');
        $this->form_validation->set_rules('cnpj', 'CNPJ', 'required');
        $this->form_validation->set_rules('endereco', 'Endereço', 'required');
        $this->form_validation->set_rules('data_inscricao', 'Data de Inscrição', 'required');
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in">','</div>');
        
        if($this->form_validation->run()==false)
            $this->index();
        else{
            $dt = explode('/', $this->input->post('data_inscricao'));
            
            $dados['id'] = $this->input->post('id_empresa');
            $dados['codigo'] = $this->input->post('codigo');
            $dados['tipo'] = $this->input->post('tipo');
            $dados['nome'] = $this->input->post('nome');
            $dados['inscricao_municipal'] = $this->input->post('im');
            $dados['documento']= $this->input->post('cnpj');
            $dados['endereco']= $this->input->post('endereco');
            $dados['datainscricao']= $dt[2].'-'.$dt[1].'-'.$dt[0];
            
            if($this->em->Atualizar($dados))
                $mensagem = '<div class="alert alert-block alert-success fade in">Empresa atualizada com sucesso.</div>';
            else
                $mensagem = '<div class="alert alert-block alert-danger fade in">Algo inesperado aconteceu.</div>';
            
            $this->session->set_userdata('msg', $mensagem);
            redirect(base_url('empresas/gerenciar_empresas'));
        }
    }
    
    public function dados_empresa($id){
        $empresa = $this->em->get_all(NULL, NULL, NULL, NULL, $id);

        foreach($empresa as $e){
            $dt = explode('-', $e->datainscricao);
            
            $dados['codigo'] = $e->codigo;
            $dados['tipo'] = $e->tipo;
            $dados['nome'] = $e->nome;
            $dados['im'] = $e->inscricao_municipal;
            $dados['cnpj'] = $e->documento;
            $dados['endereco'] = $e->endereco;
            $dados['data_inscricao']= $dt[2].'/'.$dt[1].'/'.$dt[0];
        }
        
        echo json_encode($dados);
        
    }
}