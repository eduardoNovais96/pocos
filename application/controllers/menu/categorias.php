<?php if(!defined("BASEPATH")) exit("Sem direito de acesso direto ao script.");

class Categorias extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('menu_model','mm');
    }
    
    public function index($data = FALSE){
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
        
        $config['base_url'] = '/avicultura/menu/categoria/filtro';
        $config['total_rows'] = $this->mm->count_all();
        $config['per_page'] = $maximo;
        $config["uri_segment"] = 4;
        $config['first_link'] = 'Primeiro';
        $config['last_link'] = 'Último';
        $config['next_link'] = 'Próximo';
        $config['prev_link'] = 'Anterior';
        
        $config['full_tag_open'] = '<div class="pagination"><ul>';
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
        $data['categorias'] = $this->mm->get_all($maximo, $inicio);
        $data['pagina'] = 'menu/categoria';
        
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
        
        $config['base_url'] = '/avicultura/menu/categoria/filtro';
        $config['total_rows'] = $this->mm->count_all();
        if($maximo == 'todos'){
            $maximo = $this->um->count_all();
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
        
        $config['full_tag_open'] = '<div class="pagination"><ul>';
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
        $data['categorias'] = $this->mm->get_all($maximo, $inicio);
        $data['total'] = $config['total_rows'];
        $data['pagina'] = 'menu/categoria';
        $this->load->view('template',$data);
    }
    
    public function adcionar_categoria(){
        if(@$this->input->post('btnProsseguir')){
            $this->form_validation->set_rules('descricao','Descrição','required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in">','</div>');
            if($this->form_validation->run()==FALSE)
                $this->index();
            else{
                $data['descricao'] = $this->input->post('descricao');
                $cat = $this->mm->get_categoria($data['descricao']);
                if(@$cat[0]->nome){
                    $this->mm->update_categoria($data, $data['descricao']);
                    redirect(base_url('menu/categoria'));
                }
                else{
                    $this->mm->set_categoria($data);
                    $mensagem = '<div class="alert alert-success">Categoria cadastrada com sucesso. </div>';
                    $this->session->set_userdata('mensagem', $mensagem);
                    redirect(base_url('menu/categorias'));
                }
            }
        }
    }
    
    public function editar_categoria(){
        $this->form_validation->set_rules('descricao_editar','Descrição','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in">','</div>');
        if($this->form_validation->run()==FALSE)
            $this->index();
        else{
            $data['descricao'] = $this->input->post('descricao_editar');
            $this->mm->update_categoria($data, NULL, $this->input->post('id_editar'));
            $data['mensagem'] = '<div class="alert alert-success">Categoria editada com sucesso. </div>';
            $this->session->set_userdata('mensagem', $data['mensagem']);
            redirect(base_url('menu/categorias'));
        }
    
    }
    
    public function excluir($id){
        $this->mm->excluir_categoria($id);
        $data['mensagem'] = '<div class="alert alert-success">Categoria excluida com sucesso. </div>';
        $this->session->set_userdata('mensagem', $data['mensagem']);
        redirect(base_url('menu/categorias'));
    }
    
    public function dados_categoria(){
        $id = $this->input->post('id');
        $dados = $this->mm->get_categoria(NULL,$id);
        
        foreach($dados as $d){
            $resp['descricao']   = $d->descricao;
            $resp['id'] = $id;
        }
        
        echo json_encode($resp);
    }
}
