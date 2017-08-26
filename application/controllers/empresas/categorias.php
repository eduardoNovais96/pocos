<?php if(!defined('BASEPATH')) exit('Sem direito de acesso direto ao script.');

class Categorias extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('empresa_model', 'em');
    }
    public function index(){
        $dados['categorias'] = $this->em->get_categorias();
        $dados['pagina'] = 'empresas/gerenciar_categorias';
        
        $this->load->view('template', $dados);
    }
}