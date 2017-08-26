<?php if(!defined('BASEPATH')) exit('Sem direito de acesso direto ao script.');

class Funcionalidades extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('menu_model','mm');
    }
    public function index($data = NULL){
        if(@$this->session->userdata['mensagem'] != NULL){
            $data['mensagem'] = $this->session->userdata['mensagem'];
            $this->session->set_userdata('mensagem', NULL);
        }
        
        $sess['qtd'] = 10;
        $maximo = 10;
        $this->session->set_userdata($sess);
        
        $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

        if(@$this->input->post('qtd'))
            $maximo = $this->input->post('qtd');
        else
            $maximo = 10;
        
        $config['base_url'] = '/avicultura/menu/funcionalidades/filtro';
        $config['total_rows'] = $this->mm->count_all_funcionalidades();
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
        $data['total'] = $config['total_rows'];        
        $data['funcio'] = $this->mm->get_all_funcionalidades($maximo, $inicio);
        $data['pagina'] = 'menu/funcionalidades';
        $data['nivel']  = $this->mm->get_nivel();
        $data['categoria'] = $this->mm->get_categoria();
        
        $this->load->view('template',$data);
    }
    
    public function filtro(){
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
        
        $config['base_url'] = '/avicultura/menu/funcionalidades/filtro';
        $config['total_rows'] = $this->mm->count_all_funcionalidades();
        if($maximo == 'todos'){
            $maximo = $this->mm->count_all_funcionalidades();
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
        $data['funcio'] = $this->mm->get_all_funcionalidades($maximo, $inicio);
        $data['total'] = $config['total_rows'];
        $data['pagina'] = 'menu/funcionalidades';
        $data['nivel']  = $this->mm->get_nivel();
        $data['categoria'] = $this->mm->get_categoria();
        
        $this->load->view('template',$data);
    }
    
    public function adcionar_funcionalidade(){
        $this->form_validation->set_rules('descricao','Descrição','required');
        $this->form_validation->set_rules('caminho','Caminho','required');
        $this->form_validation->set_rules('categoria','Categoria','required');
        $this->form_validation->set_rules('nivel','Nível','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in">','</div>');
        
        if($this->form_validation->run()==FALSE){
            $this->index();
        }
        else{
            $data['descricao'] = $this->input->post('descricao');
            $data['caminho'] = $this->input->post('caminho');
            $data['id_categoria'] = $this->input->post('categoria');
            $rsp = $this->mm->verifica_cadastro_funcionalidade($data['descricao'], $data['caminho'], $data['id_categoria']);
            if(@$rsp[0]->nome)
                redirect(base_url('menu/funcionalidades'));
            else{
                $dados['id_funcionalidade'] = $this->mm->set_funcionalidade($data);
                foreach ($this->input->post('nivel') as $n){
                    $dados['id_nivel'] = $n;
                    $this->mm->set_func_niv($dados);
                }
                $data['mensagem'] = '<div class="alert alert-success">Funcionalidade adcionada com sucesso. </div>';
            $this->session->set_userdata('mensagem', $data['mensagem']);
            redirect(base_url('menu/funcionalidades'));
            }
        }
        
    }
    
    public function excluir($id){
        $this->mm->excluir_funcionalidade($id);
        $this->mm->excluir_funcionalidade_nivel($id);
        $data['mensagem'] = '<div class="alert alert-success">Funcionalidade excluida com sucesso. </div>';
        $this->session->set_userdata('mensagem', $data['mensagem']);
        redirect(base_url('menu/funcionalidades'));
    }
    
    public function editar_funcionalidade(){
        $this->form_validation->set_rules('descricao_editar','Descrição','required');
        $this->form_validation->set_rules('caminho_editar','Caminho','required');
        $this->form_validation->set_rules('categoria_editar','Categoria','required');
        $this->form_validation->set_rules('nivel_editar','Nível','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in">','</div>');
        if($this->form_validation->run()==FALSE)
            $this->index();
        else{
            $data['descricao'] = $this->input->post('descricao_editar');
            $data['caminho'] = $this->input->post('caminho_editar');
            $data['id_categoria'] = $this->input->post('categoria_editar');
                
            $dados['id_funcionalidade'] = $this->input->post('id_editar');
            
            $this->mm->excluir_funcionalidade_nivel($dados['id_funcionalidade']);
            $this->mm->editar_funcionalidade($data, $dados['id_funcionalidade']);    
            foreach ($this->input->post('nivel_editar') as $n){
                $dados['id_nivel'] = $n;
                $this->mm->set_func_niv($dados);
            }
            $data['mensagem'] = '<div class="alert alert-success">Funcionalidade editada com sucesso. </div>';
            $this->session->set_userdata('mensagem', $data['mensagem']);
            redirect(base_url('menu/funcionalidades'));
        }
    
    }
    
    public function dados_funcionalidade(){
        $id = $this->input->post('id');
        $dados = $this->mm->get_funcionalidade($id);
        $niveis = $this->mm->get_funcionalidade_nivel($id);
        
        
        foreach($dados as $d){
            $resp['nome']   = $d->descricao;
            $resp['url']   = $d->caminho;
            $resp['id_categoria']   = $d->id_categoria;
            $resp['id'] = $id;
            foreach($niveis as $n){
                $resp['nivel'][$n->id_nivel] = $n->id_nivel;
            }
        }
        
        echo json_encode($resp);
    }
}
