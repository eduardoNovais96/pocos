<?php if(!defined('BASEPATH')) exit ('Sem direito de acesso direto ao script.');

class Empresa extends CI_Controller{
    
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model('empresa_model');
        
    }
    
    public function index(){
        
        $this->load->view('../../template/index.php');
    }
    
    public function detalhes($empresaId) {
        
        $dados = array(
            'empresa' => $this->empresa_model->BuscarPorId($empresaId)
        );
        
        $this->load->view('../../template/single.php', $dados);
    }
}