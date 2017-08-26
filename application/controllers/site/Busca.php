<?php if(!defined('BASEPATH')) exit ('Sem direito de acesso direto ao script.');

class Busca extends CI_Controller{
    
    protected $data;
    
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model('empresa_model');
    }
    
    public function listar() {
        
        $this->session->set_userdata('busca', '');
        
        $this->index();
    }
    
    public function index($de=0){
        
        if($this->input->post('busca')) {
        
            $busca = $this->input->post('busca');
            $this->session->set_userdata('busca', $busca);
        }
        
        $busca = $this->session->userdata('busca');
        
        $this->data['empresas'] = $this->empresa_model->get_all(20, $de, NULL, NULL, NULL, NULL, $busca);
        
        $this->Paginacao($busca);
        
        $this->load->view('../../template/pagination.php', $this->data);
    }
    
    private function Paginacao($busca) {
        
        $config['base_url']    = '/pocos/site/busca/index';
        $config['total_rows']  = $this->empresa_model->count_all(NULL, NULL, NULL, $busca);
        $config['per_page']    = 20;
        $config["uri_segment"] = 4;
        $config['first_link'] = 'Primeiro';
        $config['last_link'] = 'Último';
        $config['next_link'] = 'Próximo';
        $config['prev_link'] = 'Anterior';

        $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = '&laquo; Primeiro';
        $config['first_tag_open'] = '<li class="page-item navegacao navegacao">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Último &raquo;';
        $config['last_tag_open'] = '<li class="page-item navegacao">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Próximo &rarr;';
        $config['next_tag_open'] = '<li class="page-item navegacao">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Anterior';
        $config['prev_tag_open'] = '<li class="page-item navegacao">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $this->data['paginacao'] = $this->pagination->create_links();
        $this->data['total']     = $config['total_rows'];
    }
}